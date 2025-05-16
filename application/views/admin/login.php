<?php
    if($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    }

?>

<div class="container bg-white shadow-sm rounded p-3 mt-5" style="width: 360px">
    <h3 class="mb-3">Login</h3>
    <form method="POST" action="<?= site_url('auth/verify/' . 'admin') ?>">
        <input type="text" name="email" class="form-control mb-3" placeholder="Email">
        <input type="password" name="password" class="form-control mb-3" placeholder="********">
        <div class="flex d-grid">
            <button class="btn btn-dark">Login</button>
        </div>
    </form>
</div>