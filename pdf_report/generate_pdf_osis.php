<?php
session_start();

// Restrict access based on jabatan
if ($_SESSION['jabatan'] >= 4) {
    header('Location: unauthorized'); // Redirect to an unauthorized access page
    exit;
}

require('../vendor/setasign/fpdf/fpdf.php');
require '../config/database.php'; // Pastikan file ini berisi koneksi ke database

date_default_timezone_set('Asia/Jakarta'); // Ganti dengan timezone yang sesuai dengan lokasi Anda

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../assets/img/logo.png',10,6,30); // Adjust the path and size as needed
        // Arial bold 15
        $this->SetFont('Times','B',14);
        // Title
        $this->Cell(0,10,'SMA MAITREYAWIRA TANJUNGPINANG',0,1,'C');
        $this->Cell(0,10,'Jalan Suka Berenang No 1',0,1,'C');
        $this->Cell(0,10,'LAPORAN KAS OSIS',0,1,'C');
        $this->SetFont('Arial','',10);
        // Draw line
        $this->Line(10, 40, 200, 40);
        $this->Ln(3);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times','I',10);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}

// Create instance of PDF class
$pdf = new PDF();
$pdf->AddPage();

// Get current date
$tanggal_cetak = date('d/m/Y H:i:s');
$nama_pencetak = isset($_SESSION['nama']) ? $_SESSION['nama'] : '';

// Set default bulan dan tahun ke bulan dan tahun saat ini
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$tipe_kas = isset($_GET['tipe_kas']) ? $_GET['tipe_kas'] : 'semua';
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

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

// Prepare query for PDF report (no LIMIT and OFFSET)
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

// Calculate totals
$total_pemasukan = 0;
$total_pengeluaran = 0;

// Urutkan data dari yang terlama
usort($data_osis, function($a, $b) {
    return strtotime($a['created_at']) - strtotime($b['created_at']);
});

foreach ($data_osis as $osis) {
    if ($osis['tipe_kas'] == 'pemasukan') {
        $total_pemasukan += $osis['jumlah'];
    } else if ($osis['tipe_kas'] == 'pengeluaran') {
        $total_pengeluaran += $osis['jumlah'];
    }
}

$sisa_kas = $total_pemasukan - $total_pengeluaran;

// Bulan dalam format integer
$bulan_int = (int)$bulan;
$pdf->SetFont('Times','I',12);
$pdf->Cell(0,10,'Dicetak oleh: ' . $nama_pencetak, 0, 1);
$pdf->Ln(0);

$pdf->SetFont('Times','I',12);
$pdf->Cell(0,10,'Tanggal Cetak: ' . $tanggal_cetak, 0, 1);
$pdf->Ln(2);

$pdf->SetFont('Times','B',12);
$pdf->Cell(0,10,'Bulan: ' . $nama_bulan[$bulan_int] . ' ' . $tahun, 0, 1);
$pdf->Ln(2);

$pdf->SetFont('Times','B',12);
$pdf->Cell(40,10,'Total Pemasukan:', 0, 0);
$pdf->Cell(50,10,'Rp ' . number_format($total_pemasukan, 0, ',', '.'), 0, 1);

$pdf->Cell(40,10,'Total Pengeluaran:', 0, 0);
$pdf->Cell(50,10,'Rp ' . number_format($total_pengeluaran, 0, ',', '.'), 0, 1);

$pdf->Cell(40,10,'Sisa Kas:', 0, 0);
$pdf->Cell(50,10,'Rp ' . number_format($sisa_kas, 0, ',', '.'), 0, 1);
$pdf->Ln(4);

$pdf->SetFont('Times','B',12);
$pdf->Cell(10,10,'No',1);
$pdf->Cell(40,10,'Tanggal Kas',1);
$pdf->Cell(40,10,'Tipe Kas',1);
$pdf->Cell(40,10,'Jumlah Kas',1);
$pdf->Cell(60,10,'Keterangan',1);
$pdf->Ln();

$pdf->SetFont('Times','',12);
$no = 1;
foreach ($data_osis as $osis) {
    $pdf->Cell(10,10,$no++,1);
    $pdf->Cell(40,10,date('d/m/Y H:i', strtotime($osis['created_at'])),1);

    // Set color for tipe_kas
    if ($osis['tipe_kas'] == 'pemasukan') {
        $pdf->SetTextColor(0, 0, 255); // Set color to blue
    } else {
        $pdf->SetTextColor(255, 0, 0); // Set color to red
    }
    $pdf->Cell(40,10,htmlspecialchars($osis['tipe_kas']),1);

    // Reset to default color (black) for the rest of the cells
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(40,10,'Rp ' . number_format($osis['jumlah'], 0, ',', '.'),1);
    $pdf->Cell(60,10,htmlspecialchars($osis['keterangan']),1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('D', 'Laporan_Kas_OSIS_' . $bulan . '_' . $tahun . '.pdf');
