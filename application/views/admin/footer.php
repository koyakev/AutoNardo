        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(document).ready(function() {
                <?php if($title == 'Admin Dashboard'): ?>
                let years = <?= json_encode($yearly['years']); ?>;
                let sales_json = <?= json_encode($yearly['sales']); ?>;
                let sales = [];
                let sales_json_monthly = <?= json_encode($monthly); ?>;
                let sales_monthly = [];
                let car_portions = <?= json_encode($car_portions) ?>;
                let car_id = [];
                let car_stats = [];

                sales_json.map(sale => {
                    sales.push(sale["SUM(AMOUNT)"]);
                });

                sales_json_monthly.map(sale => {
                    sales_monthly.push(sale["SUM(amount)"]);
                });

                car_portions.map(car => {
                    car_id.push(car.car_id);
                    car_stats.push(car.count);
                });

                let backgroundColors = generateColors(car_portions.length);
                
                const salesChartYearly = document.getElementById('salesChartYearly').getContext('2d');
                const salesChartMonthly = document.getElementById('salesChartMonthly').getContext('2d');
                const carsStats = document.getElementById('carStats').getContext('2d');

                const cars_stats = new Chart(carsStats, {
                    type: 'doughnut',
                    data: {
                        labels: car_id,
                        datasets: [{
                            label: 'Car Stats',
                            data: car_stats,
                            backgroundColor: backgroundColors,
                            fill: false,
                            tension: 0.3,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                // ticks: {
                                //     callback: function(value) {
                                //         return '₱' + value;
                                //     }
                                // }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Yearly Payments'
                            }
                        }
                    }
                });

                const sales_chart_yearly = new Chart(salesChartYearly, {
                    type: 'line',
                    data: {
                        labels: years,
                        datasets: [{
                                label: '2025 Sales',
                                data: sales,
                                backgroundColor: '#2f2f2f',
                                fill: false,
                                tension: 0.3,
                            }, {
                                label: 'Target Sales',
                                data: [100000, 100000, 100000],
                                backgroundColor: '#F0FFFF',
                                fill: false,
                                tension: 0.3
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                // beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '₱' + value;
                                    },
                                    max: 200000,
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Yearly Payments'
                            }
                        }
                    }
                });

                const sales_chart_monthly = new Chart(salesChartMonthly, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: '2025 Monthly Sales',
                            data: sales_monthly,
                            backgroundColor: '#2f2f2f',
                            fill: false,
                            tension: 0.3,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '₱' + value;
                                    }
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Yearly Payments'
                            }
                        }
                    }
                });
                <?php endif; ?>

                $(".view-btn").on('click', function() {
                    console.log($(this).data('id'));
                })

                $("#confirmed").css({ "display" : "none" });

                $("#btn_confirmed").on('click', function() {
                    $("#pending").css({ "display" : "none" });
                    $("#confirmed").css({ "display" : "block" });
                    $("#btn_confirmed").prop('class', 'btn btn-dark');
                    $("#btn_pending").prop('class', 'btn btn-outline-dark');
                });

                $("#btn_pending").on('click', function() {
                    $("#pending").css({ "display" : "block" });
                    $("#confirmed").css({ "display" : "none" });
                    $("#btn_pending").prop('class', 'btn btn-dark');
                    $("#btn_confirmed").prop('class', 'btn btn-outline-dark');
                });

            });
            
            function view_data(data) {
                let id = data;
                
                $.ajax({
                    url: "<?= site_url('admin/get_transaction/') ?>",
                    method: "POST",
                    data: { id: id },
                    success: function(data) {
                        let transaction_data = JSON.parse(data);
                        console.log(transaction_data);
                        $('#modalReference').val(transaction_data['transaction_reference']);
                        $('#modalUser').val(transaction_data['user_id']);
                        $('#modalAmount').val(transaction_data['amount']);
                        $('#modalMethod').val(transaction_data['payment_method']);
                        $('#modalStatus').val(transaction_data['status'].charAt(0).toUpperCase() + transaction_data['status'].slice(1));
                        $('#modalCar').val(transaction_data['car_id']);
                        $('#modalTransactionDate').val(transaction_data['transaction_date']);
                        $('#modalDurationDate').val(transaction_data['start_date'] + " - " + transaction_data['end_date']);
                    },
                    error: function(error) {
                        console.error("Error: ", error);
                    }
                })
                
            }

            function generateColors(count) {
                const colors = [];
                for (let i = 0; i < count; i++) {
                    // Generate random hex color
                    const color = '#' + Math.floor(Math.random()*16777215).toString(16).padStart(6, '0');
                    colors.push(color);
                }
                return colors;
            }

            
        </script>
    </body>
</html>