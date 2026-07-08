<?php
// Защищённая страница обращений с формы (доступ закрыт basicauth на уровне Caddy).
// Читает журнал /var/lib/abkhlang/contact-inbox.ndjson и показывает таблицей.
declare(strict_types=1);
require __DIR__ . '/inc/functions.php';
$c = cfg();

$rows = [];
$file = $c['inbox_file'] ?? '';
if ($file && is_readable($file)) {
    foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $r = json_decode($line, true);
        if (is_array($r)) { $rows[] = $r; }
    }
}
$rows = array_reverse($rows); // новые сверху
?><!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Обращения с формы — Абхазский язык</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23123524'/%3E%3Ctext x='32' y='45' font-family='Georgia,serif' font-size='34' fill='%23ffffff' text-anchor='middle'%3E%D0%90%D2%A7%3C/text%3E%3C/svg%3E">
    <style>
      body { margin:0; font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif; color:#18211c; background:#f7f9f6; line-height:1.5; }
      .bar { background:#123524; color:#fff; padding:14px 22px; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
      .bar a { color:#9fdcb5; text-decoration:none; font-weight:700; font-size:14px; }
      .bar .count { font-size:14px; color:rgba(255,255,255,.75); }
      main { max-width:1000px; margin:0 auto; padding:26px 20px 60px; }
      h1 { font-size:24px; margin:0 0 6px; }
      .hint { color:#627068; font-size:14px; margin:0 0 22px; }
      .empty { color:#627068; background:#fff; border:1px solid #d8dfda; border-radius:10px; padding:32px; text-align:center; }
      .card { background:#fff; border:1px solid #d8dfda; border-radius:10px; padding:18px 20px; margin-bottom:14px; }
      .card-top { display:flex; align-items:baseline; justify-content:space-between; gap:14px; flex-wrap:wrap; margin-bottom:8px; }
      .who { font-weight:760; font-size:16px; }
      .role { display:inline-block; margin-left:8px; font-size:12px; font-weight:700; color:#1d5f43; background:#e7f0ea; border-radius:999px; padding:2px 9px; vertical-align:middle; }
      .ts { color:#627068; font-size:13px; white-space:nowrap; }
      .email a { color:#1d5f43; text-decoration:none; font-weight:600; font-size:14px; }
      .msg { margin:10px 0 0; white-space:pre-wrap; overflow-wrap:anywhere; }
      .meta { margin-top:8px; color:#9aa6a0; font-size:12px; }
    </style>
  </head>
  <body>
    <div class="bar">
      <strong>Обращения с формы · abkhlang.ru</strong>
      <span class="count"><?= count($rows) ?> шт.</span>
      <a href="/">← на сайт</a>
    </div>
    <main>
      <h1>Обращения с формы обратной связи</h1>
      <p class="hint">Новые сверху. Эта страница закрыта паролем и не индексируется. Письма на почту сейчас не уходят (хостинг VPS блокирует исходящую почту) — все обращения здесь.</p>
      <?php if (!$rows): ?>
        <div class="empty">Пока обращений нет.</div>
      <?php else: foreach ($rows as $r): ?>
        <article class="card">
          <div class="card-top">
            <div class="who"><?= e((string)($r['name'] ?? '—')) ?><?php if (!empty($r['role'])): ?><span class="role"><?= e((string)$r['role']) ?></span><?php endif; ?></div>
            <div class="ts"><?= e((string)($r['ts'] ?? '')) ?></div>
          </div>
          <div class="email"><a href="mailto:<?= e((string)($r['email'] ?? '')) ?>"><?= e((string)($r['email'] ?? '')) ?></a></div>
          <p class="msg"><?= e((string)($r['message'] ?? '')) ?></p>
          <div class="meta">язык: <?= e((string)($r['lang'] ?? '')) ?> · IP: <?= e((string)($r['ip'] ?? '')) ?></div>
        </article>
      <?php endforeach; endif; ?>
    </main>
  </body>
</html>
