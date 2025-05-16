<section class="py-5">
    <div class="container">
        <h1 class="mb-4">Available Cars</h1>

        <div class="row g-4">
            <?php foreach($cars as $car): ?>
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="card h-100 w-100 d-flex flex-column">
                        <div class="ratio ratio-4x3">
                            <img src="<?= base_url('uploads/' . $car['image']) ?>" class="card-img-top object-fit-cover" alt="<?= $car['model'] ?>">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $car['model'] ?> <?= $car['make'] ?></h5>
                            <p class="card-text mb-3">₱<?= number_format($car['rental_price_per_day'], 0) ?>/day</p>
                            <div class="mt-auto">
                                <a href="<?= site_url('/car_view/' . $car['id']) ?>" class="btn btn-primary w-100">Book Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
