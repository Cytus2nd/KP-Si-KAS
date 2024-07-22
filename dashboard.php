<?php 
session_start();
$title = 'Dashboard';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

?>

<?php include 'layout/header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Dashboard Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <h5>Selamat Datang, <?= $username ?></h3>
                <div class="col-lg-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="./assets/img/imgs.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Pemasukan : $pemasukan</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="./assets/img/imgs.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Pengeluaran : $pengeluaran</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="./assets/img/imgs.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Total Kas : $total_kas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- DONUT CHART -->
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pemasukan</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="donutchart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-6">
                    <!-- DONUT CHART -->
                    <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pengeluaran</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="donutchart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'layout/footer.php'; ?>
