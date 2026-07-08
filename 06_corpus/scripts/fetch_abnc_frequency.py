#!/usr/bin/env python3
"""Fetch an aggregate frequency list from the public Abkhaz National Corpus.

Usage:
  python3 fetch_abnc_frequency.py out.csv [--attribute lemma] [--limit 5000]

The script runs a wildcard query against the public Corpuscle interface, enables
counts, downloads the resulting TSV list, and writes a compact CSV. It does not
download corpus texts or concordance lines.
"""

import argparse
import csv
import http.cookiejar
import json
import re
import time
import urllib.parse
import urllib.request


BASE_URL = "https://clarino.uib.no/abnc"
SOURCE_ID = "SRC-010"
SESSION_RE = re.compile(r'name="session-id" id="session-id" value="(\d+)"')
MATCHES_RE = re.compile(r"^# Matches:\s*(\d+)\s*$", re.MULTILINE)


def request(opener, path: str, data: dict[str, str] | None = None) -> str:
    encoded = urllib.parse.urlencode(data).encode("utf-8") if data else None
    req = urllib.request.Request(
        f"{BASE_URL}/{path}",
        data=encoded,
        headers={"User-Agent": "AbkhazianLanguageProject/1.0 (frequency research)"},
    )
    with opener.open(req, timeout=120) as response:
        return response.read().decode("utf-8")


def set_wordlist_option(opener, session_id: str, mode: str, **params: str) -> None:
    query = {"session-id": session_id, "mode": mode, **params}
    request(opener, f"js/match-wordlist?{urllib.parse.urlencode(query)}")


def fetch_frequency_tsv(attribute: str, poll_seconds: int = 120) -> str:
    cookie_jar = http.cookiejar.CookieJar()
    opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(cookie_jar))

    page = request(opener, "match-wordlist")
    session_match = SESSION_RE.search(page)
    if not session_match:
        raise RuntimeError("ABNC did not return a public session ID")
    session_id = session_match.group(1)

    request(
        opener,
        "match-wordlist",
        {
            "session-id": session_id,
            "query-mode": "basic",
            "basic-query": "*",
            "new-query": "Run Query",
        },
    )

    deadline = time.monotonic() + poll_seconds
    while True:
        state = json.loads(request(opener, f"query-progress.json?session-id={session_id}"))
        if state.get("done"):
            break
        if time.monotonic() >= deadline:
            raise TimeoutError("ABNC wildcard query did not finish before the deadline")
        time.sleep(1)

    set_wordlist_option(opener, session_id, "attribute", attribute=attribute)
    set_wordlist_option(opener, session_id, "ignore-case", **{"ignore-case": "true"})
    set_wordlist_option(opener, session_id, "include-counts", **{"include-counts": "true"})
    set_wordlist_option(opener, session_id, "sort-key", **{"sort-key": "frequency"})

    query = urllib.parse.urlencode(
        {
            "session-id": session_id,
            "attribute": attribute,
            "ignore-case": "true",
            "sort-key": "frequency",
        }
    )
    return request(opener, f"match-wordlist.txt?{query}")


def parse_frequency_tsv(raw: str) -> tuple[int, list[tuple[str, int]]]:
    match = MATCHES_RE.search(raw)
    if not match:
        raise RuntimeError("ABNC export has no '# Matches' metadata")
    total = int(match.group(1))

    rows: list[tuple[str, int]] = []
    for line in raw.splitlines():
        if not line or line.startswith("#"):
            continue
        count_text, separator, value = line.partition("\t")
        if not separator or not count_text.isdigit() or not value:
            continue
        rows.append((value, int(count_text)))
    rows.sort(key=lambda item: (-item[1], item[0].casefold()))
    return total, rows


def write_csv(path: str, attribute: str, total: int, rows, limit: int) -> None:
    label = "corpus_lemma" if attribute == "lemma" else "wordform"
    selected = rows[:limit] if limit else rows
    with open(path, "w", encoding="utf-8", newline="") as stream:
        writer = csv.writer(stream)
        writer.writerow(["rank", label, "count", "per_million", "source_id"])
        for rank, (value, count) in enumerate(selected, 1):
            writer.writerow([rank, value, count, round(count / total * 1_000_000, 1), SOURCE_ID])


def main() -> None:
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument("output")
    parser.add_argument("--attribute", choices=("lemma", "word"), default="lemma")
    parser.add_argument("--limit", type=int, default=5000, help="0 writes every row")
    args = parser.parse_args()

    raw = fetch_frequency_tsv(args.attribute)
    total, rows = parse_frequency_tsv(raw)
    if not rows:
        raise RuntimeError("ABNC export contained no frequency rows")
    write_csv(args.output, args.attribute, total, rows, args.limit)
    written = min(args.limit, len(rows)) if args.limit else len(rows)
    print(f"ABNC matches: {total}; unique {args.attribute} values: {len(rows)}")
    print(f"written: {args.output} ({written} rows)")


if __name__ == "__main__":
    main()
