

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