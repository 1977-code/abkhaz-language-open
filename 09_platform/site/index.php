<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/inc/functions.php';
$c = cfg();
$lang = 'ru';
$nav_active = 'home';

$flash = $_SESSION['flash'] ?? null;
$old   = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);

render_head([
    'lang' => 'ru',
    'title' => 'Абхазский язык — современный курс с нуля',
    'description' => 'Современный курс абхазского языка для русскоговорящих: учебник A0–A2, аудио от носителей, словарь, корпус и цифровая платформа.',
    'canonical' => $c['base_url'] . '/',
    'preload_hero' => true,
]);
include __DIR__ . '/inc/header.php';
?>
    <main id="main">
      <section class="hero" id="top">
        <div class="container">
          <div class="hero-content">
            <h1>Абхазский язык</h1>
            <p class="hero-lead">Современный курс для русскоговорящих с нуля: учебник, аудио от носителей, словарь, корпус текстов и цифровая платформа.</p>
            <div class="hero-actions">
              <a class="button button-primary" href="/course/">Как устроен курс <span aria-hidden="true">→</span></a>
              <a class="button button-secondary" href="/join/">Присоединиться к проекту</a>
            </div>
            <p class="hero-note"><span class="pulse" aria-hidden="true"></span> Исследовательский этап завершён: источники собраны, методики разобраны, каркас модулей готов. Идёт формирование экспертной команды — тексты появятся после проверки носителями.</p>
          </div>
        </div>
      </section>

      <div class="signal-band" aria-label="Параметры первого продукта">
        <div class="container signals">
          <?php foreach ($c['stats'] as [$num, $label]): ?>
          <div class="signal"><strong><?= e($num) ?></strong><span><?= e($label) ?></span></div>
          <?php endforeach; ?>
        </div>
      </div>

      <section class="section" id="product">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--coral)">Не ещё один учебник</p>
              <h2>Единая система изучения языка</h2>
            </div>
            <p>Научные материалы по абхазскому существуют, но они разрознены и часто написаны для специалистов. Мы собираем понятную траекторию для человека без языковой среды: от первого звука до самостоятельного диалога.</p>
          </div>
          <div class="product-grid">
            <article class="product-card">
              <span class="card-number">01 / Учебный маршрут</span>
              <h3>Учебник и рабочая тетрадь</h3>
              <p>Постепенный курс A0–A2, затем B1. Диалоги, короткие тексты, упражнения, ключи и отдельный блок ошибок русскоговорящих.</p>
            </article>
            <article class="product-card">
              <span class="card-number">02 / Живая речь</span>
              <h3>Аудио от носителей</h3>
              <p>Фонетика, минимальные пары, слова и диалоги в медленном и естественном темпе. Каждая запись проходит языковую проверку.</p>
            </article>
            <article class="product-card">
              <span class="card-number">03 / Цифровая среда</span>
              <h3>Словарь, корпус и сайт</h3>
              <p>Частотное учебное ядро, проверенные примеры, поиск, интерактивные упражнения и в будущем — ограниченный AI-тьютор.</p>
            </article>
          </div>
          <div class="section-more"><a class="button button-outline" href="/course/">Подробнее о курсе и методике <span aria-hidden="true">→</span></a></div>
        </div>
      </section>

      <section class="section section-forest" id="roadmap">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: #9fdcb5">Открытый прогресс</p>
              <h2>Что уже сделано</h2>
            </div>
            <p>Мы не прячем проект за обещаниями. Методика, права, источники и производственный процесс ведутся в открытых документах. Публичный курс появится только после проверки носителями и научными редакторами.</p>
          </div>
          <div class="timeline">
            <div class="timeline-row"><span class="timeline-phase">Фундамент</span><strong>Аудит источников, правовая модель и архитектура проекта</strong><span class="status-pill status-done">Готово</span></div>
            <div class="timeline-row"><span class="timeline-phase">Исследование</span><strong>250+ источников собрано, 8 учебников и методик разобраны глубоко</strong><span class="status-pill status-done">Готово</span></div>
            <div class="timeline-row"><span class="timeline-phase">Методика</span><strong>Syllabus A0–A2, брифы модулей, справочник глагола и протокол пилота</strong><span class="status-pill status-done">Готово</span></div>
            <div class="timeline-row"><span class="timeline-phase">Корпус</span><strong>Официальные выгрузки Абхазского национального корпуса; учебное ядро покрывает 82% текста</strong><span class="status-pill status-done">Готово</span></div>
            <div class="timeline-row"><span class="timeline-phase">Экспертиза</span><strong>Проверка носителями, научная редактура и права партнёров</strong><span class="status-pill status-next">Следующий этап</span></div>
            <div class="timeline-row"><span class="timeline-phase">Производство</span><strong>Аудиозапись, первые уроки и пилот на русскоговорящих</strong><span class="status-pill status-next">После экспертизы</span></div>
          </div>
        </div>
      </section>

      <section class="section section-white" id="partners-teaser">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--sea)">Партнёры</p>
              <h2>Проект уже поддерживают</h2>
            </div>
            <p>Курс строится на разрешениях правообладателей и официальных корпусных данных — без «серых» материалов. Мы благодарны организациям, которые уже помогают проекту.</p>
          </div>
          <div class="partner-list">
            <article class="partner-card">
              <span class="role-tag">Тексты и аудио</span>
              <h3>Институт перевода Библии</h3>
              <p>Разрешил образовательное использование своих абхазских изданий — выверенных параллельных текстов и аудиозаписей.</p>
              <a href="/partners/">Все партнёры →</a>
            </article>
            <article class="partner-card">
              <span class="role-tag">Корпусные данные</span>
              <h3>Abkhaz National Corpus</h3>
              <p>Официальные частотные выгрузки корпуса в 12,6 млн словоупотреблений — основа учебного словаря курса.</p>
              <a href="/partners/">Все партнёры →</a>
            </article>
          </div>
        </div>
      </section>

      <section class="section" id="documents">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--gold)">Рабочие материалы</p>
              <h2>Документы проекта</h2>
            </div>
            <p>Здесь лежит не рекламная презентация, а реальная рабочая база: план, методика, права и протоколы проверки.</p>
          </div>
          <div class="docs-grid">
            <a class="doc-card" href="/docs/master-plan"><div><h3>Мастер-план</h3><p>Этапы от аудита до курса B1 и AI-слоя.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
            <a class="doc-card" href="/docs/syllabus"><div><h3>Syllabus A0–A2</h3><p>Речевые задачи, грамматика и контроль по главам.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
            <a class="doc-card" href="/docs/rights-registry"><div><h3>Реестр прав</h3><p>Какие материалы можно использовать и на каких условиях.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
            <a class="doc-card" href="/docs/open-data"><div><h3>Открытые данные</h3><p>Частотные списки из трёх корпусов: ABNC, Common Voice, Википедия.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
          </div>
          <div class="section-more"><a class="button button-outline" href="/docs/">Все документы <span aria-hidden="true">→</span></a></div>
        </div>
      </section>

      <section class="contact-band" id="contact">
        <div class="container contact-shell">
          <div>
            <h2>Язык сохраняется, когда на нём снова начинают говорить</h2>
            <p>Если вы носитель, преподаватель, исследователь, организация или просто хотите помочь проекту — напишите. Сообщение придёт напрямую инициатору проекта.</p>
            <p class="alt-mail">Или письмом: <a href="mailto:<?= e($c['contact_to']) ?>"><?= e($c['contact_to']) ?></a></p>
          </div>
          <?php include __DIR__ . '/inc/contact_form.php'; ?>
        </div>
      </section>
    </main>
<?php include __DIR__ . '/inc/footer.php'; ?>
