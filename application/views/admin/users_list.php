<div class="m-5">

    <a class="btn btn-dark my-2" href="<?= site_url('admin/users_add') ?>">Add User</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><a href="<?= site_url('admin/user_view/') . $user['id'] ?>"><?= $user['id'] ?></a></td>
                        <td><?= $user['full_name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><span class="<?= ($user['is_active'] == 1 ? 'p-1 bg-primary rounded text-white' : 'p-1 bg-secondary rounded text-white') ?>"><?= ($user['is_active'] == 1 ? 'Active' : 'Inactive') ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="messageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><?= $this->session->flashdata('message') ?></h5>
            </div>
            
            <div class="modal-footer">
                <form method="POST">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if($this->session->flashdata('message')): ?>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            let messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
        })
    </script>
<?php endif; ?>