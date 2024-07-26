<?php
// Database connection
include 'config/database.php';

// Initialize variables for storing data
$pemasukan_osis = $pengeluaran_osis = $total_kas_osis = 0;
$pemasukan_pramuka = $pengeluaran_pramuka = $total_kas_pramuka = 0;
$pemasukan_pmr = $pengeluaran_pmr = $total_kas_pmr = 0;
$pemasukan_kkr = $pengeluaran_kkr = $total_kas_kkr = 0;

// Fetch data from database based on the user's role
if ($jabatan == 1 || $jabatan == 2 || $jabatan == 3) {
    // Fetch OSIS data
    $query_osis_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_osis WHERE tipe_kas='pemasukan'";
    $result_osis_pemasukan = mysqli_query($conn, $query_osis_pemasukan);
    $data_osis_pemasukan = mysqli_fetch_assoc($result_osis_pemasukan);
    $pemasukan_osis = $data_osis_pemasukan['total_pemasukan'] ?? 0;

    $query_osis_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_osis WHERE tipe_kas='pengeluaran'";
    $result_osis_pengeluaran = mysqli_query($conn, $query_osis_pengeluaran);
    $data_osis_pengeluaran = mysqli_fetch_assoc($result_osis_pengeluaran);
    $pengeluaran_osis = $data_osis_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_osis = $pemasukan_osis - $pengeluaran_osis;
}

if ($jabatan == 1 || $jabatan == 2 || $jabatan == 4) {
    // Fetch Pramuka data
    $query_pramuka_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_pramuka WHERE tipe_kas='pemasukan'";
    $result_pramuka_pemasukan = mysqli_query($conn, $query_pramuka_pemasukan);
    $data_pramuka_pemasukan = mysqli_fetch_assoc($result_pramuka_pemasukan);
    $pemasukan_pramuka = $data_pramuka_pemasukan['total_pemasukan'] ?? 0;

    $query_pramuka_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_pramuka WHERE tipe_kas='pengeluaran'";
    $result_pramuka_pengeluaran = mysqli_query($conn, $query_pramuka_pengeluaran);
    $data_pramuka_pengeluaran = mysqli_fetch_assoc($result_pramuka_pengeluaran);
    $pengeluaran_pramuka = $data_pramuka_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_pramuka = $pemasukan_pramuka - $pengeluaran_pramuka;
}

if ($jabatan == 1 || $jabatan == 2 || $jabatan == 5) {
    // Fetch PMR data
    $query_pmr_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_pmr WHERE tipe_kas='pemasukan'";
    $result_pmr_pemasukan = mysqli_query($conn, $query_pmr_pemasukan);
    $data_pmr_pemasukan = mysqli_fetch_assoc($result_pmr_pemasukan);
    $pemasukan_pmr = $data_pmr_pemasukan['total_pemasukan'] ?? 0;

    $query_pmr_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_pmr WHERE tipe_kas='pengeluaran'";
    $result_pmr_pengeluaran = mysqli_query($conn, $query_pmr_pengeluaran);
    $data_pmr_pengeluaran = mysqli_fetch_assoc($result_pmr_pengeluaran);
    $pengeluaran_pmr = $data_pmr_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_pmr = $pemasukan_pmr - $pengeluaran_pmr;
}

if ($jabatan == 1 || $jabatan == 2 || $jabatan == 6) {
    // Fetch KKR data
    $query_kkr_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_kkr WHERE tipe_kas='pemasukan'";
    $result_kkr_pemasukan = mysqli_query($conn, $query_kkr_pemasukan);
    $data_kkr_pemasukan = mysqli_fetch_assoc($result_kkr_pemasukan);
    $pemasukan_kkr = $data_kkr_pemasukan['total_pemasukan'] ?? 0;

    $query_kkr_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_kkr WHERE tipe_kas='pengeluaran'";
    $result_kkr_pengeluaran = mysqli_query($conn, $query_kkr_pengeluaran);
    $data_kkr_pengeluaran = mysqli_fetch_assoc($result_kkr_pengeluaran);
    $pengeluaran_kkr = $data_kkr_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_kkr = $pemasukan_kkr - $pengeluaran_kkr;
}