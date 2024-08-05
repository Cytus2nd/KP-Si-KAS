<?php
if (isset($_POST["ubah_usn"])) {
    $result = update_usn($_POST);
    if ($result === 'pass_err') {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password yang Anda Masukkan Salah',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } elseif ($result === 'usn_err') {
        echo "<script>
                Swal.fire({
                    title: 'Oops',
                    text: 'Username telah digunakan, silakan gunakan username lain.',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } elseif ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Username Berhasil diUbah!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Username Gagal diUbah!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    }
}

if (isset($_POST["ubah_jk"])) {
    $result = update_jk($_POST);
    if ($result === 'pass_err') {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password yang Anda Masukkan Salah',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } elseif ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Jenis Kelamin Berhasil diUbah!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Jenis Kelamin Gagal diUbah!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    }
}

if (isset($_POST["ubah_pass"])) {
    $result = update_pass($_POST);
    if ($result === 'pass_err') {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password Lama yang Anda Masukkan Salah',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } elseif ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Password Berhasil diUbah',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
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
                    window.location = 'profil';
                });
              </script>";
    }
}

if (isset($_POST["ubah_telp"])) {
    $result = update_telp($_POST);
    if ($result === 'pass_err') {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password yang Anda Masukkan Salah',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } elseif ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Nomor Telepon Berhasil diUbah',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Nomor Telepon Gagal diUbah!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'profil';
                });
              </script>";
    }
}
