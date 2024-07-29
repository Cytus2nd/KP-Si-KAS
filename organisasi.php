<?php 
session_start();
$title = 'Data Organisasi';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php'; 

// Fetch data organisasi
$data_organisasi = select("SELECT o.*, u.nama as nama_bendahara 
                           FROM data_organisasi o 
                           JOIN users u ON o.id_user_bendahara = u.id_user");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-primary">Organisasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Lengkap Organisasi</li>
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
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-light table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Organisasi</th>
                            <th>Ketua Organisasi</th>
                            <th>Pembina Organisasi</th>
                            <th>Nama Bendahara</th>
                            <th>No Telepon Bendahara</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <!-- view all data  -->
                        <?php foreach ($data_organisasi as $organisasi): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($organisasi['nama_organisasi']); ?></td>
                            <td><?= htmlspecialchars($organisasi['ketua_organisasi']); ?></td>
                            <td><?= htmlspecialchars($organisasi['pembina_organisasi']); ?></td>
                            <td><?= htmlspecialchars($organisasi['nama_bendahara']); ?></td>
                            <td><?= htmlspecialchars($organisasi['no_telp_bendahara']); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $organisasi['id_user_bendahara']; ?>">Ubah</button>
                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $organisasi['id_user_bendahara']; ?>">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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
