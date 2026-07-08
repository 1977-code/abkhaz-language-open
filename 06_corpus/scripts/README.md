# Corpus & frequency scripts

Reproducible scripts that turn open Abkhaz corpora into aggregated frequency data.
**No third-party dependencies** — Python 3.8+ standard library only.

Outputs live in [`../../data/`](../../data/) and are released as **CC0** (aggregated
frequency = facts). Raw third-party corpora are **not** redistributed; see
[`../../ATTRIBUTION.md`](../../ATTRIBUTION.md).

## Scripts

| Script | Input | Output | Reproducible from public source? |
|---|---|---|---|
| `fetch_abnc_frequency.py` | public ABNC wildcard query (Corpuscle) | `data/freq_abnc_lemma_v1.csv` | ✅ yes |
| `build_abnc_pos_v2.py` | POS frequency export (`word-lemma-pos.tsv`, from the ABNC maintainer) | `data/freq_abnc_lemma_pos_v2.csv` | ⚠️ needs the export — regenerable via CLARIN on request |
| `freq_from_wiki.py` | Abkhaz Wikipedia dump (`abwiki-*-pages-articles.xml.bz2`) | `data/freq_abwiki_v0.csv` | ✅ yes |
| `freq_from_common_voice.py` | Common Voice `ab` archive (`.tar.gz`) | `data/freq_cv_pool_v0.csv` (clips variant) | ✅ yes |
| `freq_from_cv_sentence_pool.py` | Common Voice `ab` sentence pool | `data/freq_cv_pool_v0.csv` | ✅ yes |
| `build_lexical_review_queue.py` | an ABNC lemma frequency CSV | a conservative review queue | ✅ yes |

## Run

```bash
# 1) ABNC aggregate frequency (top 5000 lemmas) from the public corpus
python3 fetch_abnc_frequency.py ../../data/freq_abnc_lemma_v1.csv --attribute lemma --limit 5000

# 2) Abkhaz Wikipedia frequency (download the dump first)
python3 freq_from_wiki.py abwiki-latest-pages-articles.xml.bz2 ../../data/freq_abwiki_v0.csv 3000

# 3) Common Voice sentence-pool frequency
python3 freq_from_cv_sentence_pool.py ../../data/freq_cv_pool_v0.csv 5000
```

Each script has a docstring with its exact usage, provenance, and known limitations.
The scripts never download corpus texts, store speaker identifiers, or export raw
sentence/concordance data — only aggregated counts.
