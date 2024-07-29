<?php
    function select($query) {
        // koneksi database global
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function create_kas_osis($post) {
        global $conn;
        $jumlah = strip_tags($post['jumlah']);
        $keterangan = strip_tags($post['keterangan']);
        $tipe_kas = strip_tags($post['tipe_kas']);
        $id_user = strip_tags($post['id_user']);
    
        // Validasi jumlah
        if (!is_numeric($jumlah) || $jumlah <= 0) {
            return -2; // Indikator bahwa jumlah tidak valid
        }
    
        // Ambil total kas tipe pemasukan
        $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_osis WHERE tipe_kas = 'pemasukan'";
        $result = mysqli_query($conn, $query_total_pemasukan);
        $row = mysqli_fetch_assoc($result);
        $total_pemasukan = $row['total_pemasukan'];
    
        // Pengecekan jumlah kas
        if ($jumlah > $total_pemasukan) {
            return -1; // Indikator bahwa jumlah kas baru lebih besar dari total pemasukan
        } else {
            // Query untuk menambahkan data kas
            $query = "INSERT INTO `kas_osis`(`jumlah`, `keterangan`, `tipe_kas`, `id_user`) VALUES ('$jumlah', '$keterangan', '$tipe_kas', '$id_user')";
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
    }
    
    function delete_kas_osis($id_kas_osis) {
        global $conn;

        $query = "DELETE FROM kas_osis WHERE id_kas_osis = $id_kas_osis";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function update_kas_osis($post) {
        global $conn;
        $id_kas_osis = $post['id_kas_osis'];
        $jumlah = strip_tags($post['jumlah']);
        $keterangan = strip_tags($post['keterangan']);
        $tipe_kas = strip_tags($post['tipe_kas']);
        $id_user = strip_tags($post['id_user']);
    
        // Validasi jumlah
        if (!is_numeric($jumlah) || $jumlah <= 0) {
            return -2; // Indikator bahwa jumlah tidak valid
        }
    
        if ($tipe_kas == 'pengeluaran') {
            // Ambil total kas tipe pemasukan
            $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_osis WHERE tipe_kas = 'pemasukan'";
            $result = mysqli_query($conn, $query_total_pemasukan);
            $row = mysqli_fetch_assoc($result);
            $total_pemasukan = $row['total_pemasukan'];
    
            // Pengecekan jumlah kas
            if ($jumlah > $total_pemasukan) {
                return -1; // Indikator bahwa jumlah kas baru lebih besar dari total pemasukan
            }
        }
    
        // Query untuk mengubah data kas
        $query = "UPDATE kas_osis SET jumlah='$jumlah', keterangan='$keterangan', tipe_kas='$tipe_kas', id_user=$id_user WHERE id_kas_osis = $id_kas_osis";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }