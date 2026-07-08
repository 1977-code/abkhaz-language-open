#!/bin/bash
# Собирает docs/*.md в стилизованные docs/*.html (дизайн лендинга).
# Запуск: ./build-docs.sh  (из папки prototype; требуется npx marked)
set -euo pipefail
cd "$(dirname "$0")"

for md in docs/*.md; do
  name="$(basename "$md" .md)"
  title="$(grep -m1 '^# ' "$md" | sed 's/^# //' || echo "Документ проекта")"
  npx --yes marked --gfm < "$md" | python3 build-doc-page.py "$name" "$title" "docs/$name.html"
done
