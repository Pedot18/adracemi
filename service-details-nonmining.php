<!DOCTYPE html>
<html lang="en">

    <?php include("header.php"); ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
      <div class="container position-relative">
        <h1>Product Details</h1>
        <p>Non Mining.</p>
        <p>Oil & Gas, Drilling & Industrial Chemicals</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Product Detail</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4">
              <div class="services-list">
                <a href="#" class="service-link active" data-target="pax">Bentonite API/OCMA</a>
                <a href="#" class="service-link" data-target="nahs">Calcium Chloride (94-97%)</a>
                <a href="#" class="service-link" data-target="balls">Drilling Detergents & Starch</a>
                <a href="#" class="service-link" data-target="flocculants">Water & Wastewater Treatment</a>
                <a href="#" class="service-link" data-target="frothers">Sodium Sulfide & Soda Ash Dense</a>
              </div>
            </div>


          <div class="col-lg-8">
              <div id="pax" class="service-content">
                <img src="assets/img/portfolio/prod2.jpg" alt="" class="img-fluid services-img">
                <h3>Amyl Xanthate (PAX) 90%</h3>
                    <p>
                     A powerful collector used in the flotation of sulfide minerals like copper, lead, zinc, and gold. It enhances separation efficiency by making mineral surfaces hydrophobic, allowing them to attach to air bubbles in flotation cells.
                    </p>
                    <ul>
                      <li><i class="bi bi-check-circle"></i> <span>Application: Mining, mineral flotation.</span></li>
                      <li><i class="bi bi-check-circle"></i> <span>Form: Granules.</span></li>
                      <li><i class="bi bi-check-circle"></i> <span>Handling: Requires protective equipment due to toxicity and environmental impact.</span></li>
                    </ul>
              </div>
            
              <div id="nahs" class="service-content" style="display: none;">
                <img src="assets/img/portfolio/prod3.jpg" alt="" class="img-fluid services-img">
                <h3>Sodium Hydrosulfide (NaHS) 70%</h3>
                <p>Commonly used in the mining industry to depress copper sulfides and activate oxide minerals...</p>
              </div>
            
              <div id="balls" class="service-content" style="display: none;">
                <img src="assets/img/portfolio/prod4.jpg" alt="" class="img-fluid services-img">
                <h3>Grinding Balls (133mm, 80mm, 30mm)</h3>
                <p>High-quality steel grinding balls for ball mills, used in mining and cement industries...</p>
              </div>
            
              <div id="flocculants" class="service-content" style="display: none;">
                <img src="assets/img/portfolio/prod5.jpg" alt="" class="img-fluid services-img">
                <h3>Flocculants & Coagulants</h3>
                <p>Essential for water treatment, solid-liquid separation, and wastewater clarification...</p>
              </div>
            
              <div id="frothers" class="service-content" style="display: none;">
                <img src="assets/img/portfolio/prod6.jpg" alt="" class="img-fluid services-img">
                <h3>Flotation Reagents & Specialty Frothers</h3>
                <p>Used to enhance the flotation process, improving the recovery of valuable minerals...</p>
              </div>
            </div>


        </div>

      </div>

    </section><!-- /Service Details Section -->

  </main>

     <!-- Load Footer -->
    <?php include("footer.php"); ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".service-link");
    const contents = document.querySelectorAll(".service-content");

    links.forEach(link => {
      link.addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah halaman refresh saat klik

        // Hapus class 'active' dari semua link
        links.forEach(l => l.classList.remove("active"));
        this.classList.add("active");

        // Sembunyikan semua konten
        contents.forEach(content => content.style.display = "none");

        // Tampilkan konten yang sesuai dengan data-target
        const targetId = this.getAttribute("data-target");
        document.getElementById(targetId).style.display = "block";
      });
    });
  });
</script>


</body>

</html>