<div class="text-center container my-5 w-50">
    <img src="<?= base_url('assets/images/User_Icon.jpg') ?>" class="img-fluid w-25 border border-5 border-white shadow rounded-circle">
    <div class="p-3 bg-white rounded shadow my-3">
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
            </tbody>
        </table>
    </div>
</div>