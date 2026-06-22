<!DOCTYPE html>
<html lang="en">

    <?php include("header.php"); ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
      <div class="container position-relative">
        <h1>Product Details</h1>
        <p>
        Professional Laboratory Equipment
        for Analysis, Testing and Research Applications.
        </p>
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
    
    <div class="molecule-network">
      <div class="atom a1"></div>
      <div class="atom a2"></div>
      <div class="atom a3"></div>
      <div class="atom a4"></div>
      
      <div class="bond b1"></div>
      <div class="bond b2"></div>
      <div class="bond b3"></div>
    </div>

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4">
              <div class="services-list">
               <a href="#" class="service-link active" data-target="basic">
                Basic Laboratory Instruments
              </a>
              <a href="#" class="service-link" data-target="sample">
                Sample Preparation & Handling
              </a>
              <a href="#" class="service-link" data-target="safety">
                Safety & Laboratory Consumables
              </a>
              <a href="#" class="service-link" data-target="analytical">
                Analytical Instruments
              </a>
              <a href="#" class="service-link" data-target="water">
                Water & Environmental Testing
              </a>
              </div>
            </div>


          <div class="col-lg-8">
              <div id="basic" class="service-content">
                    <img src="assets/img/lab/basic.jpg" alt="" class="img-fluid services-img">
                    <h3>Basic Laboratory Instruments</h3>
                    <p>
                      We provide essential laboratory instruments for accurate measurement,
                      analysis and routine laboratory operations in industrial and research environments.
                    </p>
                    <ul>
                  <li>
                    <i class="bi bi-check-circle"></i>
                    <span>Products: pH Meter, Conductivity Meter and Digital Balance.</span>
                  </li>
                  <li>
                    <i class="bi bi-check-circle"></i>
                    <span>Application: Water treatment, chemical analysis and industrial laboratories.</span>
                  </li>
                  <li>
                    <i class="bi bi-check-circle"></i>
                    <span>Benefits: High precision, reliable measurement and easy calibration.</span>
                  </li>
                    </ul>
                  </div>

            
              <div id="sample" class="service-content" style="display:none;">
              <img src="assets/img/lab/sample.jpg" alt="" class="img-fluid services-img">
              <h3>Sample Preparation & Handling</h3>
              <p>
                Sample preparation equipment is designed to ensure accurate and efficient
                processing of laboratory samples prior to analysis.
              </p>
              <ul>
            <li>
              <i class="bi bi-check-circle"></i>
              <span>Products: Laboratory Oven, Hot Plate Stirrer and Magnetic Stirrer.</span>
            </li>
            <li>
              <i class="bi bi-check-circle"></i>
              <span>Application: Sample drying, heating, mixing and preparation.</span>
            </li>
            <li>
              <i class="bi bi-check-circle"></i>
              <span>Benefits: Improves accuracy, consistency and laboratory efficiency.</span>
            </li>
              </ul>
            </div>

            <div id="safety" class="service-content" style="display:none;">
              <img src="assets/img/lab/safety.jpg" alt="" class="img-fluid services-img">
              <h3>Safety & Laboratory Consumables</h3>
              <p>
                Laboratory safety equipment and consumables are essential to maintain
                a safe working environment and support daily laboratory operations.
              </p>
              <ul>
            <li>
              <i class="bi bi-check-circle"></i>
              <span>Products: Safety Gloves, Safety Goggles, Laboratory Glassware and Consumables.</span>
            </li>
            <li>
              <i class="bi bi-check-circle"></i>
              <span>Application: Laboratory safety and routine laboratory activities.</span>
            </li>
            <li>
              <i class="bi bi-check-circle"></i>
              <span>Benefits: Enhances safety, protects personnel and ensures operational efficiency.</span>
            </li>
              </ul>
            </div>

            
            <div id="analytical" class="service-content" style="display:none;">
            <img src="assets/img/lab/analytical.jpg" alt="" class="img-fluid services-img">
            <h3>Analytical Instruments</h3>
            <p>
              We provide advanced analytical instruments for precise chemical and elemental analysis,
              supporting industrial laboratories, mining laboratories and research institutions.
            </p>
            <ul>
          <li>
            <i class="bi bi-check-circle"></i>
            <span>Products: Atomic Absorption Spectrometer (AAS) and X-Ray Fluorescence (XRF) Analyzer.</span>
          </li>

          <li>
            <i class="bi bi-check-circle"></i>
            <span>Application: Metal analysis, mining laboratories and industrial quality control.</span>
          </li>

          <li>
            <i class="bi bi-check-circle"></i>
            <span>Benefits: High sensitivity, accurate elemental detection and rapid analysis.</span>
          </li>
            </ul>
          </div>

          <div id="water" class="service-content" style="display:none;">
            <img src="assets/img/lab/water.jpg" alt="" class="img-fluid services-img">
            <h3>Water & Environmental Testing</h3>
            <p>
              Water and environmental testing instruments are designed to monitor water quality
              and environmental conditions with high accuracy and reliability.
            </p>
            <ul>
          <li>
            <i class="bi bi-check-circle"></i>
            <span>Products: Turbidity Meter and Dissolved Oxygen (DO) Meter.</span>
          </li>
          <li>
            <i class="bi bi-check-circle"></i>
            <span>Application: Water quality monitoring, wastewater analysis and environmental testing.</span>
          </li>
          <li>
            <i class="bi bi-check-circle"></i>
            <span>Benefits: Fast measurement, accurate results and easy operation.</span>
          </li>
            </ul>
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