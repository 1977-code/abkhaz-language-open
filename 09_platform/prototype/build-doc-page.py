#!/usr/bin/env python3
"""Оборачивает HTML-фрагмент (stdin) в страницу документа в дизайне лендинга.
Использование: python3 build-doc-page.py <name> <title> <outfile> < body.html
Вызывается из build-docs.sh."""
import sys, html

name, title, out = sys.argv[1], sys.argv[2], sys.argv[3]
body = sys.stdin.read()
esc_title = html.escape(title)

page = f"""<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{esc_title} — рабочий документ открытого проекта «Абхазский язык».">
    <meta name="theme-color" content="#122019">
    <title>{esc_title} — Абхазский язык</title>
    <link rel="canonical" href="https://abkh.vercel.app/docs/{name}.html">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23123524'/%3E%3Ctext x='32' y='45' font-family='Georgia,serif' font-size='34' fill='%23ffffff' text-anchor='middle'%3E%D0%90%D2%A7%3C/text%3E%3C/svg%3E">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{esc_title} — Абхазский язык">
    <meta property="og:url" content="https://abkh.vercel.app/docs/{name}.html">
    <meta property="og:image" content="https://abkh.vercel.app/assets/abkhaz-language-hero.jpg">
    <meta property="og:locale" content="ru_RU">
    <meta name="twitter:card" content="summary_large_image">
    <style>
      :root {{
        --ink: #18211c;
        --muted: #627068;
        --line: #d8dfda;
        --paper: #f7f9f6;
        --white: #ffffff;
        --forest: #1d5f43;
        --forest-dark: #123524;
        --soft-green: #e7f0ea;
      }}
      * {{ box-sizing: border-box; }}
      body {{
        margin: 0;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        color: var(--ink);
        background: var(--paper);
        line-height: 1.65;
      }}
      .topbar {{
        background: var(--forest-dark);
        color: var(--white);
      }}
      .topbar-shell {{
        max-width: 820px;
        margin: 0 auto;
        padding: 0 20px;
        min-height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
      }}
      .topbar a {{ color: var(--white); text-decoration: none; font-weight: 700; font-size: 14px; }}
      .topbar a:hover {{ text-decoration: underline; text-underline-offset: 4px; }}
      .brand-mini {{ display: inline-flex; gap: 9px; align-items: baseline; }}
      .brand-mini .ru {{ opacity: .75; font-weight: 600; font-size: 13px; }}
      main {{
        max-width: 820px;
        margin: 0 auto;
        padding: 42px 20px 72px;
        overflow-wrap: anywhere;
      }}
      h1 {{ font-size: 40px; line-height: 1.1; margin: 8px 0 18px; text-wrap: balance; }}
      h2 {{ font-size: 26px; line-height: 1.2; margin: 38px 0 12px; }}
      h3 {{ font-size: 19px; margin: 28px 0 10px; }}
      p, ul, ol {{ margin: 0 0 14px; }}
      li {{ margin-bottom: 6px; }}
      a {{ color: var(--forest); text-underline-offset: 3px; }}
      code {{
        background: var(--soft-green);
        border-radius: 4px;
        padding: 1px 6px;
        font-size: .9em;
      }}
      pre {{ background: var(--soft-green); border-radius: 8px; padding: 14px 16px; overflow-x: auto; }}
      pre code {{ background: none; padding: 0; }}
      blockquote {{
        margin: 0 0 14px;
        padding: 2px 18px;
        border-left: 3px solid var(--forest);
        color: var(--muted);
        background: var(--white);
        border-radius: 0 8px 8px 0;
      }}
      table {{
        width: 100%;
        border-collapse: collapse;
        margin: 0 0 18px;
        background: var(--white);
        border: 1px solid var(--line);
        font-size: 14.5px;
        display: block;
        overflow-x: auto;
      }}
      th, td {{ border: 1px solid var(--line); padding: 9px 12px; text-align: left; vertical-align: top; }}
      th {{ background: var(--soft-green); font-weight: 700; }}
      hr {{ border: 0; border-top: 1px solid var(--line); margin: 30px 0; }}
      .doc-footer {{
        max-width: 820px;
        margin: 0 auto;
        padding: 22px 20px 48px;
        color: var(--muted);
        font-size: 13.5px;
        border-top: 1px solid var(--line);
      }}
      .doc-footer a {{ color: var(--forest); }}
      @media (max-width: 640px) {{
        h1 {{ font-size: 30px; }}
        h2 {{ font-size: 22px; }}
      }}
    </style>
  </head>
  <body>
    <header class="topbar">
      <div class="topbar-shell">
        <a class="brand-mini" href="/"><span>Аҧсуа</span><span class="ru">Абхазский язык</span></a>
        <a href="/#documents">← Все документы</a>
      </div>
    </header>
    <main>
{body}
    </main>
    <footer class="doc-footer">
      Рабочий документ открытого проекта «Абхазский язык» · <a href="/">abkh.vercel.app</a> · исходник: <a href="/docs/{name}.md">{name}.md</a>
      <span style="display:inline-flex;align-items:center;gap:7px;margin-left:6px">·
        <a href="https://artspace1977.ru" target="_blank" rel="noopener noreferrer" title="сделано силами творческого сообщества 1977" style="display:inline-flex;align-items:center;gap:6px">сделано&nbsp;силами
          <img src="/assets/logo-1977-dark.svg" alt="1977" style="height:14px;width:auto;vertical-align:middle">
        </a>
      </span>
    </footer>
  </body>
</html>
"""
open(out, "w", encoding="utf-8").write(page)
print(f"built docs/{name}.html — {title}")
