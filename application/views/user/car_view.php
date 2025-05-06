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

<form method="POST" action="<?= site_url('book') ?>">
    <input type="date" name="start_date" id="start_date">
    <input type="date" name="end_date" id="end_date">
    <input type="text" id="price" value=0 readonly>
    <button>Book Now!</button>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#start_date, #end_date').on('change', function() {
            let start = new Date($('#start_date').val());
            let end = new Date($('#end_date').val());
            let days = (end - start)/(1000 * 60 * 60 * 24);
            
            if(isNaN(days)) {
                $('#price').val(0);
            } else {
                $('#price').val(days * <?= $car['rental_price_per_day'] ?>);
            }
        })
    });
</script>