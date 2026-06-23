document.addEventListener("DOMContentLoaded", function () {
  // Grab forms
  const loginForm = document.getElementById("loginForm");
  const registerForm = document.getElementById("registerForm");
  const authModalEl = document.getElementById("authModal");
  let authModal = null;
  
  if (authModalEl) {
    authModal = new bootstrap.Modal(authModalEl);
  }

  // Handle Login Form Submit
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const submitBtn = loginForm.querySelector('button[type="submit"]');
      const spinner = submitBtn.querySelector(".spinner-border");
      const errorAlert = document.getElementById("loginErrorAlert");

      // Show spinner
      spinner.classList.remove("d-none");
      submitBtn.disabled = true;
      errorAlert.classList.add("d-none");

      const formData = new FormData(loginForm);

      fetch("auth_action.php", {
        method: "POST",
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          spinner.classList.add("d-none");
          submitBtn.disabled = false;

          if (data.success) {
            // Success
            window.isLoggedIn = true;
            window.loggedInUser = data.user;
            
            // Reload page to apply session changes cleanly across all elements
            window.location.reload();
          } else {
            errorAlert.textContent = data.message;
            errorAlert.classList.remove("d-none");
          }
        })
        .catch(error => {
          spinner.classList.add("d-none");
          submitBtn.disabled = false;
          errorAlert.textContent = "Terjadi kesalahan sistem. Silakan coba lagi.";
          errorAlert.classList.remove("d-none");
          console.error("Login error:", error);
        });
    });
  }

  // Handle Register Form Submit
  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const submitBtn = registerForm.querySelector('button[type="submit"]');
      const spinner = submitBtn.querySelector(".spinner-border");
      const errorAlert = document.getElementById("registerErrorAlert");
      const successAlert = document.getElementById("registerSuccessAlert");

      // Show spinner
      spinner.classList.remove("d-none");
      submitBtn.disabled = true;
      errorAlert.classList.add("d-none");
      successAlert.classList.add("d-none");

      const formData = new FormData(registerForm);

      fetch("auth_action.php", {
        method: "POST",
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          spinner.classList.add("d-none");
          submitBtn.disabled = false;

          if (data.success) {
            successAlert.textContent = data.message;
            successAlert.classList.remove("d-none");
            
            window.isLoggedIn = true;
            window.loggedInUser = data.user;
            
            // Reload page to apply session changes cleanly across all elements
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          } else {
            errorAlert.textContent = data.message;
            errorAlert.classList.remove("d-none");
          }
        })
        .catch(error => {
          spinner.classList.add("d-none");
          submitBtn.disabled = false;
          errorAlert.textContent = "Terjadi kesalahan sistem. Silakan coba lagi.";
          errorAlert.classList.remove("d-none");
          console.error("Register error:", error);
        });
    });
  }

  // Handle Nav Login button click
  const navLoginBtns = document.querySelectorAll(".navLoginBtn");
  navLoginBtns.forEach(btn => {
    if (btn && authModal) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        authModal.show();
      });
    }
  });

  // Handle Contact Form Lock Overlay and Interception
  const contactForm = document.querySelector(".contact .php-email-form");
  if (contactForm) {
    // Wrap contact form in container if not already wrapped
    let wrapper = contactForm.parentNode;
    if (!wrapper.classList.contains("contact-form-container")) {
      wrapper = document.createElement("div");
      wrapper.className = "contact-form-container";
      contactForm.parentNode.insertBefore(wrapper, contactForm);
      wrapper.appendChild(contactForm);
    }

    // Prefill form values if logged in
    if (window.isLoggedIn && window.loggedInUser) {
      const nameInput = contactForm.querySelector('input[name="name"]');
      const emailInput = contactForm.querySelector('input[name="email"]');
      if (nameInput) {
        nameInput.value = window.loggedInUser.name;
        nameInput.setAttribute("readonly", "readonly");
      }
      if (emailInput) {
        emailInput.value = window.loggedInUser.email;
        emailInput.setAttribute("readonly", "readonly");
      }
    } else {
      // If not logged in, inject the glassmorphism overlay
      const overlay = document.createElement("div");
      overlay.className = "contact-lock-overlay";
      overlay.innerHTML = `
        <div class="lock-card">
          <div class="lock-icon-container">
            <i class="bi bi-shield-lock-fill"></i>
          </div>
          <h5 class="lock-title">Login Diperlukan</h5>
          <p class="lock-desc">Silakan login atau register terlebih dahulu untuk dapat mengirimkan pesan kepada kami mengenai detail produk.</p>
          <button type="button" class="btn lock-btn" id="openAuthBtn">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login / Register
          </button>
        </div>
      `;
      wrapper.appendChild(overlay);

      // Bind button to open modal
      const openBtn = document.getElementById("openAuthBtn");
      if (openBtn && authModal) {
        openBtn.addEventListener("click", function () {
          authModal.show();
        });
      }
    }
  }
});
