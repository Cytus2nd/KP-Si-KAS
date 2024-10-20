<?php
session_start(); // Aktifkan session

if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    header("Location: otp");
    exit(); // Keluar dari skrip setelah redirect
}

if (!isset($_SESSION['id_user'])) {
    header("Location: otp");
    exit();
}

// Ambil id_user dari session
$id_user = $_SESSION['id_user'];

include 'config/app.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SiKAS | Reset Password</title>

    <!-- web icon -->
    <link rel="icon" href="./assets/img/logo.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./assets/css/otp.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box bg-light rounded-lg shadow-lg">
        <div class="login-logo">
            <img src="./assets/img/logo.png" alt="" class="img-fluid mt-2">
            <p><b class="fw-bold">SI-Kas Maitreyawira</b></p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body rounded-lg login-card-body">
                <p class="login-box-msg text-bold">RESET PASSWORD</p>

                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?php echo ($id_user) ?>">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Masukkan Password Baru..." name="password_baru" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password Baru..." name="confirm_password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" name="ubah_pass" class="btn btn-primary btn-block">Reset Password</button>
                    </div>
                    <!-- /.col -->
            </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>

    <!-- jQuery -->
    <script src="app/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="app/dist/js/adminlte.min.js"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

<?php
// script ubah password
if (isset($_POST["ubah_pass"])) {
    $password_baru = $_POST['password_baru'];
    $confirmPassword = $_POST['confirm_password'];

    // Validasi apakah password dan konfirmasi password sama
    if ($password_baru !== $confirmPassword) {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password dan Konfirmasi Password tidak sama!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.history.back(); // Kembali ke halaman sebelumnya
                });
              </script>";
        exit();
    }

    // Jika validasi lolos, lanjutkan dengan proses update
    $result = update_pass_otp($_POST);
    if ($result > 0) {
        session_destroy();
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Password Berhasil diubah!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'login';
                });
              </script>";
    } else {
        session_destroy();
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password Gagal diubah!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'login';
                });
              </script>";
    }
}
?>

</html>