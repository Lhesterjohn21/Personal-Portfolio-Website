<?php
declare(strict_types=1);

function load_env_file(string $path): void
{
    if (!is_file($path) || !is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if ($trimmed === '' || str_starts_with($trimmed, '#') || !str_contains($trimmed, '=')) {
            continue;
        }

        [$key, $value] = array_map('trim', explode('=', $trimmed, 2));

        if ($key === '') {
            continue;
        }

        $value = trim($value, "\"'");

        if (getenv($key) === false) {
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

function env_value(string $key, ?string $default = null): ?string
{
    $value = getenv($key);

    if ($value === false || $value === '') {
        return $default;
    }

    return $value;
}

function esc_html(string $value): string
{
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function normalize_mail_password(string $value): string
{
        return str_replace(' ', '', trim($value));
}

function build_portfolio_email_html(string $name, string $email, string $subject, string $message): string
{
        $safeName = esc_html($name);
        $safeEmail = esc_html($email);
        $safeSubject = esc_html($subject);
        $safeMessage = nl2br(esc_html($message));

        return '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Inquiry</title>
</head>
<body style="margin:0;padding:0;background:#070b14;font-family:Arial,Helvetica,sans-serif;color:#e6edf7;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#070b14;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:680px;background:#0d1320;border:1px solid rgba(124,166,255,0.16);border-radius:20px;overflow:hidden;box-shadow:0 30px 80px rgba(0,0,0,0.45);">
                    <tr>
                        <td style="padding:26px 28px;background:linear-gradient(135deg,#111a2c,#0b1020);border-bottom:1px solid rgba(124,166,255,0.16);">
                            <div style="font-size:12px;letter-spacing:0.18em;color:#78c6ff;text-transform:uppercase;margin-bottom:10px;">John Lhester Arco</div>
                            <h1 style="margin:0;font-size:28px;line-height:1.1;color:#eef3ff;">New portfolio message</h1>
                            <p style="margin:10px 0 0;color:#a9b6d2;font-size:14px;line-height:1.7;">A new inquiry was submitted from your portfolio contact form.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:26px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:0 0 18px;">
                                        <div style="font-size:12px;letter-spacing:0.12em;text-transform:uppercase;color:#78c6ff;margin-bottom:6px;">Sender</div>
                                        <div style="font-size:18px;color:#eef3ff;font-weight:700;">' . $safeName . '</div>
                                        <div style="font-size:14px;color:#a9b6d2;margin-top:4px;">' . $safeEmail . '</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 0 18px;border-top:1px solid rgba(124,166,255,0.12);padding-top:18px;">
                                        <div style="font-size:12px;letter-spacing:0.12em;text-transform:uppercase;color:#78c6ff;margin-bottom:6px;">Subject</div>
                                        <div style="font-size:18px;color:#eef3ff;font-weight:700;">' . $safeSubject . '</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;border-top:1px solid rgba(124,166,255,0.12);padding-top:18px;">
                                        <div style="font-size:12px;letter-spacing:0.12em;text-transform:uppercase;color:#78c6ff;margin-bottom:10px;">Message</div>
                                        <div style="background:#0a101c;border:1px solid rgba(124,166,255,0.14);border-radius:16px;padding:18px 18px 20px;color:#d6deeb;line-height:1.8;font-size:15px;white-space:normal;">' . $safeMessage . '</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 28px;">
                            <div style="border-top:1px solid rgba(124,166,255,0.12);padding-top:18px;color:#95a2bf;font-size:13px;line-height:1.7;">
                                This email was sent from the John Lhester Arco portfolio contact form.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
}

function smtp_send_mail(array $config, string $to, string $subject, string $textBody, string $htmlBody, string $replyTo): bool
{
    $host = $config['host'] ?? '';
    $port = (int) ($config['port'] ?? 587);
    $username = $config['username'] ?? '';
        $password = normalize_mail_password((string) ($config['password'] ?? ''));
    $encryption = strtolower((string) ($config['encryption'] ?? 'tls'));
    $timeout = 15;

    if ($host === '' || $username === '' || $password === '' || $to === '') {
        return false;
    }

    $remote = ($encryption === 'ssl' || $port === 465)
        ? 'ssl://' . $host . ':' . $port
        : 'tcp://' . $host . ':' . $port;

    $socket = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT);

    if (!is_resource($socket)) {
        error_log('SMTP connect failed: ' . $errno . ' ' . $errstr);
        return false;
    }

    stream_set_timeout($socket, $timeout);

    $read = static function () use ($socket): string {
        $buffer = '';

        while (($line = fgets($socket, 515)) !== false) {
            $buffer .= $line;
            if (strlen($line) < 4 || $line[3] !== '-') {
                break;
            }
        }

        return $buffer;
    };

    $write = static function (string $command) use ($socket): void {
        fwrite($socket, $command . "\r\n");
    };

    $expect = static function (string $response, array $codes): bool {
        foreach ($codes as $code) {
            if (str_starts_with($response, (string) $code)) {
                return true;
            }
        }

        return false;
    };

    $response = $read();
    if (!$expect($response, [220])) {
        fclose($socket);
        return false;
    }

    $write('EHLO ' . (getenv('SERVER_NAME') ?: 'localhost'));
    $response = $read();

    if (!$expect($response, [250])) {
        fclose($socket);
        return false;
    }

    if ($encryption === 'tls' && $port !== 465) {
        $write('STARTTLS');
        $response = $read();

        if (!$expect($response, [220])) {
            fclose($socket);
            return false;
        }

        if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            fclose($socket);
            return false;
        }

        $write('EHLO ' . (getenv('SERVER_NAME') ?: 'localhost'));
        $response = $read();

        if (!$expect($response, [250])) {
            fclose($socket);
            return false;
        }
    }

    $write('AUTH LOGIN');
    $response = $read();
    if (!$expect($response, [334])) {
        fclose($socket);
        return false;
    }

    $write(base64_encode($username));
    $response = $read();
    if (!$expect($response, [334])) {
        fclose($socket);
        return false;
    }

    $write(base64_encode($password));
    $response = $read();
    if (!$expect($response, [235])) {
        fclose($socket);
        return false;
    }

    $fromName = $config['from_name'] ?? 'John Lhester Arco';
    $fromAddress = $config['from_address'] ?? $username;
    $boundary = '=_Portfolio_' . bin2hex(random_bytes(12));

    $headers = [
        'From: ' . $fromName . ' <' . $fromAddress . '>',
        'To: <' . $to . '>',
        'Reply-To: ' . $replyTo,
        'Subject: ' . $subject,
        'Date: ' . date(DATE_RFC2822),
        'MIME-Version: 1.0',
        'Content-Type: multipart/alternative; boundary="' . $boundary . '"',
    ];

    $messageData = implode("\r\n", $headers) . "\r\n\r\n";
    $messageData .= '--' . $boundary . "\r\n";
    $messageData .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $messageData .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $messageData .= $textBody . "\r\n\r\n";
    $messageData .= '--' . $boundary . "\r\n";
    $messageData .= "Content-Type: text/html; charset=UTF-8\r\n";
    $messageData .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $messageData .= $htmlBody . "\r\n\r\n";
    $messageData .= '--' . $boundary . "--";
    $messageData = preg_replace("/\r?\n/", "\r\n", (string) $messageData) ?? $messageData;

    $write('MAIL FROM:<' . $fromAddress . '>');
    $response = $read();
    if (!$expect($response, [250])) {
        fclose($socket);
        return false;
    }

    $write('RCPT TO:<' . $to . '>');
    $response = $read();
    if (!$expect($response, [250, 251])) {
        fclose($socket);
        return false;
    }

    $write('DATA');
    $response = $read();
    if (!$expect($response, [354])) {
        fclose($socket);
        return false;
    }

    $lines = preg_split("/\r\n|\r|\n/", $messageData) ?: [];
    foreach ($lines as $line) {
        if ($line !== '' && $line[0] === '.') {
            $line = '.' . $line;
        }

        $write($line);
    }

    $write('.');
    $response = $read();

    $write('QUIT');
    fclose($socket);

    return $expect($response, [250]);
}

function send_portfolio_mail(array $config, string $to, string $subject, string $textBody, string $htmlBody, string $replyTo): bool
{
    // Attempt 1: Port 465 SSL (Recommended for Render & cloud hosts)
    $config465 = $config;
    $config465['port'] = 465;
    $config465['encryption'] = 'ssl';
    if (smtp_send_mail($config465, $to, $subject, $textBody, $htmlBody, $replyTo)) {
        return true;
    }

    // Attempt 2: Port 587 TLS
    $config587 = $config;
    $config587['port'] = 587;
    $config587['encryption'] = 'tls';
    if (smtp_send_mail($config587, $to, $subject, $textBody, $htmlBody, $replyTo)) {
        return true;
    }

    // Attempt 3: Custom config as provided
    if (smtp_send_mail($config, $to, $subject, $textBody, $htmlBody, $replyTo)) {
        return true;
    }

    // Attempt 4: PHP native mail() fallback
    $fromName = $config['from_name'] ?? 'John Lhester Arco';
    $fromAddress = $config['from_address'] ?? ($config['username'] ?? 'johnlhesterarco21@gmail.com');
    $boundary = '=_Portfolio_' . bin2hex(random_bytes(12));

    $headers = [
        'From: ' . $fromName . ' <' . $fromAddress . '>',
        'Reply-To: ' . $replyTo,
        'MIME-Version: 1.0',
        'Content-Type: multipart/alternative; boundary="' . $boundary . '"',
    ];

    $messageData = '--' . $boundary . "\r\n";
    $messageData .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
    $messageData .= $textBody . "\r\n\r\n";
    $messageData .= '--' . $boundary . "\r\n";
    $messageData .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
    $messageData .= $htmlBody . "\r\n\r\n";
    $messageData .= '--' . $boundary . "--";

    return @mail($to, $subject, $messageData, implode("\r\n", $headers));
}

load_env_file(__DIR__ . '/.env');

function redirect_back_with_status(string $status): never
{
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    $fallback = '/index.html';

    if ($referer !== '') {
        $parts = parse_url($referer);

        if (is_array($parts) && isset($parts['path'])) {
            $scheme = $parts['scheme'] ?? '';
            $host = $parts['host'] ?? '';
            $port = isset($parts['port']) ? ':' . $parts['port'] : '';
            $path = $parts['path'];
            $query = [];

            if (!empty($parts['query'])) {
                parse_str($parts['query'], $query);
            }

            $query['mail'] = $status;
            $fragment = $parts['fragment'] ?? 'contact';
            $target = $path . '?' . http_build_query($query);

            if ($fragment !== '') {
                $target .= '#' . $fragment;
            }

            if ($scheme !== '') {
                $target = $scheme . '://' . $host . $port . $target;
            }

            header('Location: ' . $target, true, 303);
            exit;
        }
    }

    header('Location: ' . $fallback . '?mail=' . rawurlencode($status) . '#contact', true, 303);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    redirect_back_with_status('error');
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$subject = trim((string) ($_POST['subject'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $subject === '' || $message === '') {
    redirect_back_with_status('error');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_back_with_status('error');
}

$to = env_value('MAIL_TO_ADDRESS', 'johnlhesterarco21@gmail.com') ?? 'johnlhesterarco21@gmail.com';
$defaultMailUser = 'johnlhesterarco21@gmail.com';
$defaultMailPass = 'lmmd nywx dijc ynij';

$smtpConfig = [
    'host' => env_value('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env_value('MAIL_PORT', '465'),
    'username' => env_value('MAIL_USERNAME', $defaultMailUser),
    'password' => env_value('MAIL_PASSWORD', $defaultMailPass),
    'encryption' => env_value('MAIL_ENCRYPTION', 'ssl'),
    'from_name' => env_value('MAIL_FROM_NAME', 'John Lhester Arco'),
    'from_address' => env_value('MAIL_FROM_ADDRESS', env_value('MAIL_USERNAME', $defaultMailUser)),
];

if ($smtpConfig['host'] === '' || $smtpConfig['username'] === '' || $smtpConfig['password'] === '') {
    redirect_back_with_status('config');
}

$mailSubject = 'Portfolio Inquiry: ' . $subject;
$textBody = implode("\r\n", [
    'You received a new portfolio message.',
    '',
    'Name: ' . $name,
    'Email: ' . $email,
    'Subject: ' . $subject,
    '',
    'Message:',
    $message,
]);

$htmlBody = build_portfolio_email_html($name, $email, $subject, $message);

$sent = send_portfolio_mail($smtpConfig, $to, $mailSubject, $textBody, $htmlBody, $email);

redirect_back_with_status($sent ? 'sent' : 'failed');
