<?php
session_start();
require('../vendor/setasign/fpdf/fpdf.php');
require '../config/database.php'; // Pastikan file ini berisi koneksi ke database

// Include view_osis to fetch data
include '../backend/view_osis.php';

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Laporan Kas OSIS',0,1,'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}

// Create instance of PDF class
$pdf = new PDF();
$pdf->AddPage();

// Calculate totals
$total_pemasukan = 0;
$total_pengeluaran = 0;

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

$pdf->SetFont('Arial','',10);
$pdf->Cell(0,10,'Bulan: ' . $nama_bulan[$bulan_int] . ' ' . $tahun, 0, 1);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,'Total Pemasukan:', 0, 0);
$pdf->Cell(50,10,'Rp ' . number_format($total_pemasukan, 0, ',', '.'), 0, 1);

$pdf->Cell(40,10,'Total Pengeluaran:', 0, 0);
$pdf->Cell(50,10,'Rp ' . number_format($total_pengeluaran, 0, ',', '.'), 0, 1);

$pdf->Cell(40,10,'Sisa Kas:', 0, 0);
$pdf->Cell(50,10,'Rp ' . number_format($sisa_kas, 0, ',', '.'), 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'No',1);
$pdf->Cell(40,10,'Jumlah Kas',1);
$pdf->Cell(40,10,'Tipe Kas',1);
$pdf->Cell(60,10,'Keterangan',1);
$pdf->Cell(40,10,'Last Edit At',1);
$pdf->Ln();

$pdf->SetFont('Arial','',10);
$no = 1;
foreach ($data_osis as $osis) {
    $pdf->Cell(10,10,$no++,1);
    $pdf->Cell(40,10,'Rp ' . number_format($osis['jumlah'], 0, ',', '.'),1);
    $pdf->Cell(40,10,htmlspecialchars($osis['tipe_kas']),1);
    $pdf->Cell(60,10,htmlspecialchars($osis['keterangan']),1);
    $pdf->Cell(40,10,date('d/m/Y H:i', strtotime($osis['created_at'])),1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('D', 'Laporan_Kas_OSIS_' . $bulan . '_' . $tahun . '.pdf');
