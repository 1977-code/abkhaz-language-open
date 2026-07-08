<?php
// Роутер документов: /docs/<slug> → docs/<slug>.fragment.html в общий шаблон.
// Без slug (/docs/) — хаб со списком всех документов.
declare(strict_types=1);
require __DIR__ . '/../inc/functions.php';
$c = cfg();

$slug = (string)($_GET['p'] ?? '');
$slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($slug));   // только безопасные slug

// ---------- Хаб /docs/ ----------
if ($slug === '') {
    $lang = 'ru';
    $nav_active = 'docs';
    $docs = [
        ['master-plan',             'Мастер-план',            'Этапы проекта от аудита источников до курса B1 и AI-слоя.'],
        ['concept-note',            'Концепция',              'Зачем нужен новый курс и чем он отличается от существующих.'],
        ['syllabus',                'Syllabus A0–A2',         'Речевые задачи, грамматика и контроль по главам.'],
        ['native-review-guide',     'Гайд для носителя',      'Как проверять естественность, регистр и варианты речи.'],
        ['scientific-review-guide', 'Научная редактура',      'Как проверяются норма, грамматика и подача материала.'],
        ['pilot-protocol',          'Протокол пилота',        'Как тестировать первые уроки на новичках.'],
        ['rights-registry',         'Реестр прав',            'Какие материалы можно использовать и на каких условиях.'],
        ['open-data',               'Открытые данные',        'Частотные списки из трёх корпусов: ABNC, Common Voice, Википедия.'],
        ['lesson-data-schema',      'Схема данных урока',     'Как устроены данные глав для цифровой платформы.'],
        ['recording-brief-l00-l04', 'Бриф аудиозаписи',       'Техническое задание на запись модулей 0–4.'],
        ['legal',                   'Правовая информация',    'Оператор проекта, персональные данные и права на материалы.'],
    ];
    render_head([
        'lang' => 'ru',
        'title' => 'Документы проекта — Абхазский язык',
        'description' => 'Рабочие документы открытого проекта «Абхазский язык»: план, методика, права, протоколы проверки и открытые данные.',
        'canonical' => $c['base_url'] . '/docs/',
    ]);
    include __DIR__ . '/../inc/header.php';
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <p class="eyebrow" style="color:#9fdcb5">Документы</p>
          <h1 class="page-title">Рабочая база проекта</h1>
          <p class="page-lead">Не рекламная презентация, а реальные рабочие документы: план, методика, права и протоколы проверки. Всё открыто.</p>
        </div>
      </section>
      <section class="section">
        <div class="container">
          <div class="docs-grid">
            <?php foreach ($docs as [$s, $t, $d]): ?>
            <a class="doc-card" href="/docs/<?= e($s) ?>"><div><h3><?= e($t) ?></h3><p><?= e($d) ?></p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
    <?php
    include __DIR__ . '/../inc/footer.php';
    exit;
}

// ---------- Страница документа /docs/<slug> ----------
$fragment = __DIR__ . '/' . $slug . '.fragment.html';

if (!is_file($fragment)) {
    http_response_code(404);
    require __DIR__ . '/../404.php';
    exit;
}

$html = file_get_contents($fragment);

// Заголовок документа — из первого <h1>.
$title = 'Документ проекта';
if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $html, $m)) {
    $title = trim(strip_tags($m[1]));
}

render_head([
    'lang' => 'ru',
    'title' => $title . ' — Абхазский язык',
    'description' => $title . ' — рабочий документ открытого проекта «Абхазский язык».',
    'canonical' => $c['base_url'] . '/docs/' . $slug,
]);
?>
  <body>
    <header class="doc-topbar">
      <div class="doc-topbar-shell">
        <a class="brand" href="/"><span class="brand-script">Аҧсуа</span> <span class="brand-ru">Абхазский язык</span></a>
        <a href="/docs/">← Все документы</a>
      </div>
    </header>
    <main class="doc-main" id="main">
<?= $html ?>
    </main>
    <footer class="doc-foot">
      Рабочий документ открытого проекта «Абхазский язык» · <a href="/">abkhlang.ru</a>
      <a class="madeby" href="https://artspace1977.ru" target="_blank" rel="noopener noreferrer" title="сделано силами творческого сообщества 1977">
        <span class="madeby-label">сделано&nbsp;силами</span>
        <img class="madeby-logo" src="/assets/logo-1977-dark.png" alt="1977" width="48" height="18" style="height:15px">
      </a>
    </footer>
  </body>
</html>
