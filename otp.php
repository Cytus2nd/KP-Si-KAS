<?php
session_start(); // Aktifkan session
include 'config/app.php';

if (isset($_POST['submit-otp'])) {
    $nomor = mysqli_escape_string($conn, $_POST['nomor']);

    // Pastikan nomor dalam format yang benar untuk penyimpanan di database
    if (strpos($nomor, '0') === 0) {
        // Nomor sudah dalam format yang benar
    } elseif (strpos($nomor, '62') === 0) {
        // Ubah dari format 62 ke format 0
        $nomor = '0' . substr($nomor, 2);
    } else {
        // Jika tidak ada prefix, tambahkan 0 di depan
        $nomor = '0' . $nomor;
    }

    // Cek apakah nomor terdaftar di database
    $query = mysqli_query($conn, "SELECT * FROM users WHERE no_telp = '$nomor'");
    $user_exist = mysqli_num_rows($query);

    if ($user_exist > 0) {
        // Jika nomor terdaftar, lanjutkan untuk mengirimkan OTP
        if (!mysqli_query($conn, "DELETE FROM otp WHERE nomor = '$nomor'")) {
            echo ("Error description: " . mysqli_error($conn));
        }

        $curl = curl_init();
        $otp = rand(100000, 999999);
        $waktu = time();

        // Menggunakan nomor dalam format 62 untuk pengiriman OTP
        $nomor_for_otp = '62' . substr($nomor, 1); // Mengubah 08123456789 menjadi 628123456789
        mysqli_query($conn, "INSERT INTO otp (nomor, otp, waktu) VALUES ('$nomor', '$otp', '$waktu')");

        $data = [
            'target' => $nomor_for_otp,
            'message' => "Kode OTP Kamu adalah : " . "*" . $otp . "*" . " 
            Kode OTP akan kadaluarsa dalam waktu 5 menit."
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: k4sir2MA8_qK@9TNYpRM"));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
    } else {
        // Jika nomor tidak terdaftar, tampilkan alert menggunakan JavaScript
        echo "<script>alert('Nomor HP tidak terdaftar!'); window.location.href='otp';</script>";
        exit(); // Keluar dari skrip untuk menghentikan eksekusi lebih lanjut
    }
} elseif (isset($_POST['submit-login'])) {
    $otp = mysqli_escape_string($conn, $_POST['otp']);
    $nomor = mysqli_escape_string($conn, $_POST['nomor']); // Mengambil nomor HP yang sama dari input

    // Cek apakah nomor HP sudah dalam format 0
    if (strpos($nomor, '0') !== 0) {
        if (strpos($nomor, '62') === 0) {
            $nomor = '0' . substr($nomor, 2);
        } else {
            $nomor = '0' . $nomor;
        }
    }

    // Cek apakah OTP valid
    $q = mysqli_query($conn, "SELECT * FROM otp WHERE nomor = '$nomor' AND otp = '$otp'");
    $row = mysqli_num_rows($q);
    $r = mysqli_fetch_array($q);

    if ($row) {
        if (time() - $r['waktu'] <= 300) {
            // OTP benar, ambil id_user berdasarkan nomor telepon
            $user_query = mysqli_query($conn, "SELECT id_user FROM users WHERE no_telp = '$nomor'");
            $user_data = mysqli_fetch_array($user_query);

            if ($user_data) {
                $_SESSION['otp_verified'] = true; // Menambahkan session baru
                $id_user = $user_data['id_user'];

                // Simpan id_user ke dalam session
                $_SESSION['id_user'] = $id_user;

                // Arahkan ke halaman reset password tanpa id_user di URL
                header("Location: reset_password");
                exit(); // Pastikan untuk keluar dari skrip setelah redirect
            } else {
                echo "<script>alert('User tidak ditemukan!'); window.location.href='otp';</script>";
            }
        } else {
            echo "<script>alert('OTP expired'); window.location.href='otp';</script>";
        }
    } else {
        echo "<script>alert('OTP salah'); window.location.href='otp';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Si Kas | Request OTP Reset Password</title>
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
                <p class="login-box-msg text-bold">Verifikasi OTP untuk Reset Password</p>
                <form method="POST" action="" accept-charset="utf-8">
                    <!-- Form Nomor HP -->
                    <div class="form-group mb-3" id="nomor-form" style="<?php echo isset($_POST['submit-otp']) ? 'display: none;' : 'display: block;'; ?>">
                        <label for="nomor" class="fw-normal">Masukkan Nomor HP yang Terdaftar</label>
                        <div class="input-group">
                            <input class="form-control" placeholder="0812xxxx" name="nomor" type="text" id="nomor" required
                                <?php if (isset($_POST['submit-otp'])) {
                                    echo "value='$nomor' hidden";
                                } ?> />
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Form OTP -->
                    <div class="form-group mb-3" id="otp-form" style="<?php echo isset($_POST['submit-otp']) ? 'display: block;' : 'display: none;'; ?>">
                        <label for="otp">Masukkan OTP</label>
                        <input class="form-control" placeholder="xxxxxx" name="otp" type="text" id="otp" />
                    </div>

                    <!-- Tombol Request OTP -->
                    <div class="col-12" style="<?php echo isset($_POST['submit-otp']) ? 'display: none;' : 'display: block;'; ?>">
                        <button type="submit" id="btn-otp" class="btn btn-primary btn-block" name="submit-otp">Request OTP</button>
                        <a class="btn btn-danger btn-block" href="login">Kembali ke Halaman Login</a>
                    </div>

                    <!-- Tombol Reset Password -->
                    <div class="col-12" style="<?php echo isset($_POST['submit-otp']) ? 'display: block;' : 'display: none;'; ?>">
                        <button type="submit" id="btn-reset" class="btn btn-primary btn-block" name="submit-login">Submit OTP</button>
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
</body>

</html>