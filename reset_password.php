<?php
// reset_password.php
include 'config/app.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Lakukan pemrosesan untuk reset password di sini
    // Misalnya, tampilkan form untuk mengubah password
} else {
    echo "ID user tidak valid!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Password</title>
</head>

<body>
    <form method="POST" action="process_reset.php?id_user=<?php echo $id_user; ?>">
        <label for="new_password">Password Baru:</label>
        <input type="password" name="new_password" id="new_password" required>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <button type="submit">Reset Password</button>
    </form>
</body>

</html>