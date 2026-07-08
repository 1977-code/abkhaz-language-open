<?php
// Подвал сайта + кнопка «сделано силами 1977». Задать $lang.
$lang = $lang ?? 'ru';
$en = ($lang === 'en');
$c = cfg();
?>
    <footer>
      <div class="container">
        <div class="footer-grid">
          <div class="footer-about">
            <p class="footer-title"><?= $en ? '“The Abkhaz Language” open project' : 'Открытый проект «Абхазский язык»' ?></p>
            <p class="footer-desc"><?= $en
              ? 'A modern course for Russian-speaking learners: a textbook, native-speaker audio, a dictionary and a digital platform. Built in the open.'
              : 'Современный курс для русскоговорящих: учебник, аудио от носителей, словарь и цифровая платформа. Делается открыто.' ?></p>
          </div>
          <nav class="footer-nav" aria-label="<?= $en ? 'Footer' : 'Подвал' ?>">
            <?php if ($en): ?>
            <a href="/en/#product">What we build</a>
            <a href="/en/#participate">Get involved</a>
            <a href="/docs/">Documents (RU)</a>
            <a href="/docs/legal">Legal &amp; rights</a>
            <?php else: ?>
            <a href="/course/">Курс</a>
            <a href="/partners/">Партнёры</a>
            <a href="/docs/">Документы</a>
            <a href="/join/">Участие</a>
            <a href="/docs/legal">Правовая информация</a>
            <?php endif; ?>
          </nav>
          <div class="footer-contact">
            <a class="footer-mail" href="mailto:<?= e($c['contact_to']) ?>"><?= e($c['contact_to']) ?></a>
            <p class="footer-desc"><?= $en ? 'Or use the form on the main page.' : 'Или через форму на странице «Участие».' ?></p>
          </div>
        </div>
        <div class="footer-bottom">
          <span>© <?= (int)$c['year'] ?> · abkhlang.ru</span>
          <a class="madeby" href="https://artspace1977.ru" target="_blank" rel="noopener noreferrer"
             aria-label="artspace1977.ru — творческое сообщество 1977"
             title="<?= $en ? 'made by the 1977 creative community' : 'сделано силами творческого сообщества 1977' ?>">
            <span class="madeby-label"><?= $en ? 'made&nbsp;by' : 'сделано&nbsp;силами' ?></span>
            <img class="madeby-logo" src="/assets/logo-1977.png" alt="1977" width="54" height="20">
          </a>
        </div>
      </div>
    </footer>
  </body>
</html>
