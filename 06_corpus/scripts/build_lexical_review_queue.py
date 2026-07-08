#!/usr/bin/env python3
"""Turn an ABNC lemma frequency CSV into a conservative review queue.

This script does not guess translations, levels, or dictionary headwords. It
only removes obvious non-lexical rows and adds machine-readable review flags.
"""

import argparse
import csv
import unicodedata


NON_ABKHAZ_LETTERS = set("щъёюэЩЪЁЮЭ")


def is_cyrillic_letter(char: str) -> bool:
    return unicodedata.category(char).startswith("L") and "CYRILLIC" in unicodedata.name(char, "")


def classify(value: str) -> tuple[str, list[str]]:
    flags: list[str] = []
    letters = [char for char in value if unicodedata.category(char).startswith("L")]

    if not any(is_cyrillic_letter(char) for char in letters):
        flags.append("no_cyrillic_lemma")
    if value == "??" or "?" in value:
        flags.append("analysis_placeholder")
    if any(char.isdigit() for char in value):
        flags.append("contains_digit")
    if any("LATIN" in unicodedata.name(char, "") for char in letters):
        flags.append("contains_latin")
    if NON_ABKHAZ_LETTERS.intersection(value):
        flags.append("non_abkhaz_letter")
    if any(char.isupper() for char in letters):
        flags.append("uppercase_form")
    if value.count("-") >= 2:
        flags.append("segmented_morphology")

    blocking = {
        "no_cyrillic_lemma",
        "analysis_placeholder",
        "contains_digit",
        "contains_latin",
    }
    if blocking.intersection(flags):
        return "exclude_obvious_noise", flags
    if "non_abkhaz_letter" in flags:
        return "deprioritize_language_check", flags
    return "needs_lexicographer", flags


def main() -> None:
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument("input")
    parser.add_argument("output")
    parser.add_argument("--candidate-limit", type=int, default=1500)
    args = parser.parse_args()

    candidates = 0
    written = 0
    with open(args.input, encoding="utf-8", newline="") as source, open(
        args.output, "w", encoding="utf-8", newline=""
    ) as target:
        reader = csv.DictReader(source)
        writer = csv.writer(target)
        writer.writerow(
            [
                "queue_rank",
                "corpus_rank",
                "corpus_lemma",
                "count",
                "per_million",
                "priority_band",
                "automated_status",
                "flags",
                "ru",
                "level",
                "chapter",
                "lexicographer_review",
                "native_review",
                "source_id",
            ]
        )

        for row in reader:
            status, flags = classify(row["corpus_lemma"])
            queue_rank = ""
            if status == "needs_lexicographer" and candidates < args.candidate_limit:
                candidates += 1
                queue_rank = candidates

            corpus_rank = int(row["rank"])
            if corpus_rank <= 250:
                band = "top_250"
            elif corpus_rank <= 1000:
                band = "top_1000"
            else:
                band = "long_tail"

            writer.writerow(
                [
                    queue_rank,
                    corpus_rank,
                    row["corpus_lemma"],
                    row["count"],
                    row["per_million"],
                    band,
                    status,
                    ";".join(flags),
                    "",
                    "",
                    "",
                    "pending",
                    "required",
                    row["source_id"],
                ]
            )
            written += 1

    print(f"written: {args.output} ({written} rows; {candidates} candidate rows)")


if __name__ == "__main__":
    main()
