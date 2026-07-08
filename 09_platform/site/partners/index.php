<?php
declare(strict_types=1);
require __DIR__ . '/../inc/functions.php';
$c = cfg();
$lang = 'ru';
$nav_active = 'partners';

render_head([
    'lang' => 'ru',
    'title' => 'Партнёры и данные — Абхазский язык',
    'description' => 'Кто помогает проекту «Абхазский язык»: партнёры, поставщики корпусных данных и открытые источники.',
    'canonical' => $c['base_url'] . '/partners/',
]);
include __DIR__ . '/../inc/header.php';
?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <p class="eyebrow" style="color:#9fdcb5">Партнёры</p>
          <h1 class="page-title">Проект делается<br>не в одиночку</h1>
          <p class="page-lead">Курс опирается на разрешения правообладателей, официальные корпусные данные и открытые научные ресурсы. Здесь мы благодарим тех, кто уже помогает.</p>
        </div>
      </section>

      <section class="section" id="partners">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--coral)">Партнёры</p>
              <h2>Организации</h2>
            </div>
            <p>Мы запрашиваем разрешение на каждый сторонний материал и используем его строго в согласованных пределах. Партнёрство начинается с одного письма — и мы всегда рады новым.</p>
          </div>
          <div class="partner-list">
            <article class="partner-card">
              <span class="role-tag">Тексты и аудио</span>
              <h3>Институт перевода Библии</h3>
              <p>Московский институт, издающий тщательно выверенные переводы на языки народов России, включая абхазский. Разрешил образовательное использование своих абхазских изданий — параллельных текстов и аудиозаписей — в материалах курса.</p>
              <a href="https://ibt.org.ru/" target="_blank" rel="noopener noreferrer">ibt.org.ru ↗</a>
            </article>
            <article class="partner-card">
              <span class="role-tag">Корпусные данные</span>
              <h3>Abkhaz National Corpus</h3>
              <p>Абхазский национальный корпус (инфраструктура CLARINO, Университет Бергена) — 12,6 млн словоупотреблений. Разработчик корпуса предоставил проекту официальные частотные выгрузки, на которых строится учебный словарь.</p>
              <a href="https://clarino.uib.no/abnc" target="_blank" rel="noopener noreferrer">clarino.uib.no/abnc ↗</a>
            </article>
          </div>
        </div>
      </section>

      <section class="section section-white" id="opendata">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--sea)">Открытые ресурсы</p>
              <h2>На чьих плечах стоим</h2>
            </div>
            <p>Помимо прямых партнёрств, курс опирается на открытые научные данные и библиотеки. Наши собственные производные данные мы тоже публикуем открыто.</p>
          </div>
          <ul class="resource-list">
            <li><strong>Universal Dependencies: Abkhaz-AbNC</strong> — синтаксически размеченные предложения (CC BY-SA).</li>
            <li><strong>NorthEuraLex и PHOIBLE</strong> — базовая лексика и фонемные инвентари для сверки учебного ядра.</li>
            <li><strong>Апснытека</strong> — электронная библиотека абхазской книги, незаменимая для исследовательского этапа.</li>
            <li><strong>Наши открытые данные</strong> — частотные списки трёх корпусов: <a href="/docs/open-data">abkhlang.ru/docs/open-data</a>.</li>
          </ul>
        </div>
      </section>

      <section class="section" id="become">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--gold)">Присоединиться</p>
              <h2>Станьте партнёром</h2>
            </div>
            <p>Нам важны архивы и медиа с правочистыми текстами и записями живой речи, научные институции для редактуры и площадки для пилота. Любое партнёрство фиксируется письменно, использование материалов — только в согласованных объёмах и с атрибуцией.</p>
          </div>
          <div class="hero-actions">
            <a class="button button-dark" href="/join/#contact">Обсудить партнёрство <span aria-hidden="true">→</span></a>
            <a class="button button-outline" href="/docs/rights-registry">Как мы работаем с правами</a>
          </div>
        </div>
      </section>
    </main>
<?php include __DIR__ . '/../inc/footer.php'; ?>
