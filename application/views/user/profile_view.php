<div class="container mt-5">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('user/update') ?>" method="post">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" placeholder="Enter your full name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" placeholder="Enter your phone number" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>" placeholder="Enter your address" required>
        </div>
        <div class="mb-3">
            <label for="drivers_license_number" class="form-label">Driver's License Number</label>
            <input type="text" class="form-control" id="drivers_license_number" name="drivers_license_number" value="<?= htmlspecialchars($user['drivers_license_number']) ?>" placeholder="Enter your driver's license number" required>
        </div>
        <div class="mb-3">
            <label for="drivers_license_expiry" class="form-label">Driver's License Expiry</label>
            <input type="date" class="form-control" id="drivers_license_expiry" name="drivers_license_expiry" value="<?= htmlspecialchars($user['drivers_license_expiry']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <hr class="my-4">

    <h3>Change Password</h3>
    <form action="<?= site_url('user/update/password') ?>" method="post">
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password" required>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter a new password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>