<div class="m-5">

    <a class="btn btn-dark my-2" href="<?= site_url('admin/cars_add') ?>">Add Car</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th >Transmission</th>
                    <th>Plate Number</th>
                    <th>Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cars as $car): ?>
                    <tr>
                        <td><a href="<?= site_url('admin/car_view/') . $car['id'] ?>"><?= $car['id'] ?></a></td>
                        <td><?= $car['car_type'] ?></td>
                        <td><?= $car['make'] ?></td>
                        <td><?= $car['model'] ?></td>
                        <td><?= $car['transmission'] ?></td>
                        <td><?= $car['plate_number'] ?></td>
                        <td><?= $car['rental_price_per_day'] ?></td>
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