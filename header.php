<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Include database connection
require_once __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PT Adra Cipta Chemindo</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo_acc.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">
  <link href="assets/css/auth.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <script>
    window.isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    window.loggedInUser = <?php echo isset($_SESSION['user_id']) ? json_encode([
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'],
        'email' => $_SESSION['user_email']
    ]) : 'null'; ?>;
  </script>
</head>

<body class="index-page">
  <script>
    // Immediately apply saved theme to body to prevent flash
    if (localStorage.getItem("theme") === "dark") {
      document.body.classList.add("dark-mode");
    }
  </script>
    <!-- Load Header -->
    


<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
          <div class="logo-container">
          <svg class="arc-top" viewBox="0 0 120 30">
            <path d="M10,25 Q60,-5 110,25" stroke="#007BFF" stroke-width="8" fill="transparent"/>
          </svg>
        
          <span class="logo-text">ACC</span>
        
          <svg class="arc-bottom" viewBox="0 0 120 30">
            <path d="M10,5 Q60,35 110,5" stroke="#007BFF" stroke-width="8" fill="transparent"/>
          </svg>
        </div>

      </a>

  <nav id="navmenu" class="navmenu">
  <ul>
    <li><a href="index.php#hero" class="active">Home</a></li>
    <li><a href="index.php#about">Tentang Kami</a></li>

    <li class="dropdown">
      <a href="index.php#services" class="disable-click">
        Produk <i class="bi bi-chevron-down"></i>
      </a>

      <ul class="dropdown-menu">
        <li><a href="service-details-mining.php">Mining</a></li>
        <li><a href="service-details-nonmining.php">Non Mining</a></li>
        <li><a href="service-details-lab_equipment.php">Lab Equipment</a></li>
      </ul>
    </li>

    <li><a href="index.php#stats">Pelanggan</a></li>
    <li><a href="index.php#contact">Kontak</a></li>
    <?php if (isset($_SESSION['user_id'])): ?>
      <li class="dropdown">
        <a href="#" class="disable-click">
          <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?> <i class="bi bi-chevron-down text-small"></i>
        </a>
        <ul class="dropdown-menu dropdown-user-menu">
          <li><a href="auth_action.php?action=logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
        </ul>
      </li>
    <?php else: ?>
      <li><a href="#" class="navLoginBtn"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
    <?php endif; ?>
  </ul>

  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

<!-- Tambahin ini -->
<label class="switch">
  <input type="checkbox" id="theme-toggle">
  <span class="slider">
    <i class="fas fa-sun sun"></i>
    <i class="fas fa-moon moon"></i>
  </span>
</label>

    </div>
    
  </header>
  <script>
document.addEventListener("DOMContentLoaded", function(){
    const toggle = document.getElementById("theme-toggle");
    
    // Set checkbox state based on body class
    if (document.body.classList.contains("dark-mode")) {
        toggle.checked = true;
    }
    
    toggle.addEventListener("change", function(){
        if (toggle.checked) {
            document.body.classList.add("dark-mode");
            localStorage.setItem("theme", "dark");
        } else {
            document.body.classList.remove("dark-mode");
            localStorage.setItem("theme", "light");
        }
    });
});
</script>