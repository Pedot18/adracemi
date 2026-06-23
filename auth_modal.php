<?php
// auth_modal.php
// Login & Register Modal Layout using Bootstrap 5 classes
?>
<!-- Authentication Modal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content auth-modal-content">
      <div class="modal-header auth-modal-header border-0 pb-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-0 px-4 pb-4">
        
        <!-- Tabs for Login / Register -->
        <ul class="nav nav-pills nav-justified mb-4 animate-tabs" id="authTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active tab-btn" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-panel" type="button" role="tab" aria-controls="login-panel" aria-selected="true">
              <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link tab-btn" id="register-tab" data-bs-toggle="tab" data-bs-target="#register-panel" type="button" role="tab" aria-controls="register-panel" aria-selected="false">
              <i class="bi bi-person-plus me-2"></i>Register
            </button>
          </li>
        </ul>
        
        <!-- Tab Panels -->
        <div class="tab-content" id="authTabContent">
          
          <!-- Login Panel -->
          <div class="tab-pane fade show active" id="login-panel" role="tabpanel" aria-labelledby="login-tab">
            <form id="loginForm" class="auth-form">
              <input type="hidden" name="action" value="login">
              
              <div class="text-center mb-4">
                <h4 class="auth-title">Welcome Back</h4>
                <p class="auth-subtitle">Login to inquire about our premium products</p>
              </div>
              
              <!-- Alerts for error/success -->
              <div class="alert alert-danger d-none auth-alert animate-fade" id="loginErrorAlert" role="alert"></div>
              
              <div class="mb-3 input-group-custom">
                <label for="loginEmail" class="form-label">Email Address</label>
                <div class="input-wrapper">
                  <i class="bi bi-envelope input-icon"></i>
                  <input type="email" class="form-control auth-input" id="loginEmail" name="email" placeholder="name@company.com" required>
                </div>
              </div>
              
              <div class="mb-4 input-group-custom">
                <label for="loginPassword" class="form-label">Password</label>
                <div class="input-wrapper">
                  <i class="bi bi-lock input-icon"></i>
                  <input type="password" class="form-control auth-input" id="loginPassword" name="password" placeholder="••••••••" required>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary w-100 auth-btn py-2">
                <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                Login Account
              </button>
            </form>
          </div>
          
          <!-- Register Panel -->
          <div class="tab-pane fade" id="register-panel" role="tabpanel" aria-labelledby="register-tab">
            <form id="registerForm" class="auth-form">
              <input type="hidden" name="action" value="register">
              
              <div class="text-center mb-4">
                <h4 class="auth-title">Create Account</h4>
                <p class="auth-subtitle">Register to connect with our sales team</p>
              </div>
              
              <!-- Alerts for error/success -->
              <div class="alert alert-danger d-none auth-alert animate-fade" id="registerErrorAlert" role="alert"></div>
              <div class="alert alert-success d-none auth-alert animate-fade" id="registerSuccessAlert" role="alert"></div>
              
              <div class="mb-3 input-group-custom">
                <label for="registerName" class="form-label">Full Name</label>
                <div class="input-wrapper">
                  <i class="bi bi-person input-icon"></i>
                  <input type="text" class="form-control auth-input" id="registerName" name="name" placeholder="John Doe" required>
                </div>
              </div>
              
              <div class="mb-3 input-group-custom">
                <label for="registerEmail" class="form-label">Email Address</label>
                <div class="input-wrapper">
                  <i class="bi bi-envelope input-icon"></i>
                  <input type="email" class="form-control auth-input" id="registerEmail" name="email" placeholder="john@example.com" required>
                </div>
              </div>
              
              <div class="mb-4 input-group-custom">
                <label for="registerPassword" class="form-label">Password (Min. 6 characters)</label>
                <div class="input-wrapper">
                  <i class="bi bi-lock input-icon"></i>
                  <input type="password" class="form-control auth-input" id="registerPassword" name="password" placeholder="••••••••" minlength="6" required>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary w-100 auth-btn py-2">
                <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                Create Account
              </button>
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
