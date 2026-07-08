<?php
// Общие функции сайта.

if (!function_exists('cfg')) {
    function cfg(): array {
        static $c = null;
        if ($c === null) { $c = require __DIR__ . '/config.php'; }
        return $c;
    }
}

// Экранирование для вывода в HTML.
function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Базовый префикс пути (для /en/ и корня).
function base_path(string $path = ''): string {
    return '/' . ltrim($path, '/');
}

// Рендер общего <head>.
// $opts: title, description, canonical, lang ('ru'|'en'), preload_hero (bool)
function render_head(array $opts): void {
    $c = cfg();
    $lang  = $opts['lang'] ?? 'ru';
    $title = $opts['title'] ?? $c['site_name'];
    $desc  = $opts['description'] ?? '';
    $canon = $opts['canonical'] ?? $c['base_url'] . '/';
    $ogimg = $c['base_url'] . '/assets/abkhaz-language-hero.jpg';
    ?>
<!doctype html>
<html lang="<?= e($lang) ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= e($desc) ?>">
    <meta name="theme-color" content="#122019">
    <title><?= e($title) ?></title>
    <link rel="canonical" href="<?= e($canon) ?>">
    <link rel="alternate" hreflang="ru" href="<?= e($c['base_url']) ?>/">
    <link rel="alternate" hreflang="en" href="<?= e($c['base_url']) ?>/en/">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23123524'/%3E%3Ctext x='32' y='45' font-family='Georgia,serif' font-size='34' fill='%23ffffff' text-anchor='middle'%3E%D0%90%D2%A7%3C/text%3E%3C/svg%3E">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($desc) ?>">
    <meta property="og:url" content="<?= e($canon) ?>">
    <meta property="og:image" content="<?= e($ogimg) ?>">
    <meta property="og:locale" content="<?= $lang === 'en' ? 'en_US' : 'ru_RU' ?>">
    <meta name="twitter:card" content="summary_large_image">
    <?php if (!empty($opts['preload_hero'])): ?>
    <link rel="preload" as="image" href="/assets/abkhaz-language-hero.jpg" fetchpriority="high">
    <?php endif; ?>
    <link rel="stylesheet" href="/assets/style.css?v=3">
  </head>
<?php
}
