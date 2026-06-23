<?php
// auth_action.php
// Authentication endpoint for AJAX Login/Register and Logout redirects

// Make sure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

// Helper to return JSON response
function json_response($success, $message, $data = []) {
    header('Content-Type: application/json');
    echo json_encode(array_merge([
        'success' => $success,
        'message' => $message
    ], $data));
    exit;
}

// 1. Handle GET request for logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Clear session
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    
    // Redirect back to referring page or index.php
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header("Location: $redirect");
    exit;
}

// 2. Handle POST requests (Login / Register)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
    
    if ($action === 'register') {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if (empty($name) || empty($email) || empty($password)) {
            json_response(false, 'Semua field wajib diisi.');
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_response(false, 'Format email tidak valid.');
        }
        
        if (strlen($password) < 6) {
            json_response(false, 'Password minimal harus terdiri dari 6 karakter.');
        }
        
        try {
            // Check if email already registered
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                json_response(false, 'Email sudah terdaftar. Silakan login.');
            }
            
            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashed_password]);
            
            $user_id = $pdo->lastInsertId();
            
            // Set session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            
            json_response(true, 'Registrasi berhasil!', [
                'user' => [
                    'id' => $user_id,
                    'name' => $name,
                    'email' => $email
                ]
            ]);
        } catch (PDOException $e) {
            json_response(false, 'Terjadi kesalahan database: ' . $e->getMessage());
        }
        
    } elseif ($action === 'login') {
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if (empty($email) || empty($password)) {
            json_response(false, 'Email dan password wajib diisi.');
        }
        
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if (!$user || !password_verify($password, $user['password'])) {
                json_response(false, 'Email atau password salah.');
            }
            
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            json_response(true, 'Login berhasil!', [
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ]
            ]);
        } catch (PDOException $e) {
            json_response(false, 'Terjadi kesalahan database: ' . $e->getMessage());
        }
    } else {
        json_response(false, 'Aksi tidak valid.');
    }
} else {
    header("Location: index.php");
    exit;
}
?>
