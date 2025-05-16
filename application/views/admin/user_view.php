<div class="text-center container my-5 w-50">
    <img src="<?= base_url('assets/images/User_Icon.jpg') ?>" class="img-fluid w-25 border border-5 border-white shadow rounded-circle">
    <div class="p-3 bg-white rounded shadow my-3">
        <div class="d-flex align-items-center mb-3 fs-4">
            <a href="<?= site_url('admin/users_list') ?>" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>ID:</td>
                    <td><?= $user['id'] ?></td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td><?= $user['full_name'] ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?= $user['email'] ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?= $user['address'] ?></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><?= $user['phone'] ?></td>
                </tr>
                <tr>
                    <td>License Number:</td>
                    <td><?= $user['drivers_license_number'] ?></td>
                </tr>
                <tr>
                    <td>License Expiry:</td>
                    <td><?= $user['drivers_license_expiry'] ?></td>
                </tr>
                <tr>
                    <td>Admin</td>
                    <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <td colspan=2 align=right>
                        <a class="btn btn-warning" href="<?= site_url('admin/set_active/' . $user['id']) ?>"><?= ($user['is_active'] == 1) ? "Set to Inactive?" : "Set to Active" ?></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>