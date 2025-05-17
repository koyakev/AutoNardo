<div class="text-center container my-5 w-50">
    <img src="<?= base_url('uploads/' . $car['image']) ?>" class="img-fluid h-25 rounded shadow">

    <div class="my-4 p-3 bg-white rounded shadow">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>ID:</td>
                    <td><?= $car['id'] ?></td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td><?= $car['car_type'] ?></td>
                </tr>
                <tr>
                    <td>Brand:</td>
                    <td><?= $car['make'] ?></td>
                </tr>
                <tr>
                    <td>Model:</td>
                    <td><?= $car['model'] ?></td>
                </tr>
                <tr>
                    <td>Transmission:</td>
                    <td><?= $car['transmission'] ?></td>
                </tr>
                <tr>
                    <td>Plate Number:</td>
                    <td><?= $car['plate_number'] ?></td>
                </tr>
                <tr>
                    <td>Rate:</td>
                    <td><?= $car['rental_price_per_day'] ?></td>
                </tr>
                <tr>
                    <td>Available:</td>
                    <td><?= $car['is_available'] ?></td>
                </tr>
                <tr>
                    <td colspan=2 align=right>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_data">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm_delete">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="edit_data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $car['id'] ?></h5>
            </div>
            <?= form_open_multipart('admin/car_view/' . $car['id'] . '/edit'); ?>
                <div class="modal-body">
                    <input type="hidden" name="brand" value="<?= $car['make'] ?>">
                    <input type="hidden" name="model" value="<?= $car['model'] ?>">
                    <input type="hidden" name="transmission" value="<?= $car['transmission'] ?>">

                    <label class="form-label">Plate Number:</label>
                    <input type="text" name="plate_number" class="form-control mb-3" value="<?= $car['plate_number'] ?>" required>

                    <label class="form-label">Rate:</label>
                    <input type="number" step="0.01" name="rate" class="form-control mb-3" value="<?= $car['rental_price_per_day'] ?>" required>

                    <label class="form-label">Photos:</label>
                    <input type="file" name="photo" class="form-control mb-3">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-dark">Update</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<div id="confirm_delete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $car['id'] ?></h5>
            </div>
            <div class="modal-body">
                Are you sure to delete <?= $car['id'] ?>?
            </div>
            
            <div class="modal-footer">
                <form method="POST" action="<?= site_url('admin/car_view/' . $car['id'] . '/delete') ?>">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-dark">Delete</button>
                </form>
            </div>
        </div>
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