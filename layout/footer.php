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
<script>
    const ctx = document.getElementById('donutchart');

    new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Pemasukan', 'Pengeluaran'],
      datasets: [{
        label: '',
        data: [200000, 100000],
        borderWidth: 1,
        backgroundColor: [
        'blue',   // Warna untuk Pemasukan
        'red'     // Warna untuk Pengeluaran
      ]
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctz = document.getElementById('donutchart2');

    new Chart(ctz, {
    type: 'doughnut',
    data: {
      labels: ['Pengeluaran', 'Pemasukan'],
      datasets: [{
        label: '',
        data: [100000, 200000],
        borderWidth: 1,
        backgroundColor: [
        'red',   // Warna untuk Pemasukan
        'blue'     // Warna untuk Pengeluaran
      ]
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>

</html>