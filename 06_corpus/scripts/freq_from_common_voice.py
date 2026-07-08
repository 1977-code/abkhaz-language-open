#!/usr/bin/env python3
"""Build an aggregate Abkhaz wordform list from a Common Voice archive.

Usage:
  python3 freq_from_common_voice.py archive.tar.gz out.csv [top_n]

The script reads TSV metadata directly from the archive. It never extracts audio,
stores speaker identifiers, or exports sentence text. Repeated prompts are counted
once so that popular recordings do not distort text frequency.
"""

import collections
import csv
import io
import re
import sys
import tarfile
from pathlib import PurePosixPath


NON_ABKHAZ = set("щъёюэЩЪЁЮЭ")
TOKEN_RE = re.compile(r"[Ѐ-ԯ]+(?:[-’][Ѐ-ԯ]+)*")
TEXT_FIELDS = ("sentence", "text")
PRIMARY_FILE = "validated.tsv"
FALLBACK_FILES = ("train.tsv", "dev.tsv", "test.tsv")


def normalize_prompt(value: str) -> str:
    return " ".join(value.split()).casefold()


def tokenize(value: str) -> list[str]:
    words = []
    for token in TOKEN_RE.findall(value):
        word = token.casefold()
        if len(word) < 2 or NON_ABKHAZ.intersection(word):
            continue
        words.append(word)
    return words


def select_members(archive: tarfile.TarFile) -> list[tarfile.TarInfo]:
    tsv_members = {
        PurePosixPath(member.name).name: member
        for member in archive.getmembers()
        if member.isfile() and member.name.endswith(".tsv")
    }
    if PRIMARY_FILE in tsv_members:
        return [tsv_members[PRIMARY_FILE]]

    selected = [tsv_members[name] for name in FALLBACK_FILES if name in tsv_members]
    if selected:
        return selected
    raise RuntimeError("Archive has no validated.tsv or train/dev/test TSV files")


def read_prompts(archive: tarfile.TarFile, members: list[tarfile.TarInfo]):
    for member in members:
        extracted = archive.extractfile(member)
        if extracted is None:
            continue
        with io.TextIOWrapper(extracted, encoding="utf-8-sig", errors="replace") as stream:
            reader = csv.DictReader(stream, delimiter="\t")
            text_field = next((name for name in TEXT_FIELDS if name in (reader.fieldnames or [])), None)
            if text_field is None:
                raise RuntimeError(f"{member.name} has neither 'sentence' nor 'text' column")
            for row in reader:
                prompt = normalize_prompt(row.get(text_field, ""))
                if prompt:
                    yield prompt


def main() -> None:
    if len(sys.argv) < 3:
        raise SystemExit(__doc__)

    archive_path, out_path = sys.argv[1], sys.argv[2]
    top_n = int(sys.argv[3]) if len(sys.argv) > 3 else 3000

    token_counts: collections.Counter[str] = collections.Counter()
    sentence_counts: collections.Counter[str] = collections.Counter()
    seen_prompts: set[str] = set()

    with tarfile.open(archive_path, "r:*") as archive:
        members = select_members(archive)
        member_names = [member.name for member in members]
        for prompt in read_prompts(archive, members):
            if prompt in seen_prompts:
                continue
            seen_prompts.add(prompt)
            words = tokenize(prompt)
            token_counts.update(words)
            sentence_counts.update(set(words))

    total_tokens = sum(token_counts.values())
    total_sentences = len(seen_prompts)
    if not total_tokens:
        raise RuntimeError("No Abkhaz tokens found in selected TSV files")

    with open(out_path, "w", encoding="utf-8", newline="") as stream:
        writer = csv.writer(stream)
        writer.writerow(
            ["rank", "wordform", "count", "per_million", "sentence_count", "sentence_share"]
        )
        for rank, (word, count) in enumerate(token_counts.most_common(top_n), 1):
            writer.writerow(
                [
                    rank,
                    word,
                    count,
                    round(count / total_tokens * 1_000_000, 1),
                    sentence_counts[word],
                    round(sentence_counts[word] / total_sentences, 6),
                ]
            )

    print(f"TSV files: {', '.join(member_names)}")
    print(f"unique prompts: {total_sentences}")
    print(f"tokens kept: {total_tokens}, unique wordforms: {len(token_counts)}")
    print(f"written: {out_path} (top {top_n})")


if __name__ == "__main__":
    main()
