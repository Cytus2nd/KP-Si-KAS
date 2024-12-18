<?php
session_start();
$title = 'Kas PMR';

if (!isset($_SESSION['login'])) {
    header('Location: login');
    exit;
}

// Restrict access based on jabatan
if ($_SESSION['jabatan'] == 3 || $_SESSION['jabatan'] == 4 || $_SESSION['jabatan'] == 6) {
    header('Location: unauthorized'); // Redirect to an unauthorized access page
    exit;
}

include 'layout/header.php';
include 'backend/view_pmr.php';
include 'backend/script_pmr.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Kas PMR</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Kas Organisasi PMR</li>
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
                <div class="col-12">
                    <form method="GET" action="" id="filterForm">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bulan">Bulan:</label>
                                    <select id="bulan" name="bulan" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                        <?php
                                        foreach ($nama_bulan as $num => $name) {
                                            $selected = ($num == $bulan) ? 'selected' : '';
                                            echo "<option value='$num' $selected>$name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tahun">Tahun:</label>
                                    <select id="tahun" name="tahun" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                        <?php
                                        $currentYear = date('Y');
                                        for ($i = $currentYear; $i <= $currentYear + 5; $i++) {
                                            $selected = ($i == $tahun) ? 'selected' : '';
                                            echo "<option value='$i' $selected>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tipe_kas">Tipe Kas:</label>
                                    <select id="tipe_kas" name="tipe_kas" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                        <option value="semua" <?= ($tipe_kas == 'semua') ? 'selected' : ''; ?>>Semua</option>
                                        <option value="pemasukan" <?= ($tipe_kas == 'pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                                        <option value="pengeluaran" <?= ($tipe_kas == 'pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="col-4">
                        <form method="GET" action="">
                            <div class="input-group">
                                <input type="text" id="cari" name="cari" class="form-control" placeholder="Cari..." value="<?= htmlspecialchars($cari); ?>">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search px-1"></i>Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-8 d-flex flex-row-reverse">
                        <?php if ($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2 || $_SESSION['jabatan'] == 5) : ?>
                            <button class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#modalTambahPmr"><i class="fas fa-plus-circle px-1"></i>Tambah Data</button>
                        <?php endif; ?>
                        <a href="pdf_report/generate_pdf_pmr.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" class="btn btn-danger"><i class="fas fa-file-pdf px-1"></i>Cetak Laporan PDF</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-light table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jumlah Kas</th>
                                <th>Tipe Kas</th>
                                <th>Keterangan</th>
                                <th>Last Edit At</th>
                                <th>Last Edit By</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data_pmr)) : ?>
                                <tr>
                                    <td colspan="8" class="text-center">Data Tidak Ada</td>
                                </tr>
                            <?php else : ?>
                                <?php $no = $offset + 1; ?>
                                <!-- view all data  -->
                                <?php foreach ($data_pmr as $pmr) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>Rp <?= number_format($pmr['jumlah'], 0, ',', '.'); ?></td>
                                        <td style="color: <?= $pmr['tipe_kas'] == 'pemasukan' ? 'blue' : ($pmr['tipe_kas'] == 'pengeluaran' ? 'red' : ''); ?>;">
                                            <?= htmlspecialchars($pmr['tipe_kas']); ?>
                                        </td>
                                        <td><?= htmlspecialchars($pmr['keterangan']); ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($pmr['created_at'])); ?></td>
                                        <td><?= htmlspecialchars($pmr['nama']); ?></td>
                                        <td class="text-center">
                                            <?php if ($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
                                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbahPmr<?= $pmr['id_kas_pmr']; ?>"><i class="fas fa-edit px-1"></i>Ubah</button>
                                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapusPmr<?= $pmr['id_kas_pmr']; ?>"><i class="fas fa-trash-alt px-1"></i>Hapus</button>
                                            <?php elseif ($_SESSION['jabatan'] == 3) : ?>
                                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbahPmr<?= $pmr['id_kas_pmr']; ?>"><i class="fas fa-edit px-1"></i>Ubah</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <form method="GET" action="">
                        <label for="">Jumlah Data Per Halaman</label>
                        <input type="hidden" name="bulan" value="<?= $bulan ?>">
                        <input type="hidden" name="tahun" value="<?= $tahun ?>">
                        <input type="hidden" name="tipe_kas" value="<?= $tipe_kas ?>">
                        <input type="hidden" name="cari" value="<?= $cari ?>">
                        <select name="limit" id="limit" class="form-select" onchange="this.form.submit()">
                            <option value="10" <?= ($limit == 10) ? 'selected' : ''; ?>>10</option>
                            <option value="20" <?= ($limit == 20) ? 'selected' : ''; ?>>20</option>
                            <option value="50" <?= ($limit == 50) ? 'selected' : ''; ?>>50</option>
                            <option value="100" <?= ($limit == 100) ? 'selected' : ''; ?>>100</option>
                            <option value="250" <?= ($limit == 250) ? 'selected' : ''; ?>>250</option>
                        </select>
                        <label for=""> <small>*Sesuaikan Spek Device dengan jumlah data yang ditampilkan</small> </label>
                    </form>
                </div>
                <div class="col-md-6 pt-2">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>&tipe_kas=<?= $tipe_kas ?>&cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>&tipe_kas=<?= $tipe_kas ?>&cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>&tipe_kas=<?= $tipe_kas ?>&cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahPmr" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kas PMR</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                    <div class="mb-3">
                        <label for="jumlah">Jumlah Kas</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipe_kas">Tipe Kas</label>
                        <select name="tipe_kas" id="tipe_kas" class="form-select" required>
                            <?php if ($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
                                <option value="pemasukan">Pemasukan</option>
                            <?php endif ?>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($data_pmr as $pmr) : ?>
    <?php if ($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2 || ($_SESSION['jabatan'] == 3 && $pmr['tipe_kas'] == 'pemasukan')) : ?>
        <div class="modal fade" id="modalUbahPmr<?= $pmr['id_kas_pmr']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Kas PMR</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                            <input type="hidden" name="id_kas_pmr" value="<?= $pmr['id_kas_pmr']; ?>">
                            <input type="hidden" name="tipe_kas_awal" value="<?= $pmr['tipe_kas']; ?>">
                            <div class="mb-3">
                                <label for="jumlah">Jumlah Kas</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" required value="<?= $pmr['jumlah']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" required value="<?= $pmr['keterangan']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tipe_kas">Tipe Kas</label>
                                <select name="tipe_kas" id="tipe_kas" class="form-select" required>
                                    <option value="pemasukan" <?= $pmr['tipe_kas'] == 'pemasukan' ? 'selected' : '' ?> <?= $pmr['tipe_kas'] == 'pengeluaran' ? 'disabled' : '' ?>>Pemasukan</option>
                                    <option value="pengeluaran" <?= $pmr['tipe_kas'] == 'pengeluaran' ? 'selected' : '' ?> <?= $pmr['tipe_kas'] == 'pemasukan' ? 'disabled' : '' ?>>Pengeluaran</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($data_pmr as $pmr) : ?>
    <?php if ($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
        <div class="modal fade" id="modalHapusPmr<?= $pmr['id_kas_pmr']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Kas</h1>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Hapus Data berikut ini ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="" method="post">
                            <input type="hidden" name="id_kas_pmr" value="<?= $pmr['id_kas_pmr']; ?>">
                            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>