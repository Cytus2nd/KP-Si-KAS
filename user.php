<?php 
session_start();
$title = 'Data User';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php'; 

// tampil seluruh data
$data_akun = select("SELECT * FROM users");


// berdasarkan seesion login
$id_user = $_SESSION['id_user'];
$data_bylogin = select("SELECT * FROM users WHERE id_user = '$id_user'");

    // script tambah
    if (isset($_POST["tambah"])) {
        if(create_user($_POST) > 0) {
            echo "<script>
                    alert('Data Akun Berhasil ditambahkan');
                    document.location.href = 'user.php';
                </script>";
            } else {
                echo "<script>
                        alert('Data Akun Gagal ditambahkan');
                        document.location.href = 'user.php';
                    </script>";
        }
    }

    // script ubah
    if (isset($_POST["ubah"])) {
        if(update_user($_POST) > 0) {
            echo "<script>
                    alert('Data Akun Berhasil diubah');
                    document.location.href = 'user.php';
                </script>";
            } else {
                echo "<script>
                        alert('Data Akun Gagal diubah');
                        document.location.href = 'user.php';
                    </script>";
        }
    }
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row ">
                <?php if($_SESSION['jabatan']  == 1) : ?>
                    <button class="mb-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</button>
                <?php endif; ?>

                <table class="table table-bordered table-light table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <!-- view all data  -->
                        <?php if($_SESSION['jabatan'] == 1) : ?>
                        <?php foreach ($data_akun as $akun): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $akun['nama']; ?></td>
                            <td><?= $akun['username']; ?></td>
                            <td>Password Hidden.</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">Ubah</button>
                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <!-- tampil berdasarkan user login -->
                            <?php foreach ($data_bylogin as $akun): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $akun['nama']; ?></td>
                                <td><?= $akun['username']; ?></td>
                                <td>Password Hidden.</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">Ubah</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'layout/footer.php'; ?>
