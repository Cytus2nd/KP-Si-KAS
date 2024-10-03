<?php
include 'config/app.php';

if (isset($_POST['submit-otp'])) {
    $nomor = mysqli_escape_string($conn, $_POST['nomor']);

    // Pastikan nomor dalam format yang benar untuk penyimpanan di database
    if (strpos($nomor, '0') === 0) {
        // Nomor sudah dalam format yang benar
    } elseif (strpos($nomor, '62') === 0) {
        // Ubah dari format 62 ke format 0
        $nomor = '0' . substr($nomor, 2); // Mengubah 628123456789 menjadi 08123456789
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
        // Jika nomor tidak terdaftar, tampilkan alert
        $error_message = "Nomor HP tidak terdaftar!";
    }
} elseif (isset($_POST['submit-login'])) {
    $otp = mysqli_escape_string($conn, $_POST['otp']);
    $nomor = mysqli_escape_string($conn, $_POST['nomor']); // Mengambil nomor HP yang sama dari input

    // Cek apakah nomor HP sudah dalam format 0
    if (strpos($nomor, '0') !== 0) {
        // Ubah dari format 62 ke format 0
        if (strpos($nomor, '62') === 0) {
            $nomor = '0' . substr($nomor, 2); // Mengubah 628123456789 menjadi 08123456789
        } else {
            $nomor = '0' . $nomor; // Menambahkan 0 jika tidak ada prefix
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
                $id_user = $user_data['id_user'];
                // Arahkan ke halaman reset password
                header("Location: reset_password.php?id_user=$id_user");
                exit(); // Pastikan untuk keluar dari skrip setelah redirect
            } else {
                echo "<script>alert('User tidak ditemukan!'); window.location.href='otp.php';</script>";
            }
        } else {
            echo "<script>alert('OTP expired'); window.location.href='otp.php';</script>";
        }
    } else {
        echo "<script>alert('OTP salah'); window.location.href='otp.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Si Kas | Request OTP Reset Password</title>
</head>

<body>
    <form method="POST" action="" accept-charset="utf-8" style="margin: 100px auto;box-shadow: 0 0 15px -2px lightgray;width:100%;max-width:600px;padding:20px;box-sizing:border-box;">
        <h1 style="text-align: center;">Dapatkan OTP untuk Reset Password</h1>
        <center>
            <?php
            // Jika ada pesan error, tampilkan dalam div alert
            if (isset($error_message)) {
                echo "<div style='color: red; margin-bottom: 10px;'>$error_message</div>";
            }
            ?>
            <div style="display: <?php echo isset($_POST['submit-otp']) ? "none" : "flex" ?>;flex-direction:column;margin-bottom:10px;box-sizing:border-box;">
                <label for="nomor" style="text-align: left;margin-bottom:5px;">Nomor</label>
                <input placeholder="62812xxxx" name="nomor" type="text" id="nomor" required style="padding:8px;border:2px solid lightgray;border-radius:5px;" <?php if (isset($_POST['submit-otp'])) {
                                                                                                                                                                    echo "value='$nomor' hidden";
                                                                                                                                                                } ?> />
            </div>
            <?php
            if (isset($_POST['submit-otp'])) { ?>
                <div style="display: flex;flex-direction:column;margin-bottom:10px;">
                    <label for="otp" style="text-align: left;margin-bottom:5px;box-sizing:border-box;">OTP</label>
                    <input placeholder="xxxxxx" name="otp" type="text" id="otp" style="padding:8px;border:2px solid lightgray;border-radius:5px;" />
                </div>
            <?php }
            if (!isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-otp" style="background-color: orange;border:none;padding:8px 16px;color:white;cursor:pointer;" name="submit-otp">Request OTP</button>
            <?php }
            if (isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-login" style="background-color:darkturquoise;border:none;padding:8px 16px;color:white;cursor:pointer;" name="submit-login">Login</button>
            <?php } ?>
        </center>
    </form>
</body>

</html>