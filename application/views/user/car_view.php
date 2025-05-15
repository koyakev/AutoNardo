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
		const carID = "<?= $car['id'] ?>";
		const today = new Date();
		const startDateInput = $('#start_date');
		const endDateInput = $('#end_date');

		// Disable past dates for the start date
		startDateInput.attr('min', today.toISOString().split('T')[0]);
	
		function fetchBookedDates() {
			$.ajax({
				url: "<?= site_url('get_booked_dates') ?>",
				type: 'GET',
				data: { car_id: carID },
				success: function(bookedDates) {
					if (typeof bookedDates === 'string') {
						bookedDates = JSON.parse(bookedDates);
					}

					bookedDates.forEach(date => {
						let bookedDate = new Date(date);
						let bookedDateString = bookedDate.toISOString().split('T')[0];
						console.log('Booked Date:', bookedDateString);

						// Disable the booked date for start date input
						if (startDateInput.val() === '' || bookedDate >= new Date(startDateInput.val())) {
							startDateInput.attr('min', bookedDateString);
						}

						// Disable the booked date for end date input
						endDateInput.attr('min', bookedDateString);
					});
				},
				fail: function(jqXHR, textStatus, errorThrown) {
					console.error('Ajax error:', jqXHR, textStatus, errorThrown);
				}
			});
		}

		// Fetch booked dates on page load
		fetchBookedDates();

		startDateInput.on('change', function() {
			let start = new Date(startDateInput.val());
			// Set the minimum date for the end date input after the start date is selected
			endDateInput.attr('min', start.toISOString().split('T')[0]);
		});

		endDateInput.on('change', function() {
			let start = new Date(startDateInput.val());
			let end = new Date(endDateInput.val());
			
			if (end < start) {
				endDateInput.val('');
			}
		});
	});
</script>
