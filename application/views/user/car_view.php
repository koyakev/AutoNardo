<?php
$user = $this->session->userdata('user');
if (!$user):
	// If not logged in, redirect
	redirect(site_url('/login'));
endif;
?>

<?php if ($this->session->flashdata('message')): ?>
	<div class="alert alert-danger">
		<?= $this->session->flashdata('message') ?>
	</div>
<?php endif; ?>

<!-- Car Details Styled Like New -->
<section class="car-details py-5">
	<div class="container">
		<div class="row">
			<!-- Car Image -->
			<div class="col-lg-7 mb-4">
				<div class="car-image rounded-3 shadow">
					<img src="<?= base_url('uploads/' . $car['image']) ?>" class="img-fluid rounded-3" alt="<?= $car['make'] . ' ' . $car['model'] ?>">
				</div>

				<!-- Car Specs (Old Data) -->
				<div class="car-specs mt-4">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th scope="row" class="bg-light">ID</th>
								<td><?= $car['id'] ?></td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Type</th>
								<td><?= $car['car_type'] ?></td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Brand</th>
								<td><?= $car['make'] ?></td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Model</th>
								<td><?= $car['model'] ?></td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Transmission</th>
								<td><?= $car['transmission'] ?></td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Plate Number</th>
								<td><?= $car['plate_number'] ?></td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Rate</th>
								<td>₱<?= $car['rental_price_per_day'] ?> / day</td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Condition</th>
								<td><?= $car['condition_status'] ?></td>
							</tr>
							<tr>
								<th scope="row" class="bg-light">Available</th>
								<td><?= $car['is_available'] ? 'Yes' : 'No' ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Booking Form Styled Like New -->
			<div class="col-lg-5">
				<div class="booking-form card shadow-sm">
					<div class="card-body">
						<h2 class="card-title mb-4"><?= $car['make'] . ' ' . $car['model'] ?></h2>
						<form method="POST" action="<?= site_url('book') ?>">
							<div class="mb-3">
								<label for="start_date" class="form-label">Pickup Date</label>
								<input type="date" class="form-control" name="start_date" id="start_date" required>
							</div>
							<div class="mb-3">
								<label for="end_date" class="form-label">Return Date</label>
								<input type="date" class="form-control" name="end_date" id="end_date" required>
							</div>
							<div class="mb-4">
								<h3 class="price">₱ <span id="price"><?= $car['rental_price_per_day'] ?></span></h3>
							</div>
							<input type="hidden" name="user_id" value="<?= htmlspecialchars($user->id); ?>">
							<input type="hidden" name="status" value="pending">
							<input type="hidden" name="car_id" value="<?= $car['id'] ?>">
							<button type="submit" class="btn btn-primary w-100 py-2">Book Now!</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if ($this->session->flashdata('message')): ?>
	<div class="container mt-4">
		<div class="alert alert-danger">
			<?= $this->session->flashdata('message') ?>
		</div>
	</div>
<?php endif; ?>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
	$(document).ready(function() {
		$('#start_date, #end_date').on('change', function() {
			let start = new Date($('#start_date').val());
			let end = new Date($('#end_date').val());
			let days = (end - start) / (1000 * 60 * 60 * 24);
			let rentalPricePerDay = <?= $car['rental_price_per_day'] ?>;

			if (isNaN(days) || days <= 0) {
				$('#price').text(0);
			} else {
				$('#price').text(days * rentalPricePerDay);
			}
		});
	});
</script>