<?php
// Шапка сайта. Перед include задать: $lang ('ru'|'en'), $nav_active ('home'|'course'|'partners'|'docs'|'join'|'').
$lang = $lang ?? 'ru';
$en = ($lang === 'en');
$nav_active = $nav_active ?? '';
$cur = fn(string $k) => $nav_active === $k ? ' aria-current="page"' : '';
?>
  <body>
    <a class="skip-link" href="#main"><?= $en ? 'Skip to content' : 'К содержанию' ?></a>

    <header class="site-header">
      <div class="container nav-shell">
        <a class="brand" href="<?= $en ? '/en/' : '/' ?>" aria-label="<?= $en ? 'The Abkhaz Language, home' : 'Абхазский язык, на главную' ?>">
          <span class="brand-script">Аҧсуа</span>
          <span class="brand-ru"><?= $en ? 'The Abkhaz Language' : 'Абхазский язык' ?></span>
        </a>

        <?php if ($en): ?>
        <nav class="nav-links" aria-label="Main navigation">
          <a href="#product">What we build</a>
          <a href="#roadmap">Progress</a>
          <a href="#participate">Get involved</a>
          <a href="/" lang="ru">RU</a>
          <a class="nav-cta" href="#contact">Contact</a>
        </nav>
        <?php else: ?>
        <nav class="nav-links" aria-label="Основная навигация">
          <a href="/course/"<?= $cur('course') ?>>Курс</a>
          <a href="/partners/"<?= $cur('partners') ?>>Партнёры</a>
          <a href="/docs/"<?= $cur('docs') ?>>Документы</a>
          <a href="/join/"<?= $cur('join') ?>>Участие</a>
          <a href="/en/" lang="en">EN</a>
          <a class="nav-cta" href="/join/#contact">Написать</a>
        </nav>

        <details class="nav-burger">
          <summary aria-label="Меню">
            <span class="burger-lines" aria-hidden="true"><span></span><span></span><span></span></span>
          </summary>
          <nav class="burger-panel" aria-label="Мобильная навигация">
            <a href="/"<?= $cur('home') ?>>Главная</a>
            <a href="/course/"<?= $cur('course') ?>>Курс</a>
            <a href="/partners/"<?= $cur('partners') ?>>Партнёры</a>
            <a href="/docs/"<?= $cur('docs') ?>>Документы</a>
            <a href="/join/"<?= $cur('join') ?>>Участие</a>
            <a href="/en/" lang="en">English</a>
            <a class="burger-cta" href="/join/#contact">Написать нам</a>
          </nav>
        </details>
        <?php endif; ?>
      </div>
    </header>
