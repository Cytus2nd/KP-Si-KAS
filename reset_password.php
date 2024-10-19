<?php
session_start(); // Aktifkan session

// Cek apakah pengguna sudah login dan id_user ada dalam session
if (!isset($_SESSION['id_user'])) {
    // Jika tidak ada id_user di session, arahkan kembali ke halaman login/OTP
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
    <title>Reset Password</title>

    <!-- web icon -->
    <link rel="icon" href="./assets/img/logo.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Reset Password</h1>

    <form method="POST">
        <input type="hidden" name="id_user" value="<?php echo($id_user) ?>">
        <label for="password_baru">Password Baru:</label>
        <input type="password" name="password_baru" id="password_baru" required>
        <button type="submit" name="ubah_pass">Ubah Password</button>
    </form>
</body>

</html>
<?php 
// script ubah
if (isset($_POST["ubah_pass"])) {
    $result = update_pass_otp($_POST);
    if ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Password Berhasil diUbah!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'login';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password Gagal diUbah!',
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