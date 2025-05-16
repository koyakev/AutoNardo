<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AutoNardo - Car Rental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    /* Navbar brand like register page */
    .navbar-brand {
      font-weight: bold;
      color:rgb(71, 71, 71) !important;
    }

    .form-section {
      padding: 2rem;
    }

    .car-img {
      height: 180px;
      object-fit: cover;
      border-radius: 0.5rem 0.5rem 0 0;
    }

    .card {
      border: 1px solid #ddd;
      border-radius: 12px;
      transition: transform 0.2s ease-in-out;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
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

    nav.navbar {
      background-color: #343a40 !important;
    }
    nav.navbar .navbar-brand,
    nav.navbar .btn-outline-light {
      color: #fff !important;
    }
    nav.navbar .btn-outline-light:hover {
      background-color:rgb(94, 94, 94);
      color: #fff !important;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark shadow">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
      <img src="<?= base_url('uploads/autonardoLOGO.png') ?>" alt="AutoNardo Logo" height="50" class="me-2">
      <span class="fw-bold text-white fs-4">AutoNardo</span>
    </a>
    <div class="d-flex gap-2">
      <a href="<?= site_url('login') ?>" class="btn btn-outline-light">Login</a>
      <a href="<?= site_url('register') ?>" class="btn btn-outline-light">Signup</a>
    </div>
  </div>
</nav> -->

<!-- Welcome Section -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="display-5 fw-bold">Welcome to AutoNardo</h1>
    <p class="lead text-muted">Find the perfect car rental for your next journey.</p>
  </div>
</section>

<!-- Content Section -->
<section class="form-section bg-light">
  <div class="container">
    <div class="row g-4">
      <?php if (!empty($cars)): ?>
        <?php foreach ($cars as $car): ?>
          <div class="col-md-4">
            <div class="card shadow-sm h-100">
              <img src="<?= base_url('uploads/' . $car['image']) ?>" class="card-img-top car-img" alt="<?= htmlspecialchars($car['model']) ?>">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($car['model']) ?></h5>
                <p class="mb-1"><strong>Brand:</strong> <?= htmlspecialchars($car['make']) ?></p>
                <p><strong>Rate:</strong> $<?= number_format($car['rental_price_per_day'], 2) ?>/day</p>
                <a href="<?= site_url('car_view/' . $car['id']) ?>" class="btn btn-primary w-100">Book Now</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-muted">No cars available at the moment.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer mt-5">
  <div class="container">
    <a href="#">About Us</a>
    <a href="#">Contact</a>
    <a href="#">Help</a>
    <a href="#">Privacy Policy</a>
    <div class="mt-3">&copy; <?= date('Y') ?> AutoNardo. All rights reserved.</div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
