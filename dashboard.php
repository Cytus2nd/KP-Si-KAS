<?php
session_start();
$title = 'Dashboard';

if (!isset($_SESSION['login'])) {
    header('Location: login');
    exit;
}

$nama = $_SESSION['nama'];
$jabatan = $_SESSION['jabatan']; // assuming jabatan is stored in session

include 'backend/reading_data.php';
include 'layout/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Halaman Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <h5 class="pb-2">Selamat Datang, <?= htmlspecialchars($nama) ?>.</h5>

            <!-- Bagian OSIS -->
            <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 3) { ?>
                <div class="row mt-3">
                    <h5 class="pb-1"><span class="fw-bold">Summary Kas OSIS</span> (Bulan <?= htmlspecialchars($current_month) ?>, Tahun <?= htmlspecialchars($current_year) ?>)</h5>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem">
                            <img class="card-img-top" src="./assets/img/2.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pemasukan Bulan Ini : Rp <span id="pemasukan_osis"><?= number_format($pemasukan_osis) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem; height: fit;">
                            <img class="card-img-top" src="./assets/img/1.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pengeluaran Bulan Ini : Rp <span id="pengeluaran_osis"><?= number_format($pengeluaran_osis) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem;">
                            <img class="card-img-top" src="./assets/img/3.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Sisa Kas : Rp <span id="total_kas_osis"><?= number_format($universal_total_kas_osis) ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <div class="col-lg-5">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Donut Chart OSIS</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChartOsis" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Line Chart OSIS</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChartOsis" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Bagian Pramuka -->
            <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 4) { ?>
                <div class="row mt-3">
                    <h5 class="pb-1"><span class="fw-bold">Summary Kas Pramuka</span> (Bulan <?= htmlspecialchars($current_month) ?>, Tahun <?= htmlspecialchars($current_year) ?>)</h5>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem">
                            <img class="card-img-top" src="./assets/img/2.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pemasukan Bulan Ini : Rp <span id="pemasukan_pramuka"><?= number_format($pemasukan_pramuka) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem; height: fit;">
                            <img class="card-img-top" src="./assets/img/1.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pengeluaran Bulan Ini : Rp <span id="pengeluaran_pramuka"><?= number_format($pengeluaran_pramuka) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem;">
                            <img class="card-img-top" src="./assets/img/3.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Sisa Kas : Rp <span id="total_kas_pramuka"><?= number_format($universal_total_kas_pramuka) ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <div class="col-lg-5">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Donut Chart Pramuka</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChartPr" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Line Chart Pramuka</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChartPr" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Bagian PMR -->
            <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 5) { ?>
                <div class="row mt-3">
                    <h5 class="pb-1"><span class="fw-bold">Summary Kas PMR</span> (Bulan <?= htmlspecialchars($current_month) ?>, Tahun <?= htmlspecialchars($current_year) ?>)</h5>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem">
                            <img class="card-img-top" src="./assets/img/2.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pemasukan Bulan Ini : Rp <span id="pemasukan_pmr"><?= number_format($pemasukan_pmr) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem; height: fit;">
                            <img class="card-img-top" src="./assets/img/1.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pengeluaran Bulan Ini : Rp <span id="pengeluaran_pmr"><?= number_format($pengeluaran_pmr) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem;">
                            <img class="card-img-top" src="./assets/img/3.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Sisa Kas : Rp <span id="total_kas_pmr"><?= number_format($universal_total_kas_pmr) ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <div class="col-lg-5">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Donut Chart PMR</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChartPm" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Line Chart PMR</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChartPm" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Bagian KKR -->
            <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 6) { ?>
                <div class="row mt-3">
                    <h5 class="pb-1"><span class="fw-bold">Summary Kas KKR</span> (Bulan <?= htmlspecialchars($current_month) ?>, Tahun <?= htmlspecialchars($current_year) ?>)</h5>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem">
                            <img class="card-img-top" src="./assets/img/2.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pemasukan Bulan Ini : Rp <span id="pemasukan_kkr"><?= number_format($pemasukan_kkr) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem; height: fit;">
                            <img class="card-img-top" src="./assets/img/1.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Pengeluaran Bulan Ini : Rp <span id="pengeluaran_kkr"><?= number_format($pengeluaran_kkr) ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <div class="card" style="width: 22rem;">
                            <img class="card-img-top" src="./assets/img/3.png" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <p class="fs-6 fw-bold card-text">Sisa Kas : Rp <span id="total_kas_kkr"><?= number_format($universal_total_kas_kkr) ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <div class="col-lg-5">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Donut Chart KKR</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChartKk" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Line Chart KKR</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChartKk" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- chart script -->
<?php include 'layout/footer.php'; ?>