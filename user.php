<?php 
session_start();
$title = 'Data User';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php'; 

// tampil seluruh data dengan join ke tabel jabatan
$data_user = select("SELECT users.*, jabatan.nama_jabatan FROM users JOIN jabatan ON users.jabatan = jabatan.id_jabatan");

// berdasarkan seesion login
$id_user = $_SESSION['id_user'];
$data_bylogin = select("SELECT users.*, jabatan.nama_jabatan FROM users JOIN jabatan ON users.jabatan = jabatan.id_jabatan WHERE users.id_user = '$id_user'");
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
            <div class="row">
                <div>
                    <?php if($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
                        <button class="mb-3 btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</button>
                    <?php endif; ?>
                </div>
                
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-light table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Password</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <!-- view all data  -->
                        <?php if($_SESSION['jabatan'] == 1 || $_SESSION['jabatan'] == 2) : ?>
                        <?php foreach ($data_user as $user): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['nama']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['nama_jabatan']; ?></td>
                            <td>Password Hidden.</td>
                            <td><?= date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $user['id_user']; ?>">Ubah</button>
                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $user['id_user']; ?>">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <!-- tampil berdasarkan user login -->
                            <?php foreach ($data_bylogin as $user): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['nama']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['nama_jabatan']; ?></td>
                                <td>Password Hidden.</td>
                                <td><?= date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $user['id_user']; ?>">Ubah</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'layout/footer.php'; ?>
