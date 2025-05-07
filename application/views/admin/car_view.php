<img src="<?= base_url('uploads/' . $car['image']) ?>">

<table>
    <tbody>
        <tr>
            <td>ID</td>
            <td><?= $car['id'] ?></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><?= $car['car_type'] ?></td>
        </tr>
        <tr>
            <td>Brand</td>
            <td><?= $car['make'] ?></td>
        </tr>
        <tr>
            <td>Model</td>
            <td><?= $car['model'] ?></td>
        </tr>
        <tr>
            <td>Transmission</td>
            <td><?= $car['transmission'] ?></td>
        </tr>
        <tr>
            <td>Plate Number</td>
            <td><?= $car['plate_number'] ?></td>
        </tr>
        <tr>
            <td>Rate</td>
            <td><?= $car['rental_price_per_day'] ?></td>
        </tr>
        <tr>
            <td>Condition</td>
            <td><?= $car['condition_status'] ?></td>
        </tr>
        <tr>
            <td>Available</td>
            <td><?= $car['is_available'] ?></td>
        </tr>
    </tbody>
</table>