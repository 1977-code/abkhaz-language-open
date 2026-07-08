# Attribution & Sources

This project builds on open language resources. We are grateful to their creators and
communities. Our **own** contributions (methodology, lessons, aggregated data) are licensed
as described in [`LICENSE`](LICENSE), [`CONTENT-LICENSE.md`](CONTENT-LICENSE.md), and
[`DATA-LICENSE.md`](DATA-LICENSE.md). The sources below keep their **own** licenses — we do
not relicense them, and we do not redistribute their raw materials in this repository.

## Corpora & datasets used to derive frequency data

### Abkhaz National Corpus (ABNC)
- **Maintainer:** Paul Meurer, University of Bergen — CLARINO Bergen Center. The maintainer
  supplied a part-of-speech frequency export directly and permits publishing **aggregated
  frequency**.
- **Use here:** The ABNC is a **~10.8M-word** corpus. From it we publish aggregated
  lemma/word-form frequency (`fetch_abnc_frequency.py`, `build_abnc_pos_v2.py`). The
  wildcard-query ABNC layer, the Wikipedia layer, and the Common Voice layer regenerate from
  public sources; the POS-enriched ABNC table is regenerable via CLARIN on request rather
  than from public files alone.
- **Terms:** The corpus portal (clarino.uib.no/abnc) states its material is available under a
  **CLARIN PUB (CC-ZERO)** license; publication of aggregated frequency is permitted (tracked
  internally as rights entry R-002). The corpus itself remains © its compilers; **raw corpus
  exports are not redistributed here.**

### Mozilla Common Voice — Abkhaz
- **Source:** The Common Voice Abkhaz dataset, contributed by the Abkhaz-speaking community.
- **License:** CC0 1.0 (dataset), used per Common Voice rules (no re-hosting of audio, no
  de-anonymization). We derive text frequency only (`freq_from_common_voice.py`,
  `freq_from_cv_sentence_pool.py`). Audio is **not** included in this repository.

### Abkhaz Wikipedia
- **Source:** Wikimedia contributors, Abkhaz Wikipedia.
- **License:** Article text is CC BY-SA 4.0 (with GFDL). We derive **frequency statistics
  only** (`freq_from_wiki.py`) — factual measurements, released as CC0 — and do **not**
  reproduce article text.

## Other third-party materials

Dictionaries, textbooks, scanned books, partner media, and native-speaker audio are handled
strictly under their own licenses or by written permission, and are recorded in
[`03_rights/RIGHTS_REGISTRY.md`](03_rights/RIGHTS_REGISTRY.md). Materials marked
`research-only`, `permission-pending`, or `do-not-use-until-cleared` are **not** published in
this repository.

## How to report an attribution issue

If you believe something here is misattributed or should not be public, please open an issue
or contact the project — we will review and correct promptly.
