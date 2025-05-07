<p>Hi</p>

<?php if($this->session->userdata('user')): ?>
    <a href="<?= site_url('auth/logout') ?>">Logout</a>
<?php else: ?>
    <a href="<?= site_url('/login') ?>">Login</a>
<?php endif; ?>

<div class="row">
    <?php foreach($cars as $car): ?>
        <div class="col-4">
            <img src="<?= base_url('uploads/' . $car['image']) ?>" width=200>
            <p>Model: <?= $car['model'] ?></p>
            <p>Brand: <?= $car['make'] ?></p>
            <p>Rate: <?= $car['rental_price_per_day'] ?></p>
            <a href="<?= site_url('/car_view/' . $car['id']) ?>">Book Now!</a>
        </div>
    <?php endforeach; ?>
</div>