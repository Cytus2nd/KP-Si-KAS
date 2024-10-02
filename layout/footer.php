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

    $(document).ready(function() {
        // Fungsi untuk membuat chart donat
        function createDonutChart(elementId, data) {
            var canvas = $('#' + elementId);
            if (canvas.length) {
                var context = canvas.get(0).getContext('2d');
                new Chart(context, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pemasukan', 'Pengeluaran'],
                        datasets: [{
                            data: data,
                            backgroundColor: ['#00a65a', '#f56954'],
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                });
            } else {
                console.error('Canvas element #' + elementId + ' not found');
            }
        }

        // Fungsi untuk membuat chart garis
        function createLineChart(elementId, data) {
            var canvas = $('#' + elementId);
            if (canvas.length) {
                var context = canvas.get(0).getContext('2d');
                new Chart(context, {
                    type: 'line',
                    data: {
                        labels: ['Pemasukan', 'Pengeluaran'],
                        datasets: [{
                            label: 'Keuangan',
                            data: data,
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            fill: false,
                        }]
                    },
                    options: {
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
                });
            } else {
                console.error('Canvas element #' + elementId + ' not found');
            }
        }

        // Membuat chart OSIS
        createDonutChart('donutChartOsis', [pemasukan_osis, pengeluaran_osis]);
        createLineChart('lineChartOsis', [pemasukan_osis, pengeluaran_osis]);

        // Membuat chart Pramuka
        createDonutChart('donutChartPr', [pemasukan_pramuka, pengeluaran_pramuka]);
        createLineChart('lineChartPr', [pemasukan_pramuka, pengeluaran_pramuka]);

        // Membuat chart PMR
        createDonutChart('donutChartPm', [pemasukan_pmr, pengeluaran_pmr]);
        createLineChart('lineChartPm', [pemasukan_pmr, pengeluaran_pmr]);

        // Membuat chart KKR
        createDonutChart('donutChartKk', [pemasukan_kkr, pengeluaran_kkr]);
        createLineChart('lineChartKk', [pemasukan_kkr, pengeluaran_kkr]);
    });
</script>


</body>

</html>