<div class="p-3 mx-5 rounded">
    <div class="row">
        <div class="col p-4 m-3 bg-white shadow-sm rounded d-flex flex-column justify-content-center align-items-center text-center">
            <div class="m-1">
                <i class="fa fa-car m-2" aria-hidden="true" style="font-size: 50px"></i>
                <h5>Available Cars: <?= $available_cars ?></h5>
            </div>
            <div class="m-1">
                <i class="fa fa-calendar m-2" aria-hidden="true" style="font-size: 50px"></i>
                <h5>Active Bookings: <?= $upcoming_bookings ?></h5>
            </div>
            <div class="m-1">
                <i class="fa fa-users m-2" aria-hidden="true" style="font-size: 50px"></i>
                <h5>User Count: <?= $user_count ?></h5>
            </div>
        </div>
        <div class="col p-4 m-3 bg-white shadow-sm rounded">
            <h5>Cars Stats:</h5>
            <canvas id="carStats" width="200" height="200"></canvas>
        </div>
        <div class="col-5 p-4 m-3 bg-white shadow-sm rounded">
            <h5>Ongoing Bookings:</h5>
            <div class="table-responsive" style="max-height: 300px;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>User ID</th>
                            <th>Car ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($ongoing_bookings): ?>
                            <?php foreach($ongoing_bookings as $booking): ?>
                                <tr>
                                    <td><?= $booking['start_date'] ?></td>
                                    <td><?= $booking['end_date'] ?></td>
                                    <td><?= $booking['user_id'] ?></td>
                                    <td><?= $booking['car_id'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan=4 align=center>No rentals active at the moment.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col p-4 m-3 bg-white shadow-sm rounded">
            <p>Total Sales: (Yearly)</p>
            <canvas id="salesChartYearly" width="200" height="200"></canvas>
        </div>
        <div class="col p-4 m-3 bg-white shadow-sm rounded">
            <p>Total Sales: (Monthly)</p>
            <canvas id="salesChartMonthly" width="200" height="200"></canvas>
        </div>
    </div>
</div>
