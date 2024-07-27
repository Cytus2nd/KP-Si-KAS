<?php
// Set default bulan dan tahun ke bulan dan tahun saat ini
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$tipe_kas = isset($_GET['tipe_kas']) ? $_GET['tipe_kas'] : 'semua';
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$offset = ($page - 1) * $limit;

// Fetch data kas OSIS berdasarkan bulan, tahun, tipe kas, dan pencarian
$query = "SELECT * FROM kas_kkr WHERE MONTH(created_at) = $bulan AND YEAR(created_at) = $tahun";
if ($tipe_kas != 'semua') {
    $query .= " AND tipe_kas = '$tipe_kas'";
}
if (!empty($cari)) {
    $query .= " AND (keterangan LIKE '%$cari%' OR jumlah LIKE '%$cari%')";
}

// Fetch total data for pagination
$total_query = str_replace("SELECT *", "SELECT COUNT(*) as total", $query);
$total_result = select($total_query);
$total_data = $total_result[0]['total'];
$total_pages = ceil($total_data / $limit);

// Fetch limited data for current page
$query .= " LIMIT $limit OFFSET $offset";
$data_kkr = select($query);

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