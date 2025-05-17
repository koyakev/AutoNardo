<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - AutoNardo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-image {
      background: url('/AutoNardo-master/uploads/car-road.png') no-repeat center center;
      background-size: cover;
    }

    .brand-name {
      font-size: 2rem;
      font-weight: bold;
      color: #007bff;
    }

    .form-section {
      padding: 2rem;
    }

    .footer {
      background: #f1f1f1;
      padding: 2rem;
      font-size: 0.9rem;
      color: #6c757d;
    }

    .footer a {
      color: #007bff;
      margin-right: 15px;
    }
    /* Navbar styling like register page */
    nav.navbar {
      background-color: #343a40 !important;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
  <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
      <img src="<?= base_url('uploads/autonardoLOGO.png') ?>" alt="AutoNardo Logo" height="50" class="me-2">
      <span class="fw-bold text-white fs-4">AutoNardo</span>
    </a>
    </div>
</nav>

<!-- Register Section -->
<section class="form-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <h2 class="text-center mb-4 fw-bold">Create Your Account</h2>

        <?php if ($this->session->flashdata('message')): ?>
          <div class="alert alert-info text-center">
            <?= $this->session->flashdata('message'); ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('auth/store') ?>" class="card p-4 shadow border-0">
          <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" id="full_name" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" required>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" required>
          </div>

          <div class="mb-3">
            <label for="drivers_license_number" class="form-label">Driver's License Number</label>
            <input type="text" class="form-control" name="drivers_license_number" id="drivers_license_number" required>
          </div>

          <div class="mb-4">
            <label for="drivers_license_expiry" class="form-label">License Expiry Date</label>
            <input type="date" class="form-control" name="drivers_license_expiry" id="drivers_license_expiry" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="text-center mt-3">
          <p>Already have an account? <a href="<?= site_url('login') ?>" class="text-decoration-none">Login here</a></p>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer text-center mt-auto">
  <div class="container">
    &copy; <?= date('Y') ?> AutoNardo. All rights reserved.
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
