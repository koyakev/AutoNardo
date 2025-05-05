<h1>Dashboard</h1>
<p>Users: <?= $users ?></p>
<p>Cars: <?= $cars ?></p>

<p><?= $this->session->userdata('user')->email; ?></p>
<a href="<?= site_url('admin/logout') ?>">Logout</a>