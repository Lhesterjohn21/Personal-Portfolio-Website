<?php
declare(strict_types=1);

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    if (file_exists(__DIR__ . '/lib/phpmailer/Exception.php')) {
        require_once __DIR__ . '/lib/phpmailer/Exception.php';
        require_once __DIR__ . '/lib/phpmailer/PHPMailer.php';
        require_once __DIR__ . '/lib/phpmailer/SMTP.php';
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
        return (string) $_ENV[$key];
    }

    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
        return (string) $_SERVER[$key];
    }

    $value = getenv($key);

    if ($value !== false && $value !== '') {
        return (string) $value;
    }

    return $default;
}

function esc_html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function sanitize_env_string(?string $val): string
{
    if ($val === null) {
        return '';
    }
    return trim($val, " \t\n\r\0\x0B\"'");
}

function normalize_mail_password(string $value): string
{
    return str_replace(' ', '', trim($value, " \t\n\r\0\x0B\"'"));
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

function smtp_send_mail(array $config, string $to, string $subject, string $textBody, string $htmlBody, string $replyTo, string &$errorMsg = ''): bool
{
    $host = $config['host'] ?? 'smtp.gmail.com';
    $port = (int) ($config['port'] ?? 587);
    $username = $config['username'] ?? 'johnlhesterarco21@gmail.com';
    $password = normalize_mail_password((string) ($config['password'] ?? ''));
    $encryption = strtolower((string) ($config['encryption'] ?? 'tls'));
    $timeout = 15;

    if ($host === '' || $username === '' || $password === '' || $to === '') {
        $errorMsg = 'Socket: Missing SMTP parameters';
        error_log('Custom SMTP Error: ' . $errorMsg);
        return false;
    }

    $remote = ($encryption === 'ssl' || $port === 465)
        ? 'ssl://' . $host . ':' . $port
        : 'tcp://' . $host . ':' . $port;

    $socket = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT);

    if (!is_resource($socket)) {
        $errorMsg = "Socket connect failed [$errno]: $errstr";
        error_log($errorMsg);
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
        $errorMsg = 'Socket Greeting: ' . trim($response);
        error_log($errorMsg);
        fclose($socket);
        return false;
    }

    $write('EHLO ' . (getenv('SERVER_NAME') ?: 'localhost'));
    $response = $read();

    if (!$expect($response, [250])) {
        $errorMsg = 'Socket EHLO: ' . trim($response);
        error_log($errorMsg);
        fclose($socket);
        return false;
    }

    if ($encryption === 'tls' && $port !== 465) {
        $write('STARTTLS');
        $response = $read();

        if (!$expect($response, [220])) {
            $errorMsg = 'Socket STARTTLS: ' . trim($response);
            error_log($errorMsg);
            fclose($socket);
            return false;
        }

        if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            $errorMsg = 'Socket TLS handshake failed';
            error_log($errorMsg);
            fclose($socket);
            return false;
        }

        $write('EHLO ' . (getenv('SERVER_NAME') ?: 'localhost'));
        $response = $read();

        if (!$expect($response, [250])) {
            $errorMsg = 'Socket EHLO post-TLS: ' . trim($response);
            error_log($errorMsg);
            fclose($socket);
            return false;
        }
    }

    $write('AUTH LOGIN');
    $response = $read();
    if (!$expect($response, [334])) {
        $errorMsg = 'Socket AUTH LOGIN: ' . trim($response);
        error_log($errorMsg);
        fclose($socket);
        return false;
    }

    $write(base64_encode($username));
    $response = $read();
    if (!$expect($response, [334])) {
        $errorMsg = 'Socket Username: ' . trim($response);
        error_log($errorMsg);
        fclose($socket);
        return false;
    }

    $write(base64_encode($password));
    $response = $read();
    if (!$expect($response, [235])) {
        $errorMsg = 'Socket Auth Failed: ' . trim($response);
        error_log($errorMsg);
        fclose($socket);
        return false;
    }

    $fromName = $config['from_name'] ?? 'John Lhester Arco';
    $fromAddress = $username; // Use authenticated Gmail username to prevent 550 sender errors
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
        $errorMsg = 'Socket MAIL FROM: ' . trim($response);
        error_log($errorMsg);
        fclose($socket);
        return false;
    }

    $write('RCPT TO:<' . $to . '>');
    $response = $read();
    if (!$expect($response, [250, 251])) {
        $errorMsg = 'Socket RCPT TO: ' . trim($response);
        error_log($errorMsg);
        fclose($socket);
        return false;
    }

    $write('DATA');
    $response = $read();
    if (!$expect($response, [354])) {
        $errorMsg = 'Socket DATA: ' . trim($response);
        error_log($errorMsg);
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

    $ok = $expect($response, [250]);
    if (!$ok) {
        $errorMsg = 'Socket Final Send: ' . trim($response);
    }
    return $ok;
}

function send_email_via_phpmailer(array $config, string $to, string $subject, string $textBody, string $htmlBody, string $replyTo, string $replyName = '', string &$errorMsg = ''): bool
{
    if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        $errorMsg = 'PHPMailer class missing';
        error_log($errorMsg);
        return false;
    }

    $primaryPort = (int)($config['port'] ?? 587);
    $primaryEnc = strtolower((string)($config['encryption'] ?? 'tls'));

    $attempts = [
        ['port' => $primaryPort, 'encryption' => $primaryEnc],
        ['port' => 465, 'encryption' => 'ssl'],
        ['port' => 587, 'encryption' => 'tls'],
    ];

    $tried = [];
    $errors = [];

    foreach ($attempts as $attempt) {
        $port = $attempt['port'];
        $encryption = $attempt['encryption'];
        $key = $port . '-' . $encryption;

        if (isset($tried[$key])) {
            continue;
        }
        $tried[$key] = true;

        try {
            $mail = new PHPMailer(true);

            // Enable detailed SMTP output printed directly to error_log (visible in Render logs)
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Level 2
            $mail->Debugoutput = static function (string $str, int $level): void {
                error_log("PHPMailer SMTP [$level]: $str");
            };

            $mail->isSMTP();
            $mail->Host       = $config['host'] ?? 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['username'] ?? 'johnlhesterarco21@gmail.com';
            $mail->Password   = normalize_mail_password((string)($config['password'] ?? ''));

            if ($encryption === 'ssl' || $port === 465) {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
            }

            $mail->Timeout    = 15;
            $mail->CharSet    = 'UTF-8';

            // Permissive SSL options for cloud containers (Render / Docker)
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            $fromName = !empty($config['from_name']) ? $config['from_name'] : 'John Lhester Arco';

            // Always use authenticated Gmail address for setFrom to satisfy Gmail strict policy
            $mail->setFrom($config['username'], $fromName);
            $mail->addAddress($to);

            if ($replyTo !== '') {
                $mail->addReplyTo($replyTo, $replyName);
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = $textBody;

            if ($mail->send()) {
                return true;
            }
        } catch (Exception $e) {
            $err = "Port $port: " . $e->getMessage();
            $errors[] = $err;
            error_log("PHPMailer Attempt ($key) Exception: " . $e->getMessage() . ' | ErrorInfo: ' . ($mail->ErrorInfo ?? 'N/A'));
        }
    }

    $errorMsg = implode('; ', $errors);
    return false;
}

load_env_file(__DIR__ . '/.env');

function redirect_back_with_status(string $status, string $reason = ''): never
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
            if ($reason !== '') {
                $query['reason'] = $reason;
            }
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

    $target = $fallback . '?mail=' . rawurlencode($status);
    if ($reason !== '') {
        $target .= '&reason=' . rawurlencode($reason);
    }
    $target .= '#contact';

    header('Location: ' . $target, true, 303);
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

// Extract and sanitize raw environment variables with auto-correction for common typos
$rawHost = sanitize_env_string(env_value('MAIL_HOST', 'smtp.gmail.com'));
if ($rawHost === '' || str_contains($rawHost, 'smto')) {
    $rawHost = 'smtp.gmail.com';
}

$rawPort = (int) sanitize_env_string(env_value('MAIL_PORT', '587'));
if ($rawPort !== 587 && $rawPort !== 465 && $rawPort !== 25) {
    $rawPort = 587;
}

$rawUsername = sanitize_env_string(env_value('MAIL_USERNAME', 'johnlhesterarco21@gmail.com'));
if ($rawUsername === '') {
    $rawUsername = 'johnlhesterarco21@gmail.com';
}

$rawPassword = normalize_mail_password(env_value('MAIL_PASSWORD', 'zkylrvfrbxhhumwo') ?? 'zkylrvfrbxhhumwo');
if ($rawPassword === '') {
    $rawPassword = 'zkylrvfrbxhhumwo';
}

$to = sanitize_env_string(env_value('MAIL_TO_ADDRESS', 'johnlhesterarco21@gmail.com')) ?: 'johnlhesterarco21@gmail.com';

$smtpConfig = [
    'host' => $rawHost,
    'port' => $rawPort,
    'username' => $rawUsername,
    'password' => $rawPassword,
    'encryption' => sanitize_env_string(env_value('MAIL_ENCRYPTION', 'tls')) ?: 'tls',
    'from_name' => sanitize_env_string(env_value('MAIL_FROM_NAME', 'John Lhester Arco')) ?: 'John Lhester Arco',
    'from_address' => sanitize_env_string(env_value('MAIL_FROM_ADDRESS', $rawUsername)) ?: $rawUsername,
];

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

function send_email_via_https_api(string $name, string $email, string $subject, string $message, string $htmlBody, string &$errorMsg = ''): bool
{
    $webhookUrl = env_value('MAIL_WEBHOOK_URL', '');
    $resendKey = env_value('RESEND_API_KEY', '');
    $web3Key = env_value('WEB3FORMS_ACCESS_KEY', '');

    // 1. Google Apps Script WebApp or Custom Webhook URL
    if ($webhookUrl !== '') {
        $payload = json_encode([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'htmlBody' => $htmlBody,
            'to' => 'johnlhesterarco21@gmail.com'
        ]);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);
        curl_close($ch);

        if ($curlErr !== '') {
            $errorMsg = "Webhook cURL Error: $curlErr";
            return false;
        }

        if ($httpCode >= 200 && $httpCode < 300) {
            return true;
        }

        $errorMsg = "Webhook HTTP $httpCode: " . substr((string)$response, 0, 100);
        return false;
    }

    // 2. Resend HTTPS API (api.resend.com)
    if ($resendKey !== '') {
        $payload = json_encode([
            'from' => 'Portfolio Inquiry <onboarding@resend.dev>',
            'to' => ['johnlhesterarco21@gmail.com'],
            'reply_to' => $email,
            'subject' => 'Portfolio Inquiry: ' . $subject,
            'html' => $htmlBody,
        ]);

        $ch = curl_init('https://api.resend.com/emails');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $resendKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);
        curl_close($ch);

        if ($curlErr !== '') {
            $errorMsg = "Resend cURL Error: $curlErr";
            return false;
        }

        if ($httpCode >= 200 && $httpCode < 300) {
            return true;
        }

        $errorMsg = "Resend HTTP $httpCode: " . substr((string)$response, 0, 100);
        return false;
    }

    // 3. Web3Forms HTTPS API (api.web3forms.com)
    if ($web3Key !== '') {
        $payload = json_encode([
            'access_key' => $web3Key,
            'name' => $name,
            'email' => $email,
            'subject' => 'Portfolio Inquiry: ' . $subject,
            'message' => $message,
        ]);

        $ch = curl_init('https://api.web3forms.com/submit');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);
        curl_close($ch);

        if ($curlErr !== '') {
            $errorMsg = "Web3Forms cURL Error: $curlErr";
            return false;
        }

        if ($httpCode >= 200 && $httpCode < 300) {
            return true;
        }

        $errorMsg = "Web3Forms HTTP $httpCode: " . substr((string)$response, 0, 100);
        return false;
    }

    $errorMsg = 'HTTPS API: Set WEB3FORMS_ACCESS_KEY, RESEND_API_KEY, or MAIL_WEBHOOK_URL in Render';
    return false;
}

$lastError = '';

// Attempt 1: PHPMailer (uses bundled lib/phpmailer)
$sent = send_email_via_phpmailer($smtpConfig, $to, $mailSubject, $textBody, $htmlBody, $email, $name, $lastError);

// Attempt 2: Custom raw socket fallback
if (!$sent) {
    $socketError = '';
    error_log('PHPMailer failed (' . $lastError . '). Attempting custom socket fallback...');
    $sent = smtp_send_mail($smtpConfig, $to, $mailSubject, $textBody, $htmlBody, $email, $socketError);
    if (!$sent) {
        $lastError = 'SMTP: [' . $lastError . ' | ' . $socketError . ']';
    }
}

// Attempt 3: HTTPS API Fallback (Bypasses Render outbound SMTP socket port blocks over Port 443)
if (!$sent) {
    $apiError = '';
    error_log('SMTP failed. Attempting HTTPS API fallback...');
    $sent = send_email_via_https_api($name, $email, $subject, $message, $htmlBody, $apiError);
    if (!$sent) {
        $lastError .= ' | ' . $apiError;
    }
}

if (!$sent) {
    error_log('Email sending failed completely: ' . $lastError);
    redirect_back_with_status('failed', $lastError);
}

redirect_back_with_status('sent');
