# Abkhaz Language — Open Course & Language Data
### аҧсуа бызшәа · an open, reproducible toolkit for learning and preserving Abkhaz

[![Content: CC BY 4.0](https://img.shields.io/badge/content-CC%20BY%204.0-blue.svg)](CONTENT-LICENSE.md)
[![Data: CC0](https://img.shields.io/badge/data-CC0-lightgrey.svg)](DATA-LICENSE.md)
[![Code: MIT](https://img.shields.io/badge/code-MIT-green.svg)](LICENSE)
[![Language: Abkhaz [ab]](https://img.shields.io/badge/language-Abkhaz%20%5Bab%5D-orange.svg)](#)

Abkhaz (аҧсуа бызшәа) is a Northwest Caucasian language spoken by roughly 130,000 people.
UNESCO's *Atlas of the World's Languages in Danger* lists Abkhaz as **vulnerable**, and it
belongs to the Northwest Caucasian family — which has **already lost Ubykh**, whose last
fluent speaker died in 1992. Abkhaz has one of the largest consonant inventories of any
language on Earth (~58 consonants, 2 vowels), yet almost no modern, structured,
openly-licensed learning materials exist for it — especially for Russian speakers, its
largest pool of potential learners.

**This repository is an attempt to change that in the open.** It is the public,
rights-cleared core of a project to build the first openly-licensed, corpus-grounded course
for Abkhaz — and to release the underlying language data so that anyone (teachers, linguists,
app builders, other minority-language projects) can reuse it.

> This is an early-stage, actively developed project. Drafts here are **pending native-speaker
> and academic review** — we mark clearly what is verified and what is not. We would rather
> ship an honest work-in-progress in the open than a polished black box.

---

## What's open here

| Area | What it is | License |
|---|---|---|
| **`06_corpus/`** | **Frequency data** for Abkhaz derived from open corpora (the ~10.8M-word Abkhaz National Corpus, plus Common Voice and Wikipedia), with the Python scripts that produce it | data → [CC0](DATA-LICENSE.md) · code → [MIT](LICENSE) |
| **`data/freq_*.csv`** | Ranked lemma/word-form frequency lists (ABNC, Common Voice, Wikipedia) — the empirical backbone for a vocabulary syllabus | [CC0](DATA-LICENSE.md) |
| **`05_methodology/`** | A CEFR **A0–A2 syllabus**, lesson template, exercise typology, grammar scope, assessment & pilot protocols, native-review guide | [CC BY 4.0](CONTENT-LICENSE.md) |
| **`08_textbook/`** | **Draft lesson chapters** (L00–L04) and the workbook/editorial plan | [CC BY 4.0](CONTENT-LICENSE.md) |
| **`04_language_standard/`** | Orthographic norm decision, style guide, and a **verb-affix guide** for the notoriously complex Abkhaz verb | [CC BY 4.0](CONTENT-LICENSE.md) |
| **`09_platform/`** | Source of the bilingual (RU/EN) project website and the scope docs for lessons & an AI tutor built strictly on verified materials | code → [MIT](LICENSE) · docs → [CC BY 4.0](CONTENT-LICENSE.md) |
| **`03_rights/`** | Our rights & content-licensing policy — how we keep open materials cleanly separated from copyrighted sources | [CC BY 4.0](CONTENT-LICENSE.md) |

Third-party source materials (scanned books, licensed corpora dumps, native-speaker audio,
partner correspondence, budgets) are **deliberately not in this repository** — see
[Rights & attribution](#rights--attribution).

---

## The reproducible frequency pipeline

The centerpiece is a transparent, reproducible way to answer *"which Abkhaz words actually
matter first?"* — grounded in open corpora rather than intuition.

```
06_corpus/
├── scripts/
│   ├── fetch_abnc_frequency.py      # aggregate frequency from the Abkhaz National Corpus
│   ├── freq_from_common_voice.py    # frequency from Mozilla Common Voice (Abkhaz) prompts
│   ├── freq_from_wiki.py            # frequency from the Abkhaz Wikipedia dump
│   ├── freq_from_cv_sentence_pool.py
│   ├── build_abnc_pos_v2.py         # part-of-speech enriched lemma table
│   └── build_lexical_review_queue.py
├── FREQUENCY_WORKFLOW.md            # how the numbers are produced, end to end
└── OPEN_DATA_WORKFLOW.md            # what is open, what is not, and why
```

Outputs (`data/freq_*.csv`) are **aggregated frequency statistics** — facts about word
distribution, released under CC0. Where they derive from a specific corpus, the source and
its license are documented in [`ATTRIBUTION.md`](ATTRIBUTION.md). Raw third-party corpus
exports are **not** redistributed here; the scripts let you regenerate the data from the
original open sources. (Three of the four frequency layers regenerate fully from public
data; the part-of-speech-enriched ABNC table is built from a frequency export supplied by
the corpus maintainer and is regenerable via CLARIN on request.)

---

## Who this is for

- **Learners & teachers of Abkhaz** — a structured A0–A2 route and a data-driven word list.
- **Linguists & lexicographers** — open frequency data and a documented methodology to
  critique, correct, and build on.
- **Developers** — clean CSVs and a website you can fork; scope docs for an AI tutor.
- **Other endangered-language projects** — a replicable template: corpus → frequency →
  syllabus → open course, with an honest rights model.

---

## How to contribute

We especially need **native Abkhaz speakers** and **Abkhaz-studies scholars**. See
[`CONTRIBUTING.md`](CONTRIBUTING.md). In short:

- **Native speakers / teachers** — review draft lessons and glosses for naturalness and error.
- **Linguists** — audit the frequency lists, POS tagging, and grammar scope.
- **Developers** — improve the pipeline, the site, and data tooling.
- **Translators** — help mirror materials (RU ↔ EN and beyond).

Corrections to a single word or example are as welcome as large contributions — for an
under-resourced language, small expert fixes are high-value.

---

## Rights & attribution

This project is built to be **legally clean**. We separate:

- **`own-original`** material (our lessons, methodology, derived data) → openly licensed here.
- **Third-party sources** (corpora, dictionaries, books, media, audio) → used only within
  their licenses or by permission, and **not** re-published in this repo.

See [`03_rights/RIGHTS_REGISTRY.md`](03_rights/RIGHTS_REGISTRY.md),
[`03_rights/CONTENT_LICENSE_POLICY.md`](03_rights/CONTENT_LICENSE_POLICY.md), and
[`ATTRIBUTION.md`](ATTRIBUTION.md).

Key open sources we build on, with thanks:

- **Abkhaz National Corpus (ABNC)** — CLARINO / University of Bergen (Paul Meurer).
- **Mozilla Common Voice** — the Abkhaz community dataset.
- **Abkhaz Wikipedia** — Wikimedia contributors.

## Licensing summary

| Kind | License |
|---|---|
| Source code (scripts, website) | [MIT](LICENSE) |
| Educational content (lessons, methodology, docs) | [CC BY 4.0](CONTENT-LICENSE.md) |
| Aggregated language data (frequency CSVs, metadata) | [CC0 1.0](DATA-LICENSE.md) |
| Third-party sources | per [`ATTRIBUTION.md`](ATTRIBUTION.md) — **not relicensed** |

---

## Статус (RU)

Открытое, воспроизводимое ядро проекта по созданию современного курса абхазского языка
(аҧсуа бызшәа) — языка, отнесённого ЮНЕСКО к языкам под угрозой. Здесь опубликовано только
то, чем мы владеем и что очищено по правам: воспроизводимые частотные данные из открытых
корпусов и скрипты к ним, методика и силлабус A0–A2, черновики глав учебника, языковой
стандарт и исходники сайта. Скачанные сторонние материалы, аудио носителей, переписка и
бюджеты в репозиторий намеренно не включены. Материалы — рабочие черновики, ожидающие
проверки носителями и специалистами. Как помочь — см. [`CONTRIBUTING.md`](CONTRIBUTING.md).
