<?php 
// script tambah
if (isset($_POST["tambah"])) {
    $result = create_kas_osis($_POST);
    if ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Kas Berhasil ditambahkan!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    } else if ($result == -1) {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Jumlah Kas lebih besar dari Pemasukan yang ada!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    } else if ($result == -2) {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Jumlah harus berupa angka yang valid dan lebih besar dari 0!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Data Kas Gagal Ditambahkan',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    }
}

// script ubah
if (isset($_POST["ubah"])) {
    $result = update_kas_osis($_POST);
    if ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Kas Berhasil diUbah!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    } else if ($result == -1) {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Jumlah Kas yang diUbah lebih besar dari Pemasukan yang ada!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    } else if ($result == -2) {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Jumlah Kas harus berupa angka yang valid dan lebih besar dari 0!',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Data Kas Gagal DiUbah',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    }
}

// script hapus
if (isset($_POST["hapus"])) {
    $id_kas_osis = (int)$_POST['id_kas_osis'];
    $result = delete_kas_osis($id_kas_osis);
    if ($result > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Kas Berhasil dihapus!',
                    icon: 'success',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Data Kas Gagal Dihapus',
                    icon: 'error',
                    timer: 8000,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'osis.php';
                });
              </script>";
    }
}


