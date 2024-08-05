<?php
session_start();

$title = 'Konfirmasi Logout';

// membatasi sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
                document.location.href = 'login'
              </script>";
    exit;
}

if (isset($_POST["hapus_sesi"])) {
    // kosongkan sesion
    $_SESSION = [];

    session_unset();
    session_destroy();
    header("location: index");
}

include 'layout/header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Logout</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Konfirmasi Logout</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Logout dari Sistem ?</h4>
                    <p>Apakah Anda Yakin?</p>
                    <form action="" class="mb-2" method="post">
                        <button type="submit" name="hapus_sesi" class="btn btn-success">Yakin</button>
                    </form>
                    <a style="text-decoration:none;" href="dashboard" class="btn btn-danger">Kembali ke Dashboard</a>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'layout/footer.php'; ?>