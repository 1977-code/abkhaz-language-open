# Open frequency data (CC0)

Aggregated Abkhaz word/lemma frequency derived from open corpora. Released under
**[CC0 1.0](../DATA-LICENSE.md)** — these are factual frequency statistics. Sources and
their own licenses: **[../ATTRIBUTION.md](../ATTRIBUTION.md)**. Regeneration scripts:
**[../06_corpus/scripts/](../06_corpus/scripts/)**.

> These lists are an empirical *starting point* for a vocabulary syllabus. Automatic data
> is **not** presented as a finished learner dictionary — entries are pending native and
> lexicographic review.

## Files

| File | Rows | Source | Columns |
|---|---|---|---|
| `freq_abnc_lemma_v1.csv` | 4 921 | Abkhaz National Corpus (wildcard query) | `rank, corpus_lemma, count, per_million, source_id` |
| `freq_abnc_lemma_pos_v2.csv` | 6 000 | ABNC POS export | `rank, lemma, pos, freq, per_million, n_wordforms` |
| `freq_abwiki_v0.csv` | 3 000 | Abkhaz Wikipedia dump | `rank, wordform, count, per_million` |
| `freq_cv_pool_v0.csv` | 5 000 | Common Voice (ab) sentence pool | `rank, wordform, count, per_million` |

## Column meanings

- **rank** — 1-based frequency rank within that source.
- **corpus_lemma / lemma** — dictionary/base form as given by the corpus (ABNC).
- **wordform** — surface form (for corpora without lemmatization: Wikipedia, Common Voice).
- **count / freq** — absolute occurrences in the processed source.
- **per_million** — occurrences normalized per 1,000,000 tokens (comparable across sources).
- **pos** — dominant part of speech for the lemma (ABNC POS layer).
- **n_wordforms** — number of distinct surface forms folded into the lemma (ABNC POS layer).
- **source_id** — internal provenance id (traced in `../02_research_inventory/` of the project).

## Notes & limitations

- `*_v0` lists are early and may contain non-lexical noise (numerals, foreign tokens); they
  are meant to be cross-checked against the ABNC layer and a native reviewer.
- Frequency reflects the composition of each source, not "importance" — treat it as evidence,
  not a verdict.
