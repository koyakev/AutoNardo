<div class="m-5 bg-white rounded shadow-sm p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>Dashboard</h1>
    <p><?= $this->session->userdata('user')->email; ?></p>
    <a href="<?= site_url('auth/logout') ?>">Logout</a>
    
    <div class="shadow-sm p-3 m-2 rounded">
        <p>Users: <?= $users ?></p>
        <canvas id="userChart" width="200" height="200"></canvas>
    </div>

    <div class="shadow-sm p-3 m-2 rounded">
        <p><a href="<?= site_url('admin/cars_list') ?>">Cars</a>: <?= $cars ?></p>
        <canvas id="carChart" width="200" height="200"></canvas>
    </div>

    <div class="shadow-sm p-3 mx-2 rounded">
        <p>Total Sales: (Monthly, Yearly)</p>
        <canvas id="salesChart" width="200" height="200"></canvas>
    </div>
    
</div>