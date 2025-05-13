<section class="py-5">
			<div class="container">
				<h1 class="mb-4">Order History</h1>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Car</th>
								<th>Pickup Date</th>
								<th>Return Date</th>
								<th>Total</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($bookings)): ?>
								<?php foreach ($bookings as $booking): ?>
									<tr>
										<td>#<?php echo $booking['id']; ?></td>
										<td><?php echo $booking['car_id']; ?></td>
										<td><?php echo $booking['start_date']; ?></td>
										<td><?php echo $booking['end_date']; ?></td>
										<td>₱<?php echo number_format($booking['total'], 2); ?></td>
										<td><span class="badge bg-success"><?php echo ucfirst($booking['status']); ?></span></td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="6">No rental history found.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>