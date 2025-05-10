<p>Hi</p>

<?php if($this->session->userdata('user')): ?>
    <a href="<?= site_url('auth/logout') ?>">Logout</a>
<?php else: ?>
    <a href="<?= site_url('/login') ?>">Login</a>
<?php endif; ?>

<div class="flex">
<h1>Success</h1>
</div>