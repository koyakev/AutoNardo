<div class="container p-5 m-auto my-5 w-50 bg-white rounded shadow-sm">

    <h4>Create New User</h4>
    <form method="POST" action="<?= site_url('admin/store_user') ?>">
        <div class="form-group mb-3">
            <label class="form-label">Full Name:</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Email:</label>
            <input type="text" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Address:</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">License Number:</label>
            <input type="text" name="drivers_license_number" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">License Expiration Date:</label>
            <input type="date" name="drivers_license_expiry" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <input type="checkbox" class="form-check-input" name="is_admin" value=1>
            <label class="form-check-label">Admin<label>
        </div>
        
        <div class="text-end">
            <button class="btn btn-dark">Register</button>
        </div>
    </form>
</div>