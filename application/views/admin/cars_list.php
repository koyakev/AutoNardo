<p>Haha</p>
<?php if($this->session->flashdata('message')): ?>
    <?= $this->session->flashdata('message'); ?>
<?php endif; ?>
<a href="<?= site_url('admin/cars_add') ?>">Add Car</a>

<table border=1>
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Transmission</th>
            <th>Plate Number</th>
            <th>Rate</th>
            <th>Condition</th>
            <th>Available</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cars as $car): ?>
            <tr>
                <td><a href="<?= site_url('admin/car_view/') . $car['id'] ?>"><?= $car['id'] ?></a></td>
                <td><?= $car['car_type'] ?></td>
                <td><?= $car['make'] ?></td>
                <td><?= $car['model'] ?></td>
                <td><?= $car['transmission'] ?></td>
                <td><?= $car['plate_number'] ?></td>
                <td><?= $car['rental_price_per_day'] ?></td>
                <td><?= $car['condition_status'] ?></td>
                <td><?= $car['is_available'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>