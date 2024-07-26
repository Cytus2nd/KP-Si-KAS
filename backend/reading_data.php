<?php
// Database connection
include 'config/database.php';

// Initialize variables for storing data
$pemasukan_osis = $pengeluaran_osis = $total_kas_osis = 0;
$pemasukan_pramuka = $pengeluaran_pramuka = $total_kas_pramuka = 0;
$pemasukan_pmr = $pengeluaran_pmr = $total_kas_pmr = 0;
$pemasukan_kkr = $pengeluaran_kkr = $total_kas_kkr = 0;

// Get the current month and year
$current_month = date('n'); // Numeric representation of a month, without leading zeros (1 to 12)
$current_year = date('Y');  // A full numeric representation of a year, 4 digits (e.g., 2024)

// Fetch data from database based on the user's role
if ($jabatan == 1 || $jabatan == 2 || $jabatan == 3) {
    // Fetch OSIS data
    $query_osis_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_osis WHERE tipe_kas='pemasukan' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_osis_pemasukan = $conn->prepare($query_osis_pemasukan);
    $stmt_osis_pemasukan->bind_param("ii", $current_month, $current_year);
    $stmt_osis_pemasukan->execute();
    $result_osis_pemasukan = $stmt_osis_pemasukan->get_result();
    $data_osis_pemasukan = $result_osis_pemasukan->fetch_assoc();
    $pemasukan_osis = $data_osis_pemasukan['total_pemasukan'] ?? 0;

    $query_osis_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_osis WHERE tipe_kas='pengeluaran' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_osis_pengeluaran = $conn->prepare($query_osis_pengeluaran);
    $stmt_osis_pengeluaran->bind_param("ii", $current_month, $current_year);
    $stmt_osis_pengeluaran->execute();
    $result_osis_pengeluaran = $stmt_osis_pengeluaran->get_result();
    $data_osis_pengeluaran = $result_osis_pengeluaran->fetch_assoc();
    $pengeluaran_osis = $data_osis_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_osis = $pemasukan_osis - $pengeluaran_osis;
}

if ($jabatan == 1 || $jabatan == 2 || $jabatan == 4) {
    // Fetch Pramuka data
    $query_pramuka_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_pramuka WHERE tipe_kas='pemasukan' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_pramuka_pemasukan = $conn->prepare($query_pramuka_pemasukan);
    $stmt_pramuka_pemasukan->bind_param("ii", $current_month, $current_year);
    $stmt_pramuka_pemasukan->execute();
    $result_pramuka_pemasukan = $stmt_pramuka_pemasukan->get_result();
    $data_pramuka_pemasukan = $result_pramuka_pemasukan->fetch_assoc();
    $pemasukan_pramuka = $data_pramuka_pemasukan['total_pemasukan'] ?? 0;

    $query_pramuka_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_pramuka WHERE tipe_kas='pengeluaran' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_pramuka_pengeluaran = $conn->prepare($query_pramuka_pengeluaran);
    $stmt_pramuka_pengeluaran->bind_param("ii", $current_month, $current_year);
    $stmt_pramuka_pengeluaran->execute();
    $result_pramuka_pengeluaran = $stmt_pramuka_pengeluaran->get_result();
    $data_pramuka_pengeluaran = $result_pramuka_pengeluaran->fetch_assoc();
    $pengeluaran_pramuka = $data_pramuka_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_pramuka = $pemasukan_pramuka - $pengeluaran_pramuka;
}

if ($jabatan == 1 || $jabatan == 2 || $jabatan == 5) {
    // Fetch PMR data
    $query_pmr_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_pmr WHERE tipe_kas='pemasukan' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_pmr_pemasukan = $conn->prepare($query_pmr_pemasukan);
    $stmt_pmr_pemasukan->bind_param("ii", $current_month, $current_year);
    $stmt_pmr_pemasukan->execute();
    $result_pmr_pemasukan = $stmt_pmr_pemasukan->get_result();
    $data_pmr_pemasukan = $result_pmr_pemasukan->fetch_assoc();
    $pemasukan_pmr = $data_pmr_pemasukan['total_pemasukan'] ?? 0;

    $query_pmr_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_pmr WHERE tipe_kas='pengeluaran' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_pmr_pengeluaran = $conn->prepare($query_pmr_pengeluaran);
    $stmt_pmr_pengeluaran->bind_param("ii", $current_month, $current_year);
    $stmt_pmr_pengeluaran->execute();
    $result_pmr_pengeluaran = $stmt_pmr_pengeluaran->get_result();
    $data_pmr_pengeluaran = $result_pmr_pengeluaran->fetch_assoc();
    $pengeluaran_pmr = $data_pmr_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_pmr = $pemasukan_pmr - $pengeluaran_pmr;
}

if ($jabatan == 1 || $jabatan == 2 || $jabatan == 6) {
    // Fetch KKR data
    $query_kkr_pemasukan = "SELECT SUM(jumlah) as total_pemasukan FROM kas_kkr WHERE tipe_kas='pemasukan' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_kkr_pemasukan = $conn->prepare($query_kkr_pemasukan);
    $stmt_kkr_pemasukan->bind_param("ii", $current_month, $current_year);
    $stmt_kkr_pemasukan->execute();
    $result_kkr_pemasukan = $stmt_kkr_pemasukan->get_result();
    $data_kkr_pemasukan = $result_kkr_pemasukan->fetch_assoc();
    $pemasukan_kkr = $data_kkr_pemasukan['total_pemasukan'] ?? 0;

    $query_kkr_pengeluaran = "SELECT SUM(jumlah) as total_pengeluaran FROM kas_kkr WHERE tipe_kas='pengeluaran' AND MONTH(created_at) = ? AND YEAR(created_at) = ?";
    $stmt_kkr_pengeluaran = $conn->prepare($query_kkr_pengeluaran);
    $stmt_kkr_pengeluaran->bind_param("ii", $current_month, $current_year);
    $stmt_kkr_pengeluaran->execute();
    $result_kkr_pengeluaran = $stmt_kkr_pengeluaran->get_result();
    $data_kkr_pengeluaran = $result_kkr_pengeluaran->fetch_assoc();
    $pengeluaran_kkr = $data_kkr_pengeluaran['total_pengeluaran'] ?? 0;

    $total_kas_kkr = $pemasukan_kkr - $pengeluaran_kkr;
}
