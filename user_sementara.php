<?php 
session_start();
include 'config/app.php';

if (isset($_POST['register'])) {
    // Ambil inputan user
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Siapkan statement SQL
    $stmt = $db->prepare("INSERT INTO users (username, password, nama, jabatan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $hashed_password, $nama, $jabatan);

    if ($stmt->execute()) {
        $success = "User berhasil dibuat.";
    } else {
        $error = "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <!-- Tambahkan link CSS jika diperlukan -->
</head>
<body>
    <form action="" method="post">
        <?php if(isset($error)) : ?>
            <div class="alert alert-danger text-center">
                <b><?php echo $error; ?></b>
            </div>
        <?php elseif(isset($success)) : ?>
            <div class="alert alert-success text-center">
                <b><?php echo $success; ?></b>
            </div>
        <?php endif; ?>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukkan Username..." name="username" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Masukkan Password..." name="password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukkan Nama..." name="nama" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-badge"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <label for="exampleFormControlSelect1">Pilih Jabatan</label>
            <div class="input-group">
                <select class="form-control" id="exampleFormControlSelect1" name="jabatan" required>
                    <option value="" disabled selected>Pilih Jabatan Anda...</option>
                    <option value="1">Kepala Sekolah</option>
                    <option value="2">Waka Kesiswaan</option>
                    <option value="3">Bendahara OSIS</option>
                    <option value="4">Bendahara</option>
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-tasks"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-12">
            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
    </form>
</body>
</html>
