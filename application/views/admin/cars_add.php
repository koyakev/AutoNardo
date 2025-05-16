<div class="container p-5 m-auto my-5 w-50 bg-white rounded shadow-sm">
    <div class="d-flex align-items-center mb-3 fs-4">
        <a href="<?= site_url('admin/cars_list') ?>" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="p-1 px-3">Add Car</span>
    </div>
    <?= form_open_multipart('admin/cars_store'); ?>
        <label class="form-label">Brand:</label>
        <input type="text" name="make" list="brands" class="form-control mb-3" autocomplete="off" required>
        <datalist id="brands">
            <option value="Honda">
            <option value="Toyota">
            <option value="Nissan">
            <option value="Hyundai">
            <option value="Suzuki">
        </datalist>

        <label class="form-label">Type:</label>
        <select name="car_type" class="form-select mb-3" required>
            <option>Sedan</option>
            <option>Hatchback</option>
            <option>SUV</option>
            <option>Pickup</option>
            <option>Minivan</option>
        </select>

        <label class="form-label">Model:</label>
        <input type="text" name="model" class="form-control mb-3" required>

        <label class="form-label">Transmission:</label>
        <select name="transmission" class="form-select mb-3" required>
            <option>Automatic</option>
            <option>Manual</option>
        </select>

        <label class="form-label">Plate Number:</label>
        <input type="text" name="plate_number" class="form-control mb-3" required>

        <label class="form-label">Rate:</label>
        <input type="number" step="0.01" name="rate" class="form-control mb-3" required>

        <label class="form-label">Photos:</label>
        <input type="file" name="photo" accept=".jpg, .jpeg, .png" class="form-control mb-3" required>

        <div class="text-end">
            <button class="btn btn-dark">Add Car</button>
        </div>
    <?= form_close(); ?>
</div>