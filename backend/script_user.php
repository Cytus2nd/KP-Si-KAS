<?php
// script ubah
if (isset($_POST["tambah"])) {
    $result = create_data_user($_POST);
    if ($result === 1) {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Username telah digunakan, silakan gunakan username lain.',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'user.php';
                });
              </script>";
    } elseif ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data User Berhasil diTambah!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'user.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Data User Gagal diTambah!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'user.php';
                });
              </script>";
    } 
}
