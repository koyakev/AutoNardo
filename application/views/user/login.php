<?php if($this->session->flashdata('message')): ?>
    <p><?= $this->session->flashdata('message'); ?></p>
<?php endif; ?>

<form method="POST" action="<?= site_url('auth/verify') ?>">
    <input type="text" name="email">
    <input type="password" name="password">
    <button>Login</button>
</form>
<a href="#">No account yet?</a>