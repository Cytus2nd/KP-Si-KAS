<?php
if ($_SESSION['jabatan'] >= 3) {
    header('Location: unauthorized');
    exit;
}

// script ubah
if (isset($_POST["ubah"])) {
    $result = update_data_or($_POST);
    if ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Organisasi Berhasil diUbah!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'organisasi';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Data Organisasi Gagal diUbah!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'organisasi';
                });
              </script>";
    }
}
