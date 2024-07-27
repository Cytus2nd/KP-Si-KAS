<?php
session_start();
$title = 'Kas Pramuka';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php';
include 'backend/view_pramuka.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Kas Pramuka</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Kas Organisasi Pramuka</li>
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
                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bulan">Bulan:</label>
                                    <select id="bulan" name="bulan" class="form-control">
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
                                    <select id="tahun" name="tahun" class="form-control">
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
                                    <select id="tipe_kas" name="tipe_kas" class="form-control">
                                        <option value="semua" <?= ($tipe_kas == 'semua') ? 'selected' : ''; ?>>Semua</option>
                                        <option value="pemasukan" <?= ($tipe_kas == 'pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                                        <option value="pengeluaran" <?= ($tipe_kas == 'pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div>
                        <form method="GET" action="">
                            <div class="input-group">
                                <input type="text" id="cari" name="cari" class="form-control" placeholder="Cari..." value="<?= htmlspecialchars($cari); ?>">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <?php if($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2 || $_SESSION['jabatan'] == 3) : ?>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</button>
                        <?php endif; ?>
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
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data_pramuka)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Data Tidak Ada</td>
                        </tr>
                        <?php else: ?>
                        <?php $no = $offset + 1; ?>
                        <!-- view all data  -->
                        <?php foreach ($data_pramuka as $pramuka): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($pramuka['jumlah']); ?></td>
                            <td style="color: <?= $pramuka['tipe_kas'] == 'pemasukan' ? 'blue' : ($osis['tipe_kas'] == 'pengeluaran' ? 'red' : ''); ?>;">
                                <?= htmlspecialchars($pramuka['tipe_kas']); ?>
                            </td>
                            <td><?= htmlspecialchars($pramuka['keterangan']); ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($pramuka['created_at'])); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $pramuka['id_user']; ?>">Ubah</button>
                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $pramuka['id_user']; ?>">Hapus</button>
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
                        <select name="limit" id="limit" class="form-control" onchange="this.form.submit()">
                            <option value="10" <?= ($limit == 10) ? 'selected' : ''; ?>>10</option>
                            <option value="20" <?= ($limit == 20) ? 'selected' : ''; ?>>20</option>
                            <option value="50" <?= ($limit == 50) ? 'selected' : ''; ?>>50</option>
                            <option value="100" <?= ($limit == 100) ? 'selected' : ''; ?>>100</option>
                            <option value="250" <?= ($limit == 250) ? 'selected' : ''; ?>>250</option>
                        </select>
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
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
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

<?php include 'layout/footer.php'; ?>
