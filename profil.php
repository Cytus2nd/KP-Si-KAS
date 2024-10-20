<?php
session_start();
$title = 'Laporan';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php';
include 'backend/script_profil.php';

// Ambil data pengguna
$id_user = $_SESSION['id_user']; // Pastikan user_id disimpan di session saat login
$query = " SELECT u.*, j.nama_jabatan 
            FROM `users` u
            JOIN `jabatan` j ON u.jabatan = j.kode_jabatan
            WHERE u.id_user = '$id_user'";
$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Profil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Profil Pengguna</li>
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
                <div class="col-12">
                    <!-- Tampilkan data pengguna -->
                    <h4>Data Anda.</h4>
                    <ul class="list-group mt-2">
                        <input type="hidden" value="<?= $id_user ?>" name="id_user">
                        <li class="list-group-item"><strong>Nama : </strong> <?= htmlspecialchars($user['nama']); ?></li>
                        <li class="d-flex align-items-center list-group-item">
                            <p class="mb-0">
                                <strong class="">Username : </strong><span> <?= htmlspecialchars($user['username']); ?></span>
                            </p>
                            <button type="button" class="ms-auto btn btn-success btn-sm" name="ubah-usn" data-bs-toggle="modal" data-bs-target="#modalUbahUsn<?= $id_user ?>"><i class="fas fa-edit px-1"></i>Ubah</button>
                        </li>
                        <li class="list-group-item"><strong>Jabatan : </strong> <?= htmlspecialchars($user['nama_jabatan']); ?></li>
                        <li class="d-flex align-items-center list-group-item">
                            <p class="mb-0">
                                <strong class="">Jenis Kelamin : </strong><span> <?= htmlspecialchars($user['jenis_kelamin']); ?></span>
                            </p>
                            <button type="button" class="ms-auto btn btn-success btn-sm" name="ubah-jk" data-bs-toggle="modal" data-bs-target="#modalUbahJk<?= $id_user ?>"><i class="fas fa-edit px-1"></i>Ubah</button>
                        </li>
                        <li class="d-flex align-items-center list-group-item">
                            <p class="mb-0">
                                <strong class="">No Telepon : </strong><span> <?= htmlspecialchars($user['no_telp']); ?></span>
                            </p>
                            <button type="button" class="ms-auto btn btn-success btn-sm" name="ubah-telp" data-bs-toggle="modal" data-bs-target="#modalUbahTelp<?= $id_user ?>"><i class="fas fa-edit px-1"></i>Ubah</button>
                        </li>
                        <li class="list-group-item"><strong>Status Akun : </strong> <span class="fw-bold <?= ($user['is_banned'] == 0) ? 'text-success' : 'text-danger'; ?>"><?= ($user['is_banned'] == 0) ? 'AKTIF' : 'NONAKTIF'; ?></span></li>
                    </ul>
                </div>
                <div class="col-12 mt-4">
                    <p>Ingin Mengganti <span class="fw-bold">Password?</span> <a type="button" class="fw-bold text-danger" name="ubah-usn" data-bs-toggle="modal" data-bs-target="#modalUbahPass<?= $id_user ?>">Klik disini.</a>
                    </p>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ubah usn modal -->
<div class="modal fade" id="modalUbahUsn<?= $id_user ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Username</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <div class="mb-3">
                        <div class="form">
                            <label for="password">Password</label>
                            <input type="password" name="password-1" id="password-1" class="form-control" required minlength="8">
                            <small>*Masukkan Pass anda untuk Ubah Username</small>
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="show-password-1">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username Baru</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>" required>
                        <small>*Username akan digunakan saat Login</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah_usn" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ubah jk modal -->
<div class="modal fade" id="modalUbahJk<?= $id_user ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Jenis Kelamin</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <div class="mb-3">
                        <div class="form">
                            <label for="password">Password</label>
                            <input type="password" name="password-2" id="password-2" class="form-control" required minlength="8">
                            <small>*Masukkan Pass anda untuk Ubah Username</small>
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="show-password-2">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                            <option value="laki-laki" <?php echo ($user['jenis_kelamin'] === 'laki-laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="perempuan" <?php echo ($user['jenis_kelamin'] === 'perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah_jk" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ubah telp modal -->
<div class="modal fade" id="modalUbahTelp<?= $id_user ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah No Telepon</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <div class="mb-3">
                        <div class="form">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password-3" class="form-control" required minlength="8">
                            <small>*Masukkan Pass anda untuk Ubah Username</small>
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="show-password-3">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp">Nomor Telephone Baru</label>
                        <input type="number" name="no_telp" id="no_telp" class="form-control" value="<?= htmlspecialchars($user['no_telp']); ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah_telp" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ubah pass modal -->
<div class="modal fade" id="modalUbahPass<?= $id_user ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <div class="mb-3">
                        <div class="form">
                            <label for="password">Password Lama Anda</label>
                            <input type="password" name="password_lama" id="password-4" class="form-control" required minlength="8">
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="show-password-4">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form">
                            <label for="password">Password Baru Anda</label>
                            <input type="password" name="password_baru" id="password-5" class="form-control" required>
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="show-password-5">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah_pass" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('show-password-1').addEventListener('change', function() {
        const passwordInput = document.getElementById('password-1');
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
    document.getElementById('show-password-3').addEventListener('change', function() {
        const passwordInput = document.getElementById('password-3');
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
    document.getElementById('show-password-4').addEventListener('change', function() {
        const passwordInput = document.getElementById('password-4');
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
    document.getElementById('show-password-5').addEventListener('change', function() {
        const passwordInput = document.getElementById('password-5');
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>

<?php include 'layout/footer.php'; ?>