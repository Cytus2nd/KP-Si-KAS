<?php
if ($_SESSION['jabatan'] == 3 || $_SESSION['jabatan'] == 4 || $_SESSION['jabatan'] == 6) {
    header('Location: unauthorized');
    exit;
}

// Set default bulan dan tahun ke bulan dan tahun saat ini
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$tipe_kas = isset($_GET['tipe_kas']) ? $_GET['tipe_kas'] : 'semua';
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$offset = ($page - 1) * $limit;

// Prepare query
$query = "
    SELECT kas_pmr.*, users.nama 
    FROM kas_pmr 
    JOIN users ON kas_pmr.id_user = users.id_user 
    WHERE MONTH(kas_pmr.created_at) = ? 
    AND YEAR(kas_pmr.created_at) = ?";

$params = [$bulan, $tahun];

if ($tipe_kas != 'semua') {
    $query .= " AND kas_pmr.tipe_kas = ?";
    $params[] = $tipe_kas;
}
if (!empty($cari)) {
    $query .= " AND (kas_pmr.keterangan LIKE ? OR kas_pmr.jumlah LIKE ?)";
    $params[] = "%$cari%";
    $params[] = "%$cari%";
}

$query .= " ORDER BY kas_pmr.created_at DESC LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;

// Prepare statement
$stmt = $conn->prepare($query);

// Bind parameters dynamically
$types = str_repeat('s', count($params) - 2) . 'ii';
$stmt->bind_param($types, ...$params);

$stmt->execute();
$result = $stmt->get_result();
$data_pmr = $result->fetch_all(MYSQLI_ASSOC);

// Query to get the total count of data
$total_query = "
    SELECT COUNT(*) as total 
    FROM kas_pmr 
    JOIN users ON kas_pmr.id_user = users.id_user 
    WHERE MONTH(kas_pmr.created_at) = ? 
    AND YEAR(kas_pmr.created_at) = ?";

$total_params = [$bulan, $tahun];

if ($tipe_kas != 'semua') {
    $total_query .= " AND kas_pmr.tipe_kas = ?";
    $total_params[] = $tipe_kas;
}
if (!empty($cari)) {
    $total_query .= " AND (kas_pmr.keterangan LIKE ? OR kas_pmr.jumlah LIKE ?)";
    $total_params[] = "%$cari%";
    $total_params[] = "%$cari%";
}

$stmt_total = $conn->prepare($total_query);
$total_types = str_repeat('s', count($total_params));
$stmt_total->bind_param($total_types, ...$total_params);
$stmt_total->execute();
$total_result = $stmt_total->get_result()->fetch_assoc();
$total_data = $total_result['total'];
$total_pages = ceil($total_data / $limit);

// Array nama bulan
$nama_bulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

