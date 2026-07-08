#!/bin/bash
# Собирает docs/*.md → docs/*.fragment.html (через npx marked) и чинит ссылки:
#   <slug>.html        → /docs/<slug>     (между документами, чистые URL)
#   ../data/file.csv   → /data/file.csv   (открытые данные)
# Запуск локально перед загрузкой на хостинг: ./build.sh
set -euo pipefail
cd "$(dirname "$0")"

for md in docs/*.md; do
  name="$(basename "$md" .md)"
  npx --yes marked --gfm < "$md" \
    | sed -E 's#href="([a-z0-9-]+)\.html"#href="/docs/\1"#g; s#href="\.\./data/#href="/data/#g' \
    > "docs/$name.fragment.html"
  echo "built docs/$name.fragment.html"
done
