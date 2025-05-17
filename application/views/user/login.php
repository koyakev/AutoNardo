<?php
$username = $password = "";
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username === "Pedro Duarte" && $password === "password123") {
        header("Location: dashboard.php");
        exit;
    } else {
        $loginError = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Autonardo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-image {
      background: url('/AutoNardo/uploads/car-road.png') no-repeat center center;
      background-size: cover;
    }

    .brand-name {
      font-size: 4rem;
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
      text-align: center;
    }

    .footer a {
      color: #007bff;
      margin-right: 15px;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    /* Navbar styling like register page */
    nav.navbar {
      background-color: #343a40 !important;
    }
    nav.navbar .navbar-brand,
    nav.navbar .btn-outline-light {
      color: #fff !important;
    }
    nav.navbar .btn-outline-light:hover {
      background-color:rgb(33, 33, 33);
      color: #fff !important;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
      <img src="<?= base_url('uploads/autonardoLOGO.png') ?>" alt="AutoNardo Logo" height="50" class="me-2">
      <span class="fw-bold text-white fs-4">AutoNardo</span>
    </a>
  </div>
</nav>

<!-- Main Container -->
<div class="container-fluid vh-100 d-flex flex-column justify-content-between">

  <div class="row flex-grow-1">
    <!-- Left: Form Section -->
    <div class="col-md-6 d-flex align-items-center justify-content-center bg-white form-section">
      <div class="w-75">
        <div class="mb-4 text-center">
          <span class="brand-name">Hola!</span>
          <p class="text-muted mt-2">Welcome back to your reliable rental platform</p>
        </div>

        <?php if ($loginError): ?>
          <div class="alert alert-danger"><?php echo $loginError; ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('auth/verify') ?>">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($username); ?>" required />
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required />
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center mt-3">
          <p>Don't have an account? <a href="<?= site_url('register') ?>" class="text-decoration-none">Register here</a></p>
        </div>
      </div>
    </div>

    <!-- Right: Image -->
    <div class="col-md-6 login-image d-none d-md-block"></div>
  </div>

  <!-- Footer -->
  <footer class="footer mt-auto">
    <div>© 2025 Autonardo. All rights reserved.</div>
    <div class="mt-2">
      <a href="#">About Us</a>
      <a href="#">Contact</a>
      <a href="#">Privacy</a>
      <a href="#">Help</a>
    </div>
  </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
