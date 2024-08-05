<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login');
    exit;
}

if ($_SESSION['jabatan'] >= 4) {
    header('Location: unauthorized');
    exit;
}

ob_start(); // Start output buffering

$title = 'Kas Masuk oleh OSIS';
include 'layout/header.php';
include 'backend/masuk.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Kas Masuk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Pencatatan Kas Masuk oleh Bendahara OSIS</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12 alert-info rounded pt-3">
                    <p class="fw-bold text-light">Masukkan Jumlah Kas yang ada dan Sistem akan membagi kas otomatis berdasarkan Porsi yang Telah ada</p>
                    <ul class="text-light">
                        <li>OSIS : <span class="fw-bold">50%</span></li>
                        <li>Pramuka : <span class="fw-bold">30%</span></li>
                        <li>KKR : <span class="fw-bold">10%</span></li>
                        <li>PMR : <span class="fw-bold">10%</span></li>
                    </ul>
                </div>
            </div>
            <div class="row ">
                <form method="POST">
                    <div class="form-group">
                        <label for="totalAmount">Jumlah Total Kas :</label>
                        <input type="number" class="form-control" id="totalAmount" name="totalAmount" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-calculator px-2"></i>Hitung</button>
                </form>
            </div>
            <!-- /.row -->

            <?php if ($results) : ?>
                <div class="row mt-3">
                    <div class="col-md-12 alert-danger pt-3 rounded">
                        <h4>Hasil Pembagian Uang Kas:</h4>
                        <ul style="list-style-type: none;">
                            <li>OSIS : <span class="fw-bold">Rp <?php echo number_format($results['osis'], 0, ',', '.'); ?></span></li>
                            <li>Pramuka : <span class="fw-bold">Rp <?php echo number_format($results['pramuka'], 0, ',', '.'); ?></span></li>
                            <li>KKR : <span class="fw-bold">Rp <?php echo number_format($results['kkr'], 0, ',', '.'); ?></span></li>
                            <li>PMR : <span class="fw-bold">Rp <?php echo number_format($results['pmr'], 0, ',', '.'); ?></span></li>
                            <li><strong>Total: Rp <?php echo number_format($results['total'], 0, ',', '.'); ?></strong></li>
                        </ul>
                        <p class="fw-bold">CATATAN : Mohon Jangan diRefresh halaman ini jika data diatas belum dicatat/note. Dikarenakan data hasil pembagian akan hilang setelah direfresh </p>
                        <p>*Data Hasil Bagi diatas akan otomatis masuk kedalam tabel masing-masing organisasi</p>
                    </div>
                </div>
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'layout/footer.php'; ?>

<?php
ob_end_flush(); // End output buffering and flush output
?>