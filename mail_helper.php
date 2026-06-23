<?php
// mail_helper.php
// Custom email sending function via Gmail SMTP (no external library required)

// =====================================================
// GMAIL SMTP CONFIGURATION
// Replace these with your actual Gmail credentials.
// For Gmail, use an App Password (not your main password).
// How to get App Password:
//   1. Enable 2-Step Verification on your Google account
//   2. Go to: myaccount.google.com > Security > App passwords
//   3. Generate a password for "Mail" and paste it below
// =====================================================
define('SMTP_HOST',     'smtp.gmail.com');
define('SMTP_PORT',     587);
define('SMTP_USER',     'anggarenosugiarto@gmail.com'); // Gmail pengirim
define('SMTP_PASS',     'foff swrx kdop hbpe');       // Ganti dengan App Password 16 karakter
define('SMTP_FROM',     'anggarenosugiarto@gmail.com');
define('SMTP_FROM_NAME','PT Adra Cipta Chemindo');
define('MAIL_TO',       'anggarenosugiarto@gmail.com');


/**
 * Sends an email via Gmail SMTP using PHP sockets (STARTTLS).
 * No external library or Composer required.
 */
function send_contact_email($name, $email, $subject, $message) {
    // Build HTML email body
    $email_body  = "<!DOCTYPE html><html><head><meta charset='UTF-8'>";
    $email_body .= "<style>";
    $email_body .= "body{font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;background:#f8fafc;padding:20px}";
    $email_body .= ".card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;max-width:600px;margin:0 auto;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0,0,0,.1)}";
    $email_body .= ".hdr{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;padding:24px;text-align:center}";
    $email_body .= ".hdr h2{margin:0;font-size:20px;font-weight:600}";
    $email_body .= ".body{padding:24px}";
    $email_body .= ".field{margin-bottom:20px;border-bottom:1px solid #f1f5f9;padding-bottom:15px}";
    $email_body .= ".field:last-child{border-bottom:none;padding-bottom:0;margin-bottom:0}";
    $email_body .= ".label{font-size:13px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px}";
    $email_body .= ".value{font-size:15px;color:#0f172a}";
    $email_body .= ".footer{font-size:12px;color:#94a3b8;text-align:center;padding:16px;background:#f1f5f9;border-top:1px solid #e2e8f0}";
    $email_body .= "</style></head><body>";
    $email_body .= "<div class='card'>";
    $email_body .= "  <div class='hdr'><h2>Pesan Baru - PT Adra Cipta Chemindo</h2></div>";
    $email_body .= "  <div class='body'>";
    $email_body .= "    <div class='field'><div class='label'>Nama Pengirim</div><div class='value'>" . htmlspecialchars($name) . "</div></div>";
    $email_body .= "    <div class='field'><div class='label'>Email Pengirim</div><div class='value'>" . htmlspecialchars($email) . "</div></div>";
    $email_body .= "    <div class='field'><div class='label'>Subjek</div><div class='value'>" . htmlspecialchars($subject) . "</div></div>";
    $email_body .= "    <div class='field'><div class='label'>Pesan</div><div class='value'>" . nl2br(htmlspecialchars($message)) . "</div></div>";
    $email_body .= "  </div>";
    $email_body .= "  <div class='footer'>Email ini dikirim otomatis via Formulir Kontak PT Adra Cipta Chemindo.</div>";
    $email_body .= "</div></body></html>";

    // Build full email headers
    $to_name   = MAIL_TO;
    $boundary  = md5(uniqid(time()));
    $msg_headers  = "Date: " . date('r') . "\r\n";
    $msg_headers .= "To: <" . MAIL_TO . ">\r\n";
    $msg_headers .= "From: " . mime_encode(SMTP_FROM_NAME) . " <" . SMTP_FROM . ">\r\n";
    $msg_headers .= "Reply-To: " . mime_encode($name) . " <" . $email . ">\r\n";
    $msg_headers .= "Subject: " . mime_encode("Pertanyaan Produk ACC: " . $subject) . "\r\n";
    $msg_headers .= "MIME-Version: 1.0\r\n";
    $msg_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $msg_headers .= "Content-Transfer-Encoding: base64\r\n";
    $msg_headers .= "\r\n";
    $msg_headers .= chunk_split(base64_encode($email_body));

    $result  = smtp_send_mail(SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, SMTP_FROM, MAIL_TO, $msg_headers);
    $success = ($result === true);

    // Write to local log for verification
    write_email_log($name, $email, $subject, $message, $success, $result);

    return $success;
}


/**
 * Core SMTP connection function using fsockopen + STARTTLS
 * Works with Gmail on port 587 without any external libraries.
 *
 * @return true|string  Returns true on success, or an error string on failure.
 */
function smtp_send_mail($host, $port, $username, $password, $from, $to, $message_data) {
    // Open a TCP connection to Gmail SMTP
    $errno  = 0;
    $errstr = '';
    $conn   = @fsockopen($host, $port, $errno, $errstr, 30);
    if (!$conn) {
        return "fsockopen failed: [$errno] $errstr";
    }
    $error = '';

    // Helper to send a command and get response
    $send = function($cmd) use ($conn) {
        fwrite($conn, $cmd . "\r\n");
        return fgets($conn, 512);
    };

    // Read greeting
    $response = fgets($conn, 512);
    if (substr($response, 0, 3) !== '220') {
        fclose($conn);
        return "SMTP greeting failed: $response";
    }

    // EHLO
    $send("EHLO " . gethostname());
    // Read multi-line EHLO response
    while (($line = fgets($conn, 512)) && substr($line, 3, 1) === '-') {}

    // STARTTLS
    $r = $send("STARTTLS");
    if (substr($r, 0, 3) !== '220') {
        fclose($conn);
        return "STARTTLS failed: $r";
    }

    // Upgrade to TLS
    if (!stream_socket_enable_crypto($conn, true, STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT)) {
        // Fallback to any TLS method
        if (!stream_socket_enable_crypto($conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            fclose($conn);
            return "TLS upgrade failed.";
        }
    }

    // Re-send EHLO after TLS
    $send("EHLO " . gethostname());
    while (($line = fgets($conn, 512)) && substr($line, 3, 1) === '-') {}

    // AUTH LOGIN
    $r = $send("AUTH LOGIN");
    if (substr($r, 0, 3) !== '334') {
        fclose($conn);
        return "AUTH LOGIN failed: $r";
    }
    $r = $send(base64_encode($username));
    if (substr($r, 0, 3) !== '334') {
        fclose($conn);
        return "Username rejected: $r";
    }
    $r = $send(base64_encode($password));
    if (substr($r, 0, 3) !== '235') {
        fclose($conn);
        return "Password rejected (check App Password): $r";
    }

    // MAIL FROM
    $r = $send("MAIL FROM:<$from>");
    if (substr($r, 0, 3) !== '250') {
        fclose($conn);
        return "MAIL FROM failed: $r";
    }

    // RCPT TO
    $r = $send("RCPT TO:<$to>");
    if (substr($r, 0, 3) !== '250') {
        fclose($conn);
        return "RCPT TO failed: $r";
    }

    // DATA
    $r = $send("DATA");
    if (substr($r, 0, 3) !== '354') {
        fclose($conn);
        return "DATA command failed: $r";
    }
    fwrite($conn, $message_data . "\r\n.\r\n");
    $r = fgets($conn, 512);
    if (substr($r, 0, 3) !== '250') {
        fclose($conn);
        return "Message body rejected: $r";
    }

    // QUIT
    $send("QUIT");
    fclose($conn);

    return true;
}


/**
 * Encode a string as UTF-8 MIME header
 */
function mime_encode($str) {
    return '=?UTF-8?B?' . base64_encode($str) . '?=';
}


/**
 * Write email activity to a local log file for debugging
 */
function write_email_log($name, $email, $subject, $message, $success, $detail = '') {
    $log_dir = __DIR__ . '/logs';
    if (!file_exists($log_dir)) {
        @mkdir($log_dir, 0777, true);
    }
    $log_file  = $log_dir . '/email_log.txt';
    $status    = $success ? "✅ BERHASIL DIKIRIM" : "❌ GAGAL: " . (is_string($detail) ? $detail : 'Unknown error');

    $entry  = "==================================================\n";
    $entry .= "WAKTU KIRIM : " . date('Y-m-d H:i:s') . "\n";
    $entry .= "KEPADA      : " . MAIL_TO . "\n";
    $entry .= "PENGIRIM    : $name <$email>\n";
    $entry .= "SUBJEK      : $subject\n";
    $entry .= "PESAN       : " . str_replace("\n", "\n              ", $message) . "\n";
    $entry .= "STATUS      : $status\n";
    $entry .= "==================================================\n\n";

    @file_put_contents($log_file, $entry, FILE_APPEND);
}
?>
