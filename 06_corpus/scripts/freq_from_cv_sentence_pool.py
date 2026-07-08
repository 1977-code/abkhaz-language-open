#!/usr/bin/env python3
"""Частотный список словоформ из открытого пула предложений Common Voice (ab).

Использование:
  python3 freq_from_cv_sentence_pool.py out.csv [top_n] [--cache DIR]

Источник: текстовые файлы локали `ab` в репозитории common-voice/common-voice
(server/data/ab), лицензия предложений CC0. Это исходный текстовый пул для
записи, а не записанная речь: частоты отражают состав пула, а не употребление
в клипах. Для среза по записанным клипам см. freq_from_common_voice.py
(официальный архив Mozilla Data Collective).
"""
import collections
import csv
import pathlib
import re
import sys
import urllib.request

FILES = [
    "batch1.92k.ab.txt",
    "batch2.113k.ab.txt",
    "batch2.173k.ab.txt",
    "batch3.664k.ab.txt",
    "sentence-collector.txt",
]
BASE = "https://raw.githubusercontent.com/common-voice/common-voice/main/server/data/ab/"

NON_ABKHAZ = set("щъёюэЩЪЁЮЭ")
TOKEN_RE = re.compile(r"[Ѐ-ԯ]+(?:[-’][Ѐ-ԯ]+)*")


def main() -> None:
    out_path = sys.argv[1]
    top_n = int(sys.argv[2]) if len(sys.argv) > 2 and not sys.argv[2].startswith("--") else 5000
    cache = pathlib.Path(sys.argv[sys.argv.index("--cache") + 1]) if "--cache" in sys.argv else pathlib.Path("/tmp/cv_ab")
    cache.mkdir(parents=True, exist_ok=True)

    counter: collections.Counter[str] = collections.Counter()
    seen_sentences: set[int] = set()
    sentences = 0

    for name in FILES:
        local = cache / name
        if not local.exists():
            print(f"downloading {name} …", file=sys.stderr)
            urllib.request.urlretrieve(BASE + name, local)
        with open(local, encoding="utf-8", errors="ignore") as fh:
            for line in fh:
                line = line.strip()
                if not line:
                    continue
                key = hash(line)
                if key in seen_sentences:  # дубли между батчами считаем один раз
                    continue
                seen_sentences.add(key)
                sentences += 1
                for token in TOKEN_RE.findall(line):
                    word = token.lower()
                    if len(word) < 2 or NON_ABKHAZ.intersection(word):
                        continue
                    counter[word] += 1

    total = sum(counter.values())
    with open(out_path, "w", encoding="utf-8", newline="") as fh:
        writer = csv.writer(fh)
        writer.writerow(["rank", "wordform", "count", "per_million"])
        for rank, (word, count) in enumerate(counter.most_common(top_n), 1):
            writer.writerow([rank, word, count, round(count / total * 1e6, 1)])

    print(f"sentences: {sentences}, tokens kept: {total}, unique: {len(counter)}")
    print(f"written: {out_path} (top {top_n})")


if __name__ == "__main__":
    main()
