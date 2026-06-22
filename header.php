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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="index-page">
    <!-- Load Header -->
    
<STYLE>
#services {
  position: relative;
   background-image: url('assets/img/bg17373.jpg') !important;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

/* Overlay dengan warna abu-abu lebih terang */
#services::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
}

/* Pastikan konten tetap terlihat di atas overlay */
#services .container {
  position: relative;
  z-index: 12;
}


  /* ini buat togle dask mode */
      .switch{
      position:relative;
      display:inline-block;
      width:60px;
      height:32px;
      margin-left:20px;
    }

    .switch input{
      opacity:0;
      width:0;
      height:0;
    }

    .slider{
      position:absolute;
      cursor:pointer;
      top:0;
      left:0;
      right:0;
      bottom:0;

      background:#e2e8f0;
      border-radius:34px;

      transition:.4s;
    }

    .slider:before{
      content:"";
      position:absolute;

      width:24px;
      height:24px;

      left:4px;
      bottom:4px;

      background:white;
      border-radius:50%;

      transition:.4s;
    }

    input:checked + .slider{
      background:#0F172A;
    }

    input:checked + .slider:before{
      transform:translateX(28px);
    }

    .sun{
      position:absolute;
      left:8px;
      top:8px;
      font-size:14px;
      color:#f59e0b;
    }

    .moon{
      position:absolute;
      right:8px;
      top:8px;
      font-size:14px;
      color:#f59e0b;
    }

    /* css nya */
    body.dark-mode{
    background:#0F172A !important;
}

body.dark-mode #header{
    background:#0F172A !important;
}

body.dark-mode .about{
    background:#0F172A !important;
    color:white !important;
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode h5,
body.dark-mode h6,
body.dark-mode p,
body.dark-mode li,
body.dark-mode a{
    color:white !important;
}

/* animation */
.service-details{

    position:relative;

    overflow:hidden;

}

.molecule-bg{

    position:absolute;

    top:0;

    left:0;

    width:100%;

    height:100%;

    z-index:0;

}

.service-details .container{

    position:relative;

    z-index:2;

}

.hex{

    position:absolute;

    width:150px;

    height:85px;

    border:4px solid rgba(77,91,168,.2);

    clip-path: polygon(
      25% 0%,
      75% 0%,
      100% 50%,
      75% 100%,
      25% 100%,
      0% 50%
    );

    animation: floatHex 12s ease-in-out infinite;

}

.h1{

    top:10%;

    left:5%;

}

.h2{

    top:40%;

    right:10%;

    animation-duration:15s;

}

.h3{

    bottom:20%;

    left:20%;

}

.h4{

    bottom:5%;

    right:25%;

    animation-duration:18s;

}

@keyframes floatHex{

    0%{

        transform:translateY(0px);

    }

    50%{

        transform:translateY(-20px);

    }

    100%{

        transform:translateY(0px);

    }

}

.service-details{

    position:relative;

    overflow:hidden;

}

.molecule-network{

    position:absolute;

    inset:0;

    z-index:0;

    opacity:.2;

}

.service-details .container{

    position:relative;

    z-index:2;

}


/* ATOM */

.atom{

    position:absolute;

    width:14px;

    height:14px;

    border-radius:50%;

    background:#0ea5e9;

    animation:pulse 3s infinite ease-in-out;

}

.a1{

    top:20%;

    left:10%;

}

.a2{

    top:35%;

    left:20%;

}

.a3{

    top:25%;

    left:35%;

}

.a4{

    top:50%;

    left:25%;

}


/* GARIS */

.bond{

    position:absolute;

    height:2px;

    background:#0ea5e9;

    transform-origin:left center;

}

.b1{

    top:22%;

    left:11%;

    width:120px;

    transform:rotate(25deg);

}

.b2{

    top:33%;

    left:21%;

    width:100px;

    transform:rotate(-15deg);

}

.b3{

    top:30%;

    left:27%;

    width:90px;

    transform:rotate(60deg);

}


/* ANIMASI */
.service-details{

    position:relative;

    overflow:hidden;

}

/* Molecule besar transparan */

.service-details::before{

    content:"⚗";

    position:absolute;

    right:5%;

    top:50%;

    transform:translateY(-50%);

    font-size:300px;

    color:#0ea5e9;

    opacity:.03;

    z-index:0;

}

/* Titik partikel */

.service-details::after{

    content:"";

    position:absolute;

    width:500px;

    height:500px;

    right:-100px;

    bottom:-100px;

    background:

      radial-gradient(
        circle,
        rgba(14,165,233,.08) 0%,

        transparent 70%
      );

    animation:floatParticle 8s ease-in-out infinite;

    z-index:0;

}

.service-details .container{

    position:relative;

    z-index:2;

}

@keyframes floatParticle{

    0%{

        transform:translateY(0);

    }

    50%{

        transform:translateY(-20px);

    }

    100%{

        transform:translateY(0);

    }

}

</STYLE>

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

    console.log("JS LOADED");

    const toggle = document.getElementById("theme-toggle");

    console.log(toggle);

    toggle.addEventListener("change", function(){

        console.log("CLICKED");

        document.body.classList.toggle("dark-mode");

    });

});
</script>