# Lesson data schema

Цель схемы — чтобы учебник, сайт, упражнения, аудио и будущий AI-тьютор использовали одни и те же идентификаторы.

## Lesson

```yaml
lesson_id: L01
title_ru:
level:
status: draft | native_review | scientific_review | pilot | published
summary_ru:
speech_goals:
  - goal_id:
    text_ru:
grammar_focus:
  - grammar_id:
    title_ru:
lexical_domains:
  - domain_id:
audio:
  - audio_id:
dialogues:
  - dialogue_id:
exercises:
  - exercise_id:
sources:
  - source_id:
rights_status:
native_review:
scientific_review:
pilot_status:
```

## Dialogue

```yaml
dialogue_id:
lesson_id:
title_ru:
scenario_ru:
turns:
  - speaker:
    text_ab:
    text_ru:
    audio_id:
    notes:
status:
needs_native_review:
rights_status:
```

## Word

```yaml
word_id:
lemma_ab:
ru:
level:
domain:
part_of_speech:
chapter:
active_or_passive:
example_ids:
audio_id:
source_id:
rights_status:
native_review:
notes:
```

## Exercise

```yaml
exercise_id:
lesson_id:
type:
skill:
level:
prompt_ru:
items:
answer_key:
feedback_ru:
source_id:
rights_status:
needs_native_review:
```

## Audio

```yaml
audio_id:
lesson_id:
type:
speaker_id:
tempo: slow | natural
file_path:
transcript_ab:
translation_ru:
rights_status:
speaker_release_id:
native_review:
notes:
```

