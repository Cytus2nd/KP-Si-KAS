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
<script>
    function updateTime() {
        const currentTimeElement = document.getElementById('current-time');
        const now = new Date();
        const formattedTime = now.toLocaleString('en-US', { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit' 
        });
        currentTimeElement.textContent = formattedTime;
    }

    setInterval(updateTime, 1000);
    updateTime();  // initial call to display time immediately
</script>

</body>

</html>