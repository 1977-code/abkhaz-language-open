<?php if (!headers_sent()) { http_response_code(404); } ?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="theme-color" content="#0b1f15">
    <title>4Ҩ4 — страница исчезла · Абхазский язык</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23123524'/%3E%3Ctext x='32' y='45' font-family='Georgia,serif' font-size='34' fill='%23ffffff' text-anchor='middle'%3E%D0%90%D2%A7%3C/text%3E%3C/svg%3E">
    <style>
      :root { --night:#0b1f15; --forest-dark:#123524; --mint:#9fdcb5; --white:#fff; }
      * { box-sizing:border-box; }
      body { margin:0; min-height:100svh; display:flex; flex-direction:column;
        font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif;
        color:var(--white); background:linear-gradient(180deg,#071710 0%,var(--night) 46%,var(--forest-dark) 100%); }
      .scene { flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:56px 22px 0; }
      .code { margin:0; font-size:clamp(110px,24vw,210px); font-weight:760; line-height:.95; }
      .code .glyph { color:var(--mint); }
      .glyph-note { margin:14px 0 0; font-size:13.5px; letter-spacing:.04em; text-transform:uppercase; color:rgba(255,255,255,.55); }
      .glyph-note b { color:var(--mint); }
      h1 { margin:30px 0 12px; font-size:clamp(24px,4.4vw,34px); line-height:1.18; }
      .lead { margin:0 auto; max-width:540px; color:rgba(255,255,255,.74); font-size:16.5px; line-height:1.65; }
      .actions { display:flex; gap:12px; flex-wrap:wrap; justify-content:center; margin:32px 0 12px; }
      .button { min-height:46px; display:inline-flex; align-items:center; justify-content:center; padding:0 22px; border:1px solid transparent; border-radius:6px; font-size:15px; font-weight:720; text-decoration:none; }
      .button-primary { background:var(--white); color:var(--forest-dark); }
      .button-ghost { border-color:rgba(255,255,255,.45); color:var(--white); background:rgba(255,255,255,.04); }
      .mountains svg { display:block; width:100%; height:clamp(140px,26vw,260px); margin-top:auto; }
    </style>
  </head>
  <body>
    <main class="scene">
      <p class="code" aria-label="Ошибка 404">4<span class="glyph">Ҩ</span>4</p>
      <p class="glyph-note"><b>Ҩ</b> — настоящая буква абхазского алфавита</p>
      <h1>Эта страница исчезла</h1>
      <p class="lead">Так пропадают не только страницы. Языки тоже исчезают, когда на них перестают говорить. Страницу мы не спасли — абхазский ещё можем.</p>
      <div class="actions">
        <a class="button button-primary" href="/">Вернуться на главную</a>
        <a class="button button-ghost" href="/#participate">Помочь проекту</a>
      </div>
    </main>
    <div class="mountains" aria-hidden="true">
      <svg viewBox="0 0 1440 260" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 260 L0 190 L140 120 L260 175 L390 80 L520 165 L640 110 L760 180 L900 60 L1040 160 L1170 105 L1300 170 L1440 130 L1440 260 Z" fill="#0e2a1c" opacity="0.85"/>
        <path d="M0 260 L0 225 L120 170 L250 215 L380 150 L540 210 L680 160 L820 220 L980 140 L1120 205 L1260 165 L1380 210 L1440 195 L1440 260 Z" fill="#123524"/>
      </svg>
    </div>
  </body>
</html>
