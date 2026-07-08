#!/usr/bin/env python3
"""Частотный список словоформ v0 из дампа абхазской Википедии.

Использование:
  python3 freq_from_wiki.py abwiki-latest-pages-articles.xml.bz2 out.csv [top_n]

Источник: https://dumps.wikimedia.org/abwiki/ (CC BY-SA 4.0).
Это v0 — учебное ядро строить только после сверки с ABNC (CLARIN PUB / CC-ZERO)
и проверки носителем. Известные ограничения описаны в 06_corpus/FREQUENCY_LIST_V0.md.
"""
import bz2
import collections
import csv
import re
import sys

# Буквы, которых нет в абхазском алфавите: токены с ними — почти всегда
# русские вкрапления (цитаты, библиография, служебные строки).
NON_ABKHAZ = set("щъёюэЩЪЁЮЭ")

TOKEN_RE = re.compile(r"[Ѐ-ԯ]+(?:[-’][Ѐ-ԯ]+)*")
TEXT_RE = re.compile(r"<text[^>]*>(.*?)</text>", re.S)

MARKUP_PATTERNS = [
    re.compile(r"&lt;ref[^&]*?/&gt;|&lt;ref.*?&lt;/ref&gt;", re.S),  # сноски
    re.compile(r"\{\{.*?\}\}", re.S),          # шаблоны (грубо)
    re.compile(r"\{\|.*?\|\}", re.S),          # таблицы
    # служебные ссылки (категории, файлы) удаляются целиком
    re.compile(r"\[\[\s*(?:Акатегориа|Категория|Category|Афаил|Файл|File|Image)\s*:[^\]]*\]\]", re.I),
    re.compile(r"\[\[(?:[^|\]]*\|)?([^\]]*)\]\]"),  # [[ссылка|текст]] -> текст
    re.compile(r"&lt;[^&]*?&gt;"),             # прочие теги
    re.compile(r"https?://\S+"),
]


def clean(raw: str) -> str:
    text = raw
    for pat in MARKUP_PATTERNS:
        text = pat.sub(lambda m: m.group(1) if m.groups() else " ", text)
    return text


def main() -> None:
    dump_path, out_path = sys.argv[1], sys.argv[2]
    top_n = int(sys.argv[3]) if len(sys.argv) > 3 else 3000

    counter: collections.Counter[str] = collections.Counter()
    opener = bz2.open if dump_path.endswith(".bz2") else open
    with opener(dump_path, "rt", encoding="utf-8", errors="ignore") as fh:
        data = fh.read()

    pages = 0
    for match in TEXT_RE.finditer(data):
        pages += 1
        for token in TOKEN_RE.findall(clean(match.group(1))):
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

    print(f"pages: {pages}, tokens kept: {total}, unique: {len(counter)}")
    print(f"written: {out_path} (top {top_n})")


if __name__ == "__main__":
    main()
