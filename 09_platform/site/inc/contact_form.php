<?php
// Форма обратной связи. Ожидает в области видимости: $lang, $flash, $old; опционально $form_back ('/', '/en/', '/join/').
$lang = $lang ?? 'ru';
$en = ($lang === 'en');
$flash = $flash ?? null;
$old = $old ?? [];
$form_back = $form_back ?? ($en ? '/en/' : '/');
$ov = fn(string $k) => isset($old[$k]) ? e((string)$old[$k]) : '';
?>
          <form class="form" method="post" action="/contact.php" novalidate>
            <input type="hidden" name="lang" value="<?= $en ? 'en' : 'ru' ?>">
            <input type="hidden" name="back" value="<?= e($form_back) ?>">
            <?php if ($flash): ?>
              <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>"><?= e($flash['msg']) ?></div>
            <?php endif; ?>

            <div class="form-row">
              <label for="f-name"><?= $en ? 'Name' : 'Имя' ?></label>
              <input type="text" id="f-name" name="name" maxlength="100" required value="<?= $ov('name') ?>">
            </div>
            <div class="form-row">
              <label for="f-email">E-mail</label>
              <input type="email" id="f-email" name="email" maxlength="190" required value="<?= $ov('email') ?>">
            </div>
            <div class="form-row">
              <label for="f-role"><?= $en ? 'Who are you' : 'Кто вы' ?></label>
              <select id="f-role" name="role">
                <?php
                $opts = $en
                  ? ['native'=>'Native speaker / teacher','science'=>'Abkhaz scholar / methodologist','partner'=>'Partnership / organization','other'=>'Other']
                  : ['native'=>'Носитель / преподаватель','science'=>'Абхазовед / методист','partner'=>'Партнёрство / организация','other'=>'Другое'];
                foreach ($opts as $val => $txt):
                  $sel = (($old['role'] ?? '') === $val) ? ' selected' : '';
                ?>
                <option value="<?= e($val) ?>"<?= $sel ?>><?= e($txt) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-row">
              <label for="f-message"><?= $en ? 'Message' : 'Сообщение' ?></label>
              <textarea id="f-message" name="message" maxlength="4000" required><?= $ov('message') ?></textarea>
            </div>

            <div class="form-row hp" aria-hidden="true">
              <label for="f-website">Website</label>
              <input type="text" id="f-website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-row">
              <label class="consent">
                <input type="checkbox" name="consent" value="1" required>
                <span><?= $en
                  ? 'I consent to the processing of my personal data for the purpose of replying. See the '
                  : 'Я согласен на обработку персональных данных для ответа на обращение. См. ' ?><a href="/docs/legal"><?= $en ? 'legal &amp; privacy notice' : 'правовую информацию' ?></a>.</span>
              </label>
            </div>

            <button type="submit" class="button button-dark"><?= $en ? 'Send message' : 'Отправить сообщение' ?></button>
          </form>
