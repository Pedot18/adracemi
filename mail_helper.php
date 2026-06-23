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
function send_contact_email($name, $email, $phone, $subject, $message) {
    // ── 1. Build ADMIN notification email ────────────────────────────────
    $admin_body  = "<!DOCTYPE html><html><head><meta charset='UTF-8'>";
    $admin_body .= "<style>";
    $admin_body .= "body{font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;background:#f8fafc;padding:20px}";
    $admin_body .= ".card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;max-width:600px;margin:0 auto;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0,0,0,.1)}";
    $admin_body .= ".hdr{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;padding:24px;text-align:center}";
    $admin_body .= ".hdr h2{margin:0;font-size:20px;font-weight:600}";
    $admin_body .= ".body{padding:24px}";
    $admin_body .= ".field{margin-bottom:20px;border-bottom:1px solid #f1f5f9;padding-bottom:15px}";
    $admin_body .= ".field:last-child{border-bottom:none;padding-bottom:0;margin-bottom:0}";
    $admin_body .= ".label{font-size:13px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px}";
    $admin_body .= ".value{font-size:15px;color:#0f172a}";
    $admin_body .= ".footer{font-size:12px;color:#94a3b8;text-align:center;padding:16px;background:#f1f5f9;border-top:1px solid #e2e8f0}";
    $admin_body .= "</style></head><body>";
    $admin_body .= "<div class='card'>";
    $admin_body .= "  <div class='hdr'><h2>&#128233; Pesan Baru - PT Adra Cipta Chemindo</h2></div>";
    $admin_body .= "  <div class='body'>";
    $admin_body .= "    <div class='field'><div class='label'>Nama Pengirim</div><div class='value'>" . htmlspecialchars($name) . "</div></div>";
    $admin_body .= "    <div class='field'><div class='label'>Email Pengirim</div><div class='value'>" . htmlspecialchars($email) . "</div></div>";
    $admin_body .= "    <div class='field'><div class='label'>No. Telepon</div><div class='value'>" . htmlspecialchars($phone) . "</div></div>";
    $admin_body .= "    <div class='field'><div class='label'>Subjek</div><div class='value'>" . htmlspecialchars($subject) . "</div></div>";
    $admin_body .= "    <div class='field'><div class='label'>Pesan</div><div class='value'>" . nl2br(htmlspecialchars($message)) . "</div></div>";
    $admin_body .= "  </div>";
    $admin_body .= "  <div class='footer'>Email ini dikirim otomatis via Formulir Kontak ACC &mdash; " . date('d M Y, H:i') . "</div>";
    $admin_body .= "</div></body></html>";

    $admin_headers  = "Date: " . date('r') . "\r\n";
    $admin_headers .= "To: <" . MAIL_TO . ">\r\n";
    $admin_headers .= "From: " . mime_encode(SMTP_FROM_NAME) . " <" . SMTP_FROM . ">\r\n";
    $admin_headers .= "Reply-To: " . mime_encode($name) . " <" . $email . ">\r\n";
    $admin_headers .= "Subject: " . mime_encode("[ACC] Pertanyaan Produk: " . $subject) . "\r\n";
    $admin_headers .= "MIME-Version: 1.0\r\n";
    $admin_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $admin_headers .= "Content-Transfer-Encoding: base64\r\n";
    $admin_headers .= "\r\n";
    $admin_headers .= chunk_split(base64_encode($admin_body));

    $result_admin  = smtp_send_mail(SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, SMTP_FROM, MAIL_TO, $admin_headers);
    $success_admin = ($result_admin === true);

    write_email_log($name, $email, $subject, $message, $success_admin, $result_admin, 'ADMIN');

    // ── 2. Send REPLY (confirmation) email back to the user ──────────────
    $reply_body = build_reply_email($name, $email, $phone, $subject, $message);

    $reply_headers  = "Date: " . date('r') . "\r\n";
    $reply_headers .= "To: " . mime_encode($name) . " <" . $email . ">\r\n";
    $reply_headers .= "From: " . mime_encode(SMTP_FROM_NAME) . " <" . SMTP_FROM . ">\r\n";
    $reply_headers .= "Reply-To: " . mime_encode(SMTP_FROM_NAME) . " <" . SMTP_FROM . ">\r\n";
    $reply_headers .= "Subject: " . mime_encode("Terima kasih telah menghubungi PT Adra Cipta Chemindo") . "\r\n";
    $reply_headers .= "MIME-Version: 1.0\r\n";
    $reply_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $reply_headers .= "Content-Transfer-Encoding: base64\r\n";
    $reply_headers .= "\r\n";
    $reply_headers .= chunk_split(base64_encode($reply_body));

    $result_reply  = smtp_send_mail(SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, SMTP_FROM, $email, $reply_headers);
    $success_reply = ($result_reply === true);

    write_email_log($name, $email, $subject, '(Balasan konfirmasi dikirim ke user)', $success_reply, $result_reply, 'REPLY');

    return $success_admin;
}


/**
 * Builds the premium HTML reply/confirmation email body sent back to the user.
 */
function build_reply_email($name, $email, $phone, $subject, $message) {
    $first_name = explode(' ', trim($name))[0]; // Use first name only for greeting
    $sent_date  = date('d F Y, H:i') . ' WIB';
    $safe_message = nl2br(htmlspecialchars($message));

    return <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terima kasih telah menghubungi kami</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      background-color: #f0f4f8;
      color: #1e293b;
      padding: 32px 16px;
    }
    .wrapper {
      max-width: 600px;
      margin: 0 auto;
    }

    /* ── Header ──────────────── */
    .header {
      background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
      border-radius: 16px 16px 0 0;
      padding: 40px 32px 32px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .header::before {
      content: '';
      position: absolute;
      top: -40px; right: -40px;
      width: 180px; height: 180px;
      border-radius: 50%;
      background: rgba(255,255,255,0.07);
    }
    .header::after {
      content: '';
      position: absolute;
      bottom: -60px; left: -30px;
      width: 220px; height: 220px;
      border-radius: 50%;
      background: rgba(255,255,255,0.05);
    }
    .logo-text {
      font-size: 28px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: 2px;
    }
    .logo-sub {
      font-size: 12px;
      color: rgba(255,255,255,0.75);
      letter-spacing: 3px;
      text-transform: uppercase;
      margin-top: 4px;
    }
    .checkmark-circle {
      width: 64px; height: 64px;
      border-radius: 50%;
      background: rgba(255,255,255,0.2);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin: 24px auto 0;
      font-size: 32px;
    }
    .header-title {
      font-size: 22px;
      font-weight: 700;
      color: #ffffff;
      margin-top: 14px;
    }
    .header-subtitle {
      font-size: 14px;
      color: rgba(255,255,255,0.8);
      margin-top: 6px;
    }

    /* ── Body ────────────────── */
    .body {
      background: #ffffff;
      padding: 36px 32px;
    }
    .greeting {
      font-size: 17px;
      color: #0f172a;
      font-weight: 600;
      margin-bottom: 12px;
    }
    .intro-text {
      font-size: 14px;
      color: #475569;
      line-height: 1.7;
      margin-bottom: 28px;
    }

    /* ── Message recap card ── */
    .recap-card {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-left: 4px solid #0ea5e9;
      border-radius: 10px;
      padding: 20px 20px 16px;
      margin-bottom: 28px;
    }
    .recap-title {
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: 14px;
    }
    .recap-row {
      display: flex;
      margin-bottom: 10px;
      font-size: 13px;
    }
    .recap-row:last-child { margin-bottom: 0; }
    .recap-label {
      min-width: 100px;
      color: #94a3b8;
      font-weight: 600;
    }
    .recap-value {
      color: #1e293b;
      flex: 1;
    }
    .recap-message-box {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 12px 14px;
      font-size: 13px;
      color: #334155;
      line-height: 1.6;
      margin-top: 8px;
      font-style: italic;
    }

    /* ── What's next ─────────── */
    .next-section {
      margin-bottom: 28px;
    }
    .section-title {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 14px;
    }
    .step-row {
      display: flex;
      align-items: flex-start;
      margin-bottom: 14px;
    }
    .step-icon {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, #eff6ff, #dbeafe);
      color: #1d4ed8;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
      margin-right: 12px;
      margin-top: 2px;
    }
    .step-text strong {
      display: block;
      font-size: 13px;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 2px;
    }
    .step-text span {
      font-size: 12px;
      color: #64748b;
    }

    /* ── CTA Button ──────────── */
    .cta-wrap { text-align: center; margin-bottom: 28px; }
    .cta-btn {
      display: inline-block;
      background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
      color: #ffffff !important;
      text-decoration: none;
      font-size: 14px;
      font-weight: 700;
      padding: 14px 36px;
      border-radius: 30px;
      letter-spacing: 0.3px;
      box-shadow: 0 4px 14px rgba(14,165,233,0.35);
    }

    /* ── Contact strip ───────── */
    .contact-strip {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      padding: 18px 20px;
      margin-bottom: 24px;
    }
    .contact-strip-title {
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      margin-bottom: 12px;
    }
    .contact-item {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
      font-size: 13px;
      color: #334155;
    }
    .contact-item:last-child { margin-bottom: 0; }
    .contact-icon { margin-right: 10px; font-size: 15px; }

    .divider {
      border: none;
      border-top: 1px solid #f1f5f9;
      margin: 24px 0;
    }

    /* ── Footer ──────────────── */
    .footer {
      background: #1e293b;
      border-radius: 0 0 16px 16px;
      padding: 24px 32px;
      text-align: center;
    }
    .footer-brand {
      font-size: 16px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 6px;
    }
    .footer-tagline {
      font-size: 12px;
      color: #94a3b8;
      margin-bottom: 16px;
    }
    .footer-links a {
      color: #60a5fa;
      text-decoration: none;
      font-size: 12px;
      margin: 0 8px;
    }
    .footer-note {
      margin-top: 16px;
      font-size: 11px;
      color: #475569;
      line-height: 1.5;
    }
  </style>
</head>
<body>
<div class="wrapper">

  <!-- HEADER -->
  <div class="header">
    <div class="logo-text">ACC</div>
    <div class="logo-sub">PT Adra Cipta Chemindo</div>
    <div class="checkmark-circle">&#10003;</div>
    <div class="header-title">Pesan Anda Telah Kami Terima!</div>
    <div class="header-subtitle">Tim kami akan segera menghubungi Anda</div>
  </div>

  <!-- BODY -->
  <div class="body">

    <p class="greeting">Halo, {$first_name}! &#128522;</p>
    <p class="intro-text">
      Terima kasih telah menghubungi <strong>PT Adra Cipta Chemindo</strong>.
      Kami telah menerima pertanyaan Anda dan tim sales kami akan merespons
      dalam waktu <strong>1 &times; 24 jam kerja</strong>.
      Kami sangat menghargai kepercayaan Anda kepada kami.
    </p>

    <!-- RECAP -->
    <div class="recap-card">
      <div class="recap-title">&#128203; Ringkasan Pesan Anda</div>
      <div class="recap-row">
        <span class="recap-label">Nama</span>
        <span class="recap-value">{$name}</span>
      </div>
      <div class="recap-row">
        <span class="recap-label">Email</span>
        <span class="recap-value">{$email}</span>
      </div>
      <div class="recap-row">
        <span class="recap-label">No. Telepon</span>
        <span class="recap-value">{$phone}</span>
      </div>
      <div class="recap-row">
        <span class="recap-label">Subjek</span>
        <span class="recap-value">{$subject}</span>
      </div>
      <div class="recap-row">
        <span class="recap-label">Dikirim</span>
        <span class="recap-value">{$sent_date}</span>
      </div>
      <div class="recap-row" style="flex-direction:column">
        <span class="recap-label">Pesan</span>
        <div class="recap-message-box">{$safe_message}</div>
      </div>
    </div>

    <!-- WHAT'S NEXT -->
    <div class="next-section">
      <div class="section-title">&#128336; Apa Yang Terjadi Selanjutnya?</div>
      <div class="step-row">
        <div class="step-icon">&#128269;</div>
        <div class="step-text">
          <strong>Peninjauan Pertanyaan</strong>
          <span>Tim kami sedang meninjau detail pertanyaan Anda.</span>
        </div>
      </div>
      <div class="step-row">
        <div class="step-icon">&#128101;</div>
        <div class="step-text">
          <strong>Penugasan ke Sales Specialist</strong>
          <span>Pertanyaan Anda akan diteruskan ke spesialis produk yang tepat.</span>
        </div>
      </div>
      <div class="step-row">
        <div class="step-icon">&#128172;</div>
        <div class="step-text">
          <strong>Kami Akan Menghubungi Anda</strong>
          <span>Sales kami akan membalas melalui email atau telepon dalam 1&times;24 jam kerja.</span>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="cta-wrap">
      <a href="https://wa.me/6281997695065?text=Halo+ACC%2C+saya+ingin+follow+up+pertanyaan+saya+mengenai+{$subject}" class="cta-btn">
        &#128222; Follow Up via WhatsApp
      </a>
    </div>

    <hr class="divider">

    <!-- CONTACT -->
    <div class="contact-strip">
      <div class="contact-strip-title">&#128205; Hubungi Kami Langsung</div>
      <div class="contact-item"><span class="contact-icon">&#128222;</span> +62 819 9769 5065</div>
      <div class="contact-item"><span class="contact-icon">&#9993;</span> marketing@addra.id</div>
      <div class="contact-item"><span class="contact-icon">&#128205;</span> Pesona Anggrek Harapan Blok D6 No.14, Bekasi Utara</div>
    </div>

  </div>

  <!-- FOOTER -->
  <div class="footer">
    <div class="footer-brand">PT Adra Cipta Chemindo</div>
    <div class="footer-tagline">Distribusi Bahan Kimia untuk Berbagai Industri</div>
    <div class="footer-links">
      <a href="http://www.addra.id">Website</a>
      <a href="https://wa.me/6281997695065">WhatsApp</a>
      <a href="mailto:marketing@addra.id">Email</a>
    </div>
    <div class="footer-note">
      Email ini dikirim secara otomatis. Mohon tidak membalas langsung ke email ini.<br>
      &copy; {$sent_date} PT Adra Cipta Chemindo &mdash; All Rights Reserved.
    </div>
  </div>

</div>
</body>
</html>
HTML;
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
function write_email_log($name, $email, $subject, $message, $success, $detail = '', $type = 'GENERAL') {
    $log_dir = __DIR__ . '/logs';
    if (!file_exists($log_dir)) {
        @mkdir($log_dir, 0777, true);
    }
    $log_file  = $log_dir . '/email_log.txt';
    $status    = $success ? "✅ BERHASIL DIKIRIM" : "❌ GAGAL: " . (is_string($detail) ? trim($detail) : 'Unknown error');
    $recipient = ($type === 'REPLY') ? $email : MAIL_TO;

    $entry  = "==================================================\n";
    $entry .= "TIPE        : [$type]\n";
    $entry .= "WAKTU KIRIM : " . date('Y-m-d H:i:s') . "\n";
    $entry .= "KEPADA      : $recipient\n";
    $entry .= "PENGIRIM    : $name <$email>\n";
    $entry .= "SUBJEK      : $subject\n";
    $entry .= "PESAN       : " . str_replace("\n", "\n              ", $message) . "\n";
    $entry .= "STATUS      : $status\n";
    $entry .= "==================================================\n\n";

    @file_put_contents($log_file, $entry, FILE_APPEND);
}
?>

