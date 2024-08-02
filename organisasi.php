<?php
session_start();
$title = 'Data Organisasi';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'layout/header.php';
include 'backend/script_or.php';

// Fetch data organisasi
$data_organisasi = select("SELECT o.*, u.nama as nama_bendahara, ue.nama as last_edit_by_name, ui.no_telp as no_telp
                           FROM data_organisasi o 
                           JOIN users u ON o.id_user_bendahara = u.id_user
                           JOIN users ue ON o.last_edit_by = ue.id_user 
                           JOIN users ui ON o.id_user_bendahara = ui.id_user 
                           ORDER BY o.id_organisasi ASC");


// Fetch all users
$users = select("SELECT * FROM users");

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
                                <th>No Telp Bendahara</th>
                                <th>Last Edited By</th>
                                <th>Last Edited At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <!-- view all data  -->
                            <?php foreach ($data_organisasi as $organisasi) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($organisasi['nama_organisasi']); ?></td>
                                    <td><?= htmlspecialchars($organisasi['ketua_organisasi']); ?></td>
                                    <td><?= htmlspecialchars($organisasi['pembina_organisasi']); ?></td>
                                    <td><?= htmlspecialchars($organisasi['nama_bendahara']); ?></td>
                                    <td><?= htmlspecialchars($organisasi['no_telp']); ?></td>
                                    <td><?= htmlspecialchars($organisasi['last_edit_by_name']); ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($organisasi['last_edit'])); ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbahOr<?= $organisasi['id_organisasi']; ?>"><i class="fas fa-edit px-1"></i>Ubah</button>
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

<!-- modal ubah -->
<?php foreach ($data_organisasi as $organisasi) : ?>
    <div class="modal fade" id="modalUbahOr<?= $organisasi['id_organisasi']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Organisasi</h1>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="id_organisasi" value="<?= $organisasi['id_organisasi']; ?>">
                        <input type="hidden" name="last_edit_by" value="<?php echo $_SESSION['id_user']; ?>">
                        <div class="mb-3">
                            <label for="nama_organisasi">Nama Organisasi</label>
                            <input type="text" name="nama_organisasi" id="nama_organisasi" class="form-control" required value="<?= $organisasi['nama_organisasi']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="ketua_organisasi">Ketua Organisasi</label>
                            <input type="text" name="ketua_organisasi" id="ketua_organisasi" class="form-control" required value="<?= $organisasi['ketua_organisasi']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="pembina_organisasi">Pembina Organisasi</label>
                            <input type="text" name="pembina_organisasi" id="pembina_organisasi" class="form-control" required value="<?= $organisasi['pembina_organisasi']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="id_user_bendahara">Nama Bendahara</label>
                            <select name="id_user_bendahara" id="id_user_bendahara" class="form-select" required>
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user['id_user']; ?>" <?= $organisasi['id_user_bendahara'] == $user['id_user'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($user['nama']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>