<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/../inc/functions.php';
$c = cfg();
$lang = 'ru';
$nav_active = 'join';

$flash = $_SESSION['flash'] ?? null;
$old   = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);

render_head([
    'lang' => 'ru',
    'title' => 'Участие — Абхазский язык',
    'description' => 'Как помочь курсу абхазского языка: носители и преподаватели, абхазоведы и методисты, партнёрские организации. Форма связи.',
    'canonical' => $c['base_url'] . '/join/',
]);
include __DIR__ . '/../inc/header.php';
?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <p class="eyebrow" style="color:#9fdcb5">Участие</p>
          <h1 class="page-title">Язык сохраняется, когда<br>на нём снова говорят</h1>
          <p class="page-lead">Главный следующий шаг проекта — команда, способная проверить язык и записать живую речь. Участие можно начать с одной консультации или одного небольшого блока.</p>
        </div>
      </section>

      <section class="section" id="roles">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--coral)">Роли</p>
              <h2>Кого мы ищем сейчас</h2>
            </div>
            <p>Проект некоммерческий и открытый: все методические документы опубликованы, вклад каждого участника фиксируется и указывается. Формат участия обсуждаем индивидуально — от разовой проверки до постоянной роли.</p>
          </div>
          <div class="roles-grid">
            <article class="role-card">
              <span class="role-tag">Язык</span>
              <h3>Носители и преподаватели</h3>
              <p>Проверка диалогов, бытовых формул, регистра и естественности речи. Отдельно нужны мужские и женские голоса для записи аудио.</p>
              <a href="#contact">Предложить помощь →</a>
            </article>
            <article class="role-card">
              <span class="role-tag">Наука</span>
              <h3>Абхазоведы и методисты</h3>
              <p>Литературная норма, фонетика, глагольные модели, диалектные пометы и порядок подачи материала для новичка.</p>
              <a href="#contact">Стать консультантом →</a>
            </article>
            <article class="role-card">
              <span class="role-tag">Партнёрство</span>
              <h3>Архивы, медиа и организации</h3>
              <p>Правочистые тексты, фрагменты живой речи, корпусные данные, площадки для пилота и институциональная поддержка.</p>
              <a href="#contact">Обсудить партнёрство →</a>
            </article>
          </div>
        </div>
      </section>

      <section class="section section-white" id="expect">
        <div class="container">
          <div class="section-heading">
            <div>
              <p class="eyebrow" style="color: var(--sea)">Как это устроено</p>
              <h2>Что вас ждёт после письма</h2>
            </div>
            <p>Никакой бюрократии: сообщение приходит напрямую инициатору проекта, ответ — в течение пары дней. Дальше — короткий созвон или переписка, где мы согласуем удобный формат и объём участия.</p>
          </div>
          <ol class="chapter-flow">
            <li><strong>Вы пишете</strong> — через форму ниже или на почту, парой фраз о себе.</li>
            <li><strong>Мы отвечаем</strong> и присылаем короткий понятный материал: что именно нужно проверить или обсудить.</li>
            <li><strong>Пробный блок.</strong> Одна консультация или один небольшой фрагмент — чтобы понять, комфортно ли работать вместе.</li>
            <li><strong>Постоянный ритм</strong> — только если вам удобно. Вклад фиксируется и указывается в материалах курса.</li>
          </ol>
        </div>
      </section>

      <section class="contact-band" id="contact">
        <div class="container contact-shell">
          <div>
            <h2>Напишите нам</h2>
            <p>Если вы носитель, преподаватель, исследователь, организация или просто хотите помочь проекту — напишите. Сообщение придёт напрямую инициатору проекта.</p>
            <p class="alt-mail">Или письмом: <a href="mailto:<?= e($c['contact_to']) ?>"><?= e($c['contact_to']) ?></a></p>
          </div>
          <?php $form_back = '/join/'; include __DIR__ . '/../inc/contact_form.php'; ?>
        </div>
      </section>
    </main>
<?php include __DIR__ . '/../inc/footer.php'; ?>
