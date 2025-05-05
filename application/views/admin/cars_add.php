<?= form_open_multipart('admin/cars_store'); ?>
    <label>Brand:</label>
    <select name="make">
        <option>Dahon</option>
        <option>Totoya</option>
        <option>Hyundai</option>
        <option>Nissan</option>
        <option>Suzuki</option>
    </select>

    <label>Type:</label>
    <select name="car_type">
        <option>Sedan</option>
        <option>Hatchback</option>
        <option>SUV</option>
        <option>Pickup</option>
        <option>Minivan</option>
    </select>

    <label>Model:</label>
    <input type="text" name="model">

    <label>Transmission:</label>
    <select name="transmission">
        <option>Automatic</option>
        <option>Manual</option>
    </select>

    <label>Plate Number:</label>
    <input type="text" name="plate_number">

    <label>Rate:</label>
    <input type="number" step="0.01" name="rate">

    <label>Condition:</label>
    <select name="condition">
        <option>Brand New</option>
        <option>2nd Hand</option>
    </select>

    <label>Photos:</label>
    <input type="file" name="photo">

    <button>Add Car</button>
<?= form_close(); ?>