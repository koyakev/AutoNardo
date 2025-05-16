<div class="container p-5 m-auto my-5 w-50 bg-white rounded shadow-sm">
    <div class="d-flex align-items-center mb-3 fs-4">
        <a href="<?= site_url('admin/users_list') ?>" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="p-1 px-3">Create New User</span>
    </div>
    <form method="POST" action="<?= site_url('admin/store_user') ?>">
        <div class="form-group mb-3">
            <label class="form-label">Full Name:</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Phone:</label>
            <div class="input-group">
                <span class="input-group-text">09</span>
                <input type="text" name="phone" class="form-control" minlength="9" maxlength="9" pattern="\d*" inputmode="numeric" required>
            </div>
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