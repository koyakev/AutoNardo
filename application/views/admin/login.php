<h1>Admin</h1>

<?php
    if($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    }

?>

<form method="POST" action="<?= site_url('admin/verify') ?>">
    <input type="text" name="email">
    <input type="password" name="password">
    <button>Login</button>
</form>