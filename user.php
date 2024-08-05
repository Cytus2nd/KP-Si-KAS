<?php
session_start();
$title = 'Data User';

if (!isset($_SESSION['login'])) {
    header('Location: login');
    exit;
}

if ($_SESSION['jabatan'] >= 3) {
    header('Location: unauthorized');
    exit;
}

include 'layout/header.php';
include 'backend/script_user.php';
include 'backend/view_user.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$is_banned = isset($_GET['is_banned']) ? $_GET['is_banned'] : 'semua';
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$offset = ($page - 1) * $limit;

$total_pages = getTotalPages('users', $limit, $is_banned, $cari);
$data_user = getUsers($limit, $offset, $is_banned, $cari, 'created_at', 'DESC');
$jabatan = select("SELECT * FROM jabatan");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data User</li>
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
                <form action="" method="GET" id="filterForm">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="is_banned">Tipe User:</label>
                            <select id="is_banned" name="is_banned" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                <option value="semua" <?= ($is_banned == 'semua') ? 'selected' : ''; ?>>Semua</option>
                                <option value="0" <?= ($is_banned == '0') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="1" <?= ($is_banned == '1') ? 'selected' : ''; ?>>Non Aktif</option>
                            </select>
                        </div>
                    </div>
                </form>

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
                        <div class="col-8">
                            <div>
                                <?php if ($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
                                    <button class="mx-3 btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#modalTambahUs"><i class="fas fa-plus-circle px-1"></i>Tambah Data</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-light table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                                <th>No Telp</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data_user)) : ?>
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ada</td>
                                </tr>
                            <?php else : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($data_user as $user) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($user['nama']); ?></td>
                                        <td><?= htmlspecialchars($user['username']); ?></td>
                                        <td><?= htmlspecialchars($user['nama_jabatan']); ?></td>
                                        <td><?= htmlspecialchars($user['jenis_kelamin']); ?></td>
                                        <td><?= htmlspecialchars($user['no_telp']); ?></td>
                                        <td>Password Hidden.</td>
                                        <td class="fw-bold <?= ($user['is_banned'] == 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?= ($user['is_banned'] == 0) ? 'AKTIF' : 'NONAKTIF'; ?>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbahUs<?= $user['id_user']; ?>"><i class="fas fa-edit px-1"></i>Ubah</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <form method="GET" action="">
                            <label for="">Jumlah Data Per Halaman</label>
                            <input type="hidden" name="is_banned" value="<?= $is_banned ?>">
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
                                    <a class="page-link" href="?is_banned=<?= $is_banned ?>&cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= $page - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?is_banned=<?= $is_banned ?>&cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?is_banned=<?= $is_banned ?>&cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= $page + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahUs" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data User</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="is_banned" value="0">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <small>*Username akan digunakan saat Login</small>
                    </div>
                    <div class="mb-3">
                        <div class="form">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <small>*Password akan digunakan saat Login</small>
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="show-password">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            <?php foreach ($jabatan as $jb) : ?>
                                <option value="<?= $jb['kode_jabatan']; ?>">
                                    <?= htmlspecialchars($jb['nama_jabatan']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp">No Telepon</label>
                        <input type="number" name="no_telp" id="no_telp" class="form-control" required>
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

<?php foreach ($data_user as $user) : ?>
    <!-- modal ubah -->
    <div class="modal fade" id="modalUbahUs<?= $user['id_user']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data User</h1>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id_user']); ?>">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($user['nama']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>" required>
                            <small>*Username akan digunakan saat Login</small>
                        </div>
                        <div class="mb-3">
                            <div class="form">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password-2" class="form-control" required>
                                <small>*Masukkan Pass Baru atau Pass Lama</small>
                            </div>
                            <div class="form-check pt-1">
                                <input type="checkbox" class="form-check-input" id="show-password-2">
                                <label class="form-check-label" for="show-password">Show password</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-select" required>
                                <?php foreach ($jabatan as $jb) : ?>
                                    <option value="<?= htmlspecialchars($jb['kode_jabatan']); ?>" <?= ($user['jabatan'] == $jb['kode_jabatan']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($jb['nama_jabatan']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                <option value="laki-laki" <?php echo ($user['jenis_kelamin'] === 'laki-laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                                <option value="perempuan" <?php echo ($user['jenis_kelamin'] === 'perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp">No Telepon</label>
                            <input type="number" name="no_telp" id="no_telp" class="form-control" value="<?= htmlspecialchars($user['no_telp']); ?>" required>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input type="hidden" name="is_banned" value="0">
                            <input type="checkbox" class="form-check-input" role="switch" name="is_banned" id="is_banned" value="1" <?= ($user['is_banned'] == 1) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="is_banned">Nonaktifkan</label>
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
<?php endforeach; ?>

<script>
    document.getElementById('show-password').addEventListener('change', function() {
        const passwordInput = document.getElementById('password');
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
    document.getElementById('show-password-2').addEventListener('change', function() {
        const passwordInput = document.getElementById('password-2');
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>
<?php include 'layout/footer.php'; ?>