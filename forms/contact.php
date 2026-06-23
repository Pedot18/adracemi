<?php
// forms/contact.php
// Secure contact form handler requiring user login

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Enforce authentication
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "Akses ditolak. Silakan login atau register terlebih dahulu untuk mengirim pesan.";
    exit;
}

// 2. Include database and email helpers
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../mail_helper.php';

// 3. Process POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo "Semua field input wajib diisi.";
        exit;
    }
    
    try {
        // 4. Save submission details in database for tracking & backup
        $stmt = $pdo->prepare("INSERT INTO contact_messages (user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $name,
            $email,
            $subject,
            $message
        ]);
        
        // 5. Send the email via custom mail helper (target: anggarenosugiarto@gmail.com)
        send_contact_email($name, $email, $subject, $message);
        
        // 6. Return OK to trigger frontend success status in validate.js
        echo "OK";
        
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Gagal menyimpan pesan ke database: " . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo "Metode request tidak diizinkan.";
}
?>
