<?php
if ($_SESSION['jabatan'] >= 4) {
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
    SELECT kas_osis.*, users.nama 
    FROM kas_osis 
    JOIN users ON kas_osis.id_user = users.id_user 
    WHERE MONTH(kas_osis.created_at) = ? 
    AND YEAR(kas_osis.created_at) = ?";

$params = [$bulan, $tahun];

if ($tipe_kas != 'semua') {
    $query .= " AND kas_osis.tipe_kas = ?";
    $params[] = $tipe_kas;
}
if (!empty($cari)) {
    $query .= " AND (kas_osis.keterangan LIKE ? OR kas_osis.jumlah LIKE ?)";
    $params[] = "%$cari%";
    $params[] = "%$cari%";
}

$query .= " ORDER BY kas_osis.created_at DESC";

// Prepare statement
$stmt = $conn->prepare($query);

// Bind parameters dynamically
$types = str_repeat('s', count($params));
$stmt->bind_param($types, ...$params);

$stmt->execute();
$result = $stmt->get_result();
$data_osis = $result->fetch_all(MYSQLI_ASSOC);

$total_query = str_replace("SELECT kas_osis.*, users.nama", "SELECT COUNT(*) as total", $query);
$stmt_total = $conn->prepare($total_query);
$stmt_total->bind_param($types, ...$params);
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
