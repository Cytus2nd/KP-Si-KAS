<?php
session_start();
$title = 'Laporan';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php';

// Ambil data pengguna
$id_user = $_SESSION['id_user']; // Pastikan user_id disimpan di session saat login
$query = " SELECT u.*, j.nama_jabatan 
            FROM `users` u
            JOIN `jabatan` j ON u.jabatan = j.kode_jabatan
            WHERE u.id_user = '$id_user'";
$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);

// Proses pengubahan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_telp_lama = strip_tags($_POST['no_telp_lama']);
    $no_telp_baru = strip_tags($_POST['no_telp_baru']);
    $jenis_kelamin = strip_tags($_POST['jenis_kelamin']);
    $password_lama = strip_tags($_POST['password_lama']);
    $password_baru = strip_tags($_POST['password_baru']);

    // Validasi password lama
    if (password_verify($password_lama, $user['password'])) {
        // Jika password lama benar, update password baru jika ada
        if (!empty($password_baru)) {
            $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);
            $update_query = "UPDATE `users` SET `password`='$hashed_password' WHERE `id_user`='$id_user'";
            mysqli_query($conn, $update_query);
        }

        // Update nomor telepon jika no_telp_lama benar
        if ($no_telp_lama === $user['no_telp']) {
            $update_query = "UPDATE `users` SET `no_telp`='$no_telp_baru', `jenis_kelamin`='$jenis_kelamin' WHERE `id_user`='$id_user'";
            mysqli_query($conn, $update_query);
        }
    }

    // Redirect atau beri pesan
    header('Location: profil.php'); // Atau halaman lain setelah berhasil
    exit;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">User Profile</li>
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
                        <li class="list-group-item"><strong>Nama : </strong> <?= htmlspecialchars($user['nama']); ?></li>
                        <li class="d-flex align-items-center list-group-item">
                            <p class="mb-0">
                                <strong class="">Username : </strong><span> <?= htmlspecialchars($user['username']); ?></span>
                            </p>
                            <button class="ms-auto btn btn-success btn-sm" name="ubah-usn">Ubah</button>
                        </li>
                        <li class="list-group-item"><strong>Jabatan : </strong> <?= htmlspecialchars($user['nama_jabatan']); ?></li>
                        <li class="d-flex align-items-center list-group-item">
                            <p class="mb-0">
                                <strong class="">Jenis Kelamin : </strong><span> <?= htmlspecialchars($user['jenis_kelamin']); ?></span>
                            </p>
                            <button class="ms-auto btn btn-success btn-sm" name="ubah-jk">Ubah</button>
                        </li>
                        <li class="d-flex align-items-center list-group-item">
                            <p class="mb-0">
                                <strong class="">No Telepon : </strong><span> <?= htmlspecialchars($user['no_telp']); ?></span>
                            </p>
                            <button class="ms-auto btn btn-success btn-sm" name="ubah-telp">Ubah</button>
                        </li>
                        <li class="list-group-item"><strong>Status Akun : </strong> <span class="fw-bold <?= ($user['is_banned'] == 0) ? 'text-success' : 'text-danger'; ?>"><?= ($user['is_banned'] == 0) ? 'AKTIF' : 'NONAKTIF'; ?></span></li>
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'layout/footer.php'; ?>