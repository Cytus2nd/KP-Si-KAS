<?php 
session_start();
$title = 'Data User';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php'; 
include 'backend/script_user.php';

// tampil seluruh data dengan join ke tabel jabatan
$data_user = select("SELECT users.*, jabatan.nama_jabatan FROM users JOIN jabatan ON users.jabatan = jabatan.id_jabatan ORDER BY users.created_at DESC");

// fetch jabatan
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
                <div>
                    <?php if($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
                        <button class="mb-3 btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#modalTambahUs">Tambah Data</button>
                    <?php endif; ?>
                </div>
                
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-light table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Password</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <!-- view all data  -->
                        <?php if($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
                        <?php foreach ($data_user as $user): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['nama']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['nama_jabatan']; ?></td>
                            <td>Password Hidden.</td>
                            <td><?= date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbahUs<?= $user['id_user']; ?>">Ubah</button>
                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $user['id_user']; ?>">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <!-- tampil berdasarkan user login -->
                            <?php foreach ($data_bylogin as $user): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['nama']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['nama_jabatan']; ?></td>
                                <td>Password Hidden.</td>
                                <td><?= date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbahUs<?= $user['id_user']; ?>">Ubah</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data User</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
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
                            <?php foreach ($jabatan as $jb): ?>
                                <option value="<?= $jb['kode_jabatan']; ?>">
                                    <?= htmlspecialchars($jb['nama_jabatan']); ?>
                                </option>
                            <?php endforeach; ?>
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

<?php foreach ($data_user as $user) : ?>
<!-- modal ubah -->
<div class="modal fade" id="modalUbahUs<?= $user['id_user']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data User</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
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
                            <input type="password" name="password" id="password2" class="form-control" required>
                            <small>*Password akan digunakan saat Login</small>
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="show-password2">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            <?php foreach ($jabatan as $jb): ?>
                                <option value="<?= $jb['kode_jabatan']; ?>">
                                    <?= htmlspecialchars($jb['nama_jabatan']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" class="form-check-input" role="switch" name="is_banned" id="is_banned" value="1">
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

<?php include 'layout/footer.php'; ?>
<script>
    document.getElementById('show-password').addEventListener('change', function() {
    const passwordInput = document.getElementById('password');
    if (this.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});
    document.getElementById('show-password2').addEventListener('change', function() {
    const passwordInput = document.getElementById('password2');
    if (this.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});
</script>
