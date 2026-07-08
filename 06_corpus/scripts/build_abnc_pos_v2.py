#!/usr/bin/env python3
"""ABNC frequency v2: агрегат «лемма + часть речи + частота» из POS-выгрузки.

Вход — `word-lemma-pos.tsv` (от P. Meurer, 29.06.2026): TSV-колонки
  wordform <tab> POS <tab> lemma <tab> frequency
(каждая строка — словоформа с её разбором и частотой).

Выход — `data/freq_abnc_lemma_pos_v2.csv`:
  rank, lemma, pos, freq, per_million, n_wordforms
где freq — сумма по всем словоформам леммы, pos — часть речи с наибольшей
суммарной частотой для этой леммы, n_wordforms — число различных словоформ.

Чистка как в v1.1: оставляем только леммы с кириллицей без русских вкраплений
(щ/ъ/ё/ю/э). Лемматизация ABNC сегментирована (дефисы, префиксы, ударения) —
это сырьё для лексикографа, не готовая словарная форма.

Использование:
  python3 build_abnc_pos_v2.py /path/word-lemma-pos.tsv data/freq_abnc_lemma_pos_v2.csv [top_n]
"""
import collections
import csv
import re
import sys

CYR = re.compile(r"[Ѐ-ԯ]")
NON_ABKHAZ = set("щъёюэЩЪЁЮЭ")


def main() -> None:
    src, out = sys.argv[1], sys.argv[2]
    top_n = int(sys.argv[3]) if len(sys.argv) > 3 else 6000

    freq_by_lemma: collections.Counter[str] = collections.Counter()
    pos_by_lemma: dict[str, collections.Counter[str]] = collections.defaultdict(collections.Counter)
    forms_by_lemma: dict[str, set[str]] = collections.defaultdict(set)
    total_all = 0
    total_kept = 0

    with open(src, encoding="utf-8", errors="ignore") as fh:
        for line in fh:
            parts = line.rstrip("\n").split("\t")
            if len(parts) != 4:
                continue
            wordform, pos, lemma, freq_s = parts
            try:
                freq = int(freq_s)
            except ValueError:
                try:
                    freq = round(float(freq_s))
                except ValueError:
                    continue
            total_all += freq
            if not CYR.search(lemma) or NON_ABKHAZ & set(lemma):
                continue
            total_kept += freq
            freq_by_lemma[lemma] += freq
            pos_by_lemma[lemma][pos] += freq
            forms_by_lemma[lemma].add(wordform)

    with open(out, "w", encoding="utf-8", newline="") as fh:
        w = csv.writer(fh)
        w.writerow(["rank", "lemma", "pos", "freq", "per_million", "n_wordforms"])
        for rank, (lemma, freq) in enumerate(freq_by_lemma.most_common(top_n), 1):
            dom_pos = pos_by_lemma[lemma].most_common(1)[0][0]
            per_m = round(freq / total_kept * 1e6, 1)
            w.writerow([rank, lemma, dom_pos, freq, per_m, len(forms_by_lemma[lemma])])

    print(f"строк-словоформ обработано; токенов всего: {total_all}, кириллических (kept): {total_kept}")
    print(f"уникальных лемм (кириллических): {len(freq_by_lemma)}")
    print(f"written: {out} (top {top_n})")


if __name__ == "__main__":
    main()
