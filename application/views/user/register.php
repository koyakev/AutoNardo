<?php if($this->session->flashdata('message')): ?>
    <p><?= $this->session->flashdata('message'); ?></p>
<?php endif; ?>

<form method="POST" action="<?= site_url('auth/store') ?>">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="text" name="drivers_license_number" placeholder="Driver's License Number" required>
    <input type="date" name="drivers_license_expiry" placeholder="Driver's License Expiry" required>
    <button>Register</button>
</form>
<a href="<?= site_url('login') ?>">Already have an account?</a>