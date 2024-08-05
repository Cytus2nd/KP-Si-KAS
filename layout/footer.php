<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Hendri dan Rio
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024 </strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="app/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="app/dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="app/plugins/chart.js/Chart.min.js"></script>
<!-- time script -->
<script src="assets/js/script.js"></script>
<!-- boostrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- chart script -->
<script>
    // Dapatkan data dari PHP
    var pemasukan_osis = <?php echo json_encode($pemasukan_osis); ?>;
    var pengeluaran_osis = <?php echo json_encode($pengeluaran_osis); ?>;

    var pemasukan_pramuka = <?php echo json_encode($pemasukan_pramuka); ?>;
    var pengeluaran_pramuka = <?php echo json_encode($pengeluaran_pramuka); ?>;

    var pemasukan_pmr = <?php echo json_encode($pemasukan_pmr); ?>;
    var pengeluaran_pmr = <?php echo json_encode($pengeluaran_pmr); ?>;

    var pemasukan_kkr = <?php echo json_encode($pemasukan_kkr); ?>;
    var pengeluaran_kkr = <?php echo json_encode($pengeluaran_kkr); ?>;

    $(function() {
        // donut chart osis
        var donutChartCanvas = $('#donutChartOsis').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Pemasukan',
                'Pengeluaran',
            ],
            datasets: [{
                data: [pemasukan_osis, pengeluaran_osis],
                backgroundColor: ['#00a65a', '#f56954'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        // line chart osis
        var lineChartCanvas = $('#lineChartOsis').get(0).getContext('2d')
        var lineChartData = {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Keuangan',
                data: [pemasukan_osis, pengeluaran_osis],
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                fill: false,
            }]
        }

        var lineChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var value = tooltipItem.raw;
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })

        // donut chart pramuka
        var donutChartCanvas = $('#donutChartPr').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Pemasukan',
                'Pengeluaran',
            ],
            datasets: [{
                data: [pemasukan_pramuka, pengeluaran_pramuka],
                backgroundColor: ['#00a65a', '#f56954'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        // line chart pramuka
        var lineChartCanvas = $('#lineChartPr').get(0).getContext('2d')
        var lineChartData = {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Keuangan',
                data: [pemasukan_pramuka, pengeluaran_pramuka],
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                fill: false,
            }]
        }

        var lineChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var value = tooltipItem.raw;
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })

        // donut chart pmr
        var donutChartCanvas = $('#donutChartPm').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Pemasukan',
                'Pengeluaran',
            ],
            datasets: [{
                data: [pemasukan_pmr, pengeluaran_pmr],
                backgroundColor: ['#00a65a', '#f56954'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        // line chart pmr
        var lineChartCanvas = $('#lineChartPm').get(0).getContext('2d')
        var lineChartData = {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Keuangan',
                data: [pemasukan_pmr, pengeluaran_pmr],
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                fill: false,
            }]
        }

        var lineChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var value = tooltipItem.raw;
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })

        // donut chart kkr
        var donutChartCanvas = $('#donutChartKk').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Pemasukan',
                'Pengeluaran',
            ],
            datasets: [{
                data: [pemasukan_kkr, pengeluaran_kkr],
                backgroundColor: ['#00a65a', '#f56954'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        // line chart pramuka
        var lineChartCanvas = $('#lineChartKk').get(0).getContext('2d')
        var lineChartData = {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Keuangan',
                data: [pemasukan_kkr, pengeluaran_kkr],
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                fill: false,
            }]
        }

        var lineChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var value = tooltipItem.raw;
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })
    })
</script>

</body>

</html>