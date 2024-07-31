<?php 
    include 'config/app.php';
    $nama = $_SESSION['nama'];
    $jabatan = $_SESSION['jabatan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-KAS | <?= $title ?></title>

    <!-- web icon -->
    <link rel="icon" href="./assets/img/logo.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="fw-bold text-primary nav-link" id="current-time"></span>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="./assets/img/logo.png" alt="logo-perusahaan" class="brand-image img-circle">
                <span class="brand-text font-weight-light fw-bold">Si-KAS</span>
            </div>

            <!-- Sidebar -->
            <div class="sidebar pt-3">
                <br>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 3) : ?>
                        <li class="nav-item">
                            <a href="organisasi" class="nav-link">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>Organisasi</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item menu-close">
                            <a class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Pencatatan Kas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 3) : ?>
                                <li class="nav-item">
                                    <a href="kas_masuk" class="nav-link">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>Kas Masuk</p>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 3) : ?>
                                <li class="nav-item">
                                    <a href="osis" class="nav-link">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>Kas OSIS</p>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 4) : ?>
                                <li class="nav-item">
                                    <a href="pramuka" class="nav-link">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>Kas Pramuka</p>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 5) : ?>
                                <li class="nav-item">
                                    <a href="pmr" class="nav-link">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>Kas PMR</p>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if ($jabatan == 1 || $jabatan == 2 || $jabatan == 6) : ?>
                                <li class="nav-item">
                                    <a href="kkr" class="nav-link">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>Kas KKR</p>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if ($jabatan == 1 || $jabatan == 2) : ?>
                        <li class="nav-item">
                            <a href="user" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <br>
                        <br>
                        <li class="nav-item mb-2">
                            <a href="profil" class="nav-link bg-primary">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link bg-danger"><i class="nav-icon fas fa-sign-out-alt"></i><p>Log Out</p></a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
