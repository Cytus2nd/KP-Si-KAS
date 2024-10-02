<?php
include 'config/app.php';
if (isset($_POST['submit-otp'])) {
    $nomor = mysqli_escape_string($conn, $_POST['nomor']);
    if ($nomor) {
        if (!mysqli_query($conn, "DELETE FROM otp WHERE nomor = $nomor")) {
            echo ("Error description: " . mysqli_error($con));
        }
        $curl = curl_init();
        $otp = rand(100000, 999999);
        $waktu = time();
        mysqli_query($conn, "INSERT INTO otp (nomor,otp,waktu) VALUES ( $nomor ,$otp , $waktu )");
        $data = [
            'target' => $nomor,
            'message' => "Kode OTP Kamu adalah : " . "*" . $otp . "*" . " 
            
            Kode OTP akan kadaluarsa dalam waktu 5 menit. "
        ];

        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: k4sir2MA8_qK@9TNYpRM",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
    }
} elseif (isset($_POST['submit-login'])) {
    $otp = mysqli_escape_string($conn, $_POST['otp']);
    $nomor = mysqli_escape_string($conn, $_POST['nomor']);
    $q = mysqli_query($conn, "SELECT * FROM otp WHERE nomor = $nomor AND otp = $otp");
    $row = mysqli_num_rows($q);
    $r = mysqli_fetch_array($q);
    if ($row) {
        if (time() - $r['waktu'] <= 300) {
            echo "otp benar";
        } else {
            echo "otp expired";
        }
    } else {
        echo "otp salah";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form OTP</title>
</head>

<body>
    <form method="POST" action="" accept-charset="utf-8" style="margin: 100px auto;box-shadow: 0 0 15px -2px lightgray;width:100%;max-width:600px;padding:20px;box-sizing:border-box;">
        <h1 style="text-align: center;">Dapatkan OTP untuk Reset Password</h1>
        <center>

            <div style="display: <?php echo isset($_POST['submit-otp']) ? "none" : "flex" ?>;flex-direction:column;margin-bottom:10px;box-sizing:border-box;"><label for="nomor" style="text-align: left;margin-bottom:5px;">Nomor</label> <input placeholder="62812xxxx" name="nomor" type="text" id="nomor" required style="padding:8px;border:2px solid lightgray;border-radius:5px;" <?php if (isset($_POST['submit-otp'])) {
                                                                                                                                                                                                                                                                                                                                                                                                echo "value='$nomor' hidden";
                                                                                                                                                                                                                                                                                                                                                                                            } ?> /></div>
            <?php
            if (isset($_POST['submit-otp'])) { ?>
                <div style="display: flex;flex-direction:column;margin-bottom:10px;"><label for="otp" style="text-align: left;margin-bottom:5px;box-sizing:border-box;">OTP</label> <input placeholder="xxxxxx" name="otp" type="text" id="otp" style="padding:8px;border:2px solid lightgray;border-radius:5px;" /></div>
            <?php }
            if (!isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-otp" style="background-color: orange;border:none;padding:8px 16px;color:white;cursor:pointer;" name="submit-otp">Request otp</button>
            <?php }
            if (isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-login" style="background-color:darkturquoise;border:none;padding:8px 16px;color:white;cursor:pointer;" name="submit-login">Login</button>
            <?php }  ?>
        </center>
    </form>


</body>

</html>