
  <style>
    body {
      background-color: #f8f9fa;
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

  </style>

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
                <p><strong>Rate:</strong> ₱<?= number_format($car['rental_price_per_day'], 2) ?>/day</p>
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
