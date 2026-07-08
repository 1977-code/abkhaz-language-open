<?php
// Обработчик формы обратной связи. PRG-паттерн + flash в сессии.
// 152-ФЗ: данные обрабатываются на российском хостинге, только с согласия,
// используются исключительно для ответа и не передаются третьим лицам.
declare(strict_types=1);
session_start();
require __DIR__ . '/inc/functions.php';
$c = cfg();

$lang = (($_POST['lang'] ?? 'ru') === 'en') ? 'en' : 'ru';
// Возврат на страницу, с которой отправлена форма (строгий белый список).
$allowedBack = ['/', '/en/', '/join/'];
$backPage = (string)($_POST['back'] ?? '');
if (!in_array($backPage, $allowedBack, true)) {
    $backPage = $lang === 'en' ? '/en/' : '/';
}
$back = $backPage . '#contact';

function redirect_back(string $back): void { header('Location: ' . $back, true, 303); exit; }

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') { redirect_back($back); }

// Honeypot: скрытое поле должно остаться пустым.
if (trim((string)($_POST['website'] ?? '')) !== '') {
    $_SESSION['flash'] = ['type' => 'success', 'msg' => $lang === 'en' ? 'Thank you, your message has been sent.' : 'Спасибо, сообщение отправлено.'];
    redirect_back($back);
}

$name    = trim((string)($_POST['name'] ?? ''));
$email   = trim((string)($_POST['email'] ?? ''));
$role    = trim((string)($_POST['role'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));
$consent = isset($_POST['consent']);

$errors = [];
if ($name === '' || mb_strlen($name) > 100)  { $errors[] = $lang === 'en' ? 'Please enter your name.' : 'Укажите имя.'; }
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = $lang === 'en' ? 'Please enter a valid email.' : 'Укажите корректный e-mail.'; }
if ($message === '' || mb_strlen($message) > 4000) { $errors[] = $lang === 'en' ? 'Please enter a message.' : 'Напишите сообщение.'; }
if (!$consent) { $errors[] = $lang === 'en' ? 'Consent to data processing is required.' : 'Нужно согласие на обработку персональных данных.'; }

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'msg' => implode(' ', $errors)];
    $_SESSION['old'] = ['name' => $name, 'email' => $email, 'role' => $role, 'message' => $message];
    redirect_back($back);
}

// Сборка письма.
$roles_map = [
    'native'  => 'Носитель / преподаватель',
    'science' => 'Абхазовед / методист',
    'partner' => 'Партнёрство / организация',
    'other'   => 'Другое',
];
$role_label = $roles_map[$role] ?? '—';

$subject = '=?UTF-8?B?' . base64_encode('Сайт abkhlang.ru — ' . $role_label) . '?=';
$body = "Новое сообщение с формы на abkhlang.ru\n\n"
      . "Имя: {$name}\n"
      . "E-mail: {$email}\n"
      . "Роль: {$role_label}\n"
      . "Язык формы: {$lang}\n"
      . "Время: " . date('Y-m-d H:i:s') . "\n"
      . "IP: " . ($_SERVER['REMOTE_ADDR'] ?? '—') . "\n\n"
      . "Сообщение:\n{$message}\n";

$headers   = [];
$headers[] = 'From: ' . $c['site_name'] . ' <' . $c['mail_from'] . '>';
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'Content-Type: text/plain; charset=UTF-8';
$headers[] = 'X-Mailer: PHP/abkhlang';

// 1) Надёжный захват: пишем обращение в журнал вне webroot (не теряем, даже без MTA).
$logged = false;
if (!empty($c['inbox_file'])) {
    $record = json_encode([
        'ts' => date('c'),
        'name' => $name, 'email' => $email, 'role' => $role_label,
        'lang' => $lang, 'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
        'message' => $message,
    ], JSON_UNESCAPED_UNICODE);
    $logged = @file_put_contents($c['inbox_file'], $record . "\n", FILE_APPEND | LOCK_EX) !== false;
}

// 2) Best-effort уведомление по почте (может не работать без MTA — не критично).
$mailed = @mail($c['contact_to'], $subject, $body, implode("\r\n", $headers));

if ($logged || $mailed) {
    $_SESSION['flash'] = ['type' => 'success', 'msg' => $lang === 'en'
        ? 'Thank you! Your message has been sent — we will reply by email.'
        : 'Спасибо! Сообщение отправлено — ответим по электронной почте.'];
    unset($_SESSION['old']);
} else {
    $_SESSION['flash'] = ['type' => 'error', 'msg' => $lang === 'en'
        ? 'Sorry, the message could not be sent. Please write to ' . $c['contact_to'] . '.'
        : 'Не удалось отправить сообщение. Напишите, пожалуйста, на ' . $c['contact_to'] . '.'];
    $_SESSION['old'] = ['name' => $name, 'email' => $email, 'role' => $role, 'message' => $message];
}
redirect_back($back);
