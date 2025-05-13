
<section class="py-5">
    <div class="container">
        <h1 class="mb-4">Available Cars</h1>

        <div class="row g-4">
            <?php foreach($cars as $car): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="<?= base_url('uploads/' . $car['image']) ?>" class="card-img-top" alt="<?= $car['model'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $car['model'] ?> <?= $car['make'] ?></h5>
                            <p class="card-text mb-3">₱<?= number_format($car['rental_price_per_day'], 0) ?>/day</p>
                            <a href="<?= site_url('/car_view/' . $car['id']) ?>" class="btn btn-primary w-100">Book Now!</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
