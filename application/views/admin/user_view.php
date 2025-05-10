<table>
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