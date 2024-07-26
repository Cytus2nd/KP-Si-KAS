<?php
session_start();
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
                    <h1 class="m-0 fw-bold">Kas Masuk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Pencatatan Kas Masuk oleh OSIS</li>
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
                <form method="POST">
                    <div class="form-group">
                        <label for="totalAmount">Jumlah Total Kas :</label>
                        <input type="number" class="form-control" id="totalAmount" name="totalAmount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Hitung</button>
                </form>
            </div>
            <!-- /.row -->
            
            <?php if ($results): ?>
            <div class="row mt-3">
                <div class="col-md-12 alert-danger pt-3 rounded">
                    <h4>Hasil Pembagian Uang Kas:</h4>
                    <ul>
                        <li>OSIS    : <?php echo number_format($results['osis'], 0, ',', '.'); ?></li>
                        <li>Pramuka : <?php echo number_format($results['pramuka'], 0, ',', '.'); ?></li>
                        <li>KKR     : <?php echo number_format($results['kkr'], 0, ',', '.'); ?></li>
                        <li>PMR     : <?php echo number_format($results['pmr'], 0, ',', '.'); ?></li>
                        <li><strong>Total: <?php echo number_format($results['total'], 0, ',', '.'); ?></strong></li>
                        <br>
                        <p class="fw-bold">CATATAN : Mohon Jangan diRefresh halaman ini jika data diatas belum dicatat/note. Dikarenakan data akan hilang setelah direfresh </p>
                    </ul>
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
