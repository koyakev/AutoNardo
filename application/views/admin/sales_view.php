<div class="m-5">
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Transaction Reference</th>
                    <th>Transaction Date</th>
                    <th>Duration Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sales as $sale): ?>
                    <tr>
                        <td><button type="button" class="btn btn-warning" onclick="view_data(<?= $sale['id'] ?>)" data-bs-toggle="modal" data-bs-target="#view_data_modal"><?= $sale['transaction_reference'] ?></button></td>
                        <td><?= $sale['transaction_date'] ?></td>
                        <td><?= $sale['start_date'] ?> - <?= $sale['end_date'] ?></td>
                        <td><?= $sale['amount'] ?></td>
                        <td><?= $sale['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="view_data_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <label class="form-label">Transaction ID:</label>
                <input type="text" id="modalReference" class="form-control mb-3" readonly>

                <label class="form-label">User ID:</label>
                <input type="text" id="modalUser" class="form-control mb-3" readonly>

                <label class="form-label">Amount:</label>
                <input type="text" id="modalAmount" class="form-control mb-3" readonly>

                <label class="form-label">Payment Method:</label>
                <input type="text" id="modalMethod" class="form-control mb-3" readonly>
                
                <label class="form-label">Status:</label>
                <input type="text" id="modalStatus" class="form-control mb-3" readonly>

                <label class="form-label">Car ID:</label>
                <input type="text" id="modalCar" class="form-control mb-3">

                <label class="form-label">Transaction Date:</label>
                <input type="text" id="modalTransactionDate" class="form-control mb-3" readonly>

                <label class="form-label">Duration Date:</label>
                <input type="text" id="modalDurationDate" class="form-control mb-3" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
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