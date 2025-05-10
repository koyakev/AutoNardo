<div class="container p-5 m-auto my-5 w-50 bg-white rounded shadow-sm">
    <?= form_open_multipart('admin/cars_store'); ?>
        <label class="form-label">Brand:</label>
        <select name="make" class="form-select mb-3">
            <option>Honda</option>
            <option>Toyota</option>
            <option>Hyundai</option>
            <option>Nissan</option>
            <option>Suzuki</option>
        </select>

        <label class="form-label">Type:</label>
        <select name="car_type" class="form-select mb-3">
            <option>Sedan</option>
            <option>Hatchback</option>
            <option>SUV</option>
            <option>Pickup</option>
            <option>Minivan</option>
        </select>

        <label class="form-label">Model:</label>
        <input type="text" name="model" class="form-control mb-3">

        <label class="form-label">Transmission:</label>
        <select name="transmission" class="form-select mb-3">
            <option>Automatic</option>
            <option>Manual</option>
        </select>

        <label class="form-label">Plate Number:</label>
        <input type="text" name="plate_number" class="form-control mb-3">

        <label class="form-label">Rate:</label>
        <input type="number" step="0.01" name="rate" class="form-control mb-3">

        <label class="form-label">Photos:</label>
        <input type="file" name="photo" class="form-control mb-3">

        <div class="text-end">
            <button class="btn btn-dark">Add Car</button>
        </div>
    <?= form_close(); ?>
</div>