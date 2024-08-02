<?php
function select($query)
{
    // koneksi database global
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function create_kas_osis($post)
{
    global $conn;
    $jumlah = strip_tags($post['jumlah']);
    $keterangan = strip_tags($post['keterangan']);
    $tipe_kas = strip_tags($post['tipe_kas']);
    $id_user = strip_tags($post['id_user']);

    // Validasi jumlah
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        return -2; // Indikator bahwa jumlah tidak valid
    }

    // Validasi tipe kas
    if ($tipe_kas !== 'pemasukan' && $tipe_kas !== 'pengeluaran') {
        return -3; // Indikator bahwa tipe kas tidak valid
    }

    // Ambil total kas tipe pemasukan
    $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_osis WHERE tipe_kas = 'pemasukan'";
    $result = mysqli_query($conn, $query_total_pemasukan);
    $row = mysqli_fetch_assoc($result);
    $total_pemasukan = $row['total_pemasukan'] ?? 0;

    // Ambil total kas tipe pengeluaran
    $query_total_pengeluaran = "SELECT SUM(jumlah) AS total_pengeluaran FROM kas_osis WHERE tipe_kas = 'pengeluaran'";
    $result = mysqli_query($conn, $query_total_pengeluaran);
    $row = mysqli_fetch_assoc($result);
    $total_pengeluaran = $row['total_pengeluaran'] ?? 0;

    // Hitung sisa kas
    $sisa_kas = $total_pemasukan - $total_pengeluaran;

    // Pengecekan jumlah kas hanya untuk tipe kas 'pengeluaran'
    if ($tipe_kas === 'pengeluaran' && $jumlah > $sisa_kas) {
        return -1; // Indikator bahwa jumlah kas baru lebih besar dari sisa kas
    }

    // Query untuk menambahkan data kas
    $query = "INSERT INTO `kas_osis`(`jumlah`, `keterangan`, `tipe_kas`, `id_user`) VALUES ('$jumlah', '$keterangan', '$tipe_kas', '$id_user')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete_kas_osis($id_kas_osis)
{
    global $conn;

    $query = "DELETE FROM kas_osis WHERE id_kas_osis = $id_kas_osis";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_kas_osis($post)
{
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

    // Ambil jumlah sebelumnya dari database
    $query_sebelumnya = "SELECT jumlah, tipe_kas FROM kas_osis WHERE id_kas_osis = $id_kas_osis";
    $result_sebelumnya = mysqli_query($conn, $query_sebelumnya);
    $row_sebelumnya = mysqli_fetch_assoc($result_sebelumnya);
    $jumlah_sebelumnya = $row_sebelumnya['jumlah'];
    $tipe_kas_sebelumnya = $row_sebelumnya['tipe_kas'];

    // Pengecekan jumlah yang diubah tidak boleh lebih kecil dari jumlah sebelumnya jika tipe kas adalah pemasukan
    if ($tipe_kas_sebelumnya == 'pemasukan' && $jumlah < $jumlah_sebelumnya) {
        return -3; // Indikator bahwa jumlah baru lebih kecil dari jumlah sebelumnya
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
    $query = "UPDATE kas_osis SET jumlah='$jumlah', keterangan='$keterangan', tipe_kas='$tipe_kas', id_user='$id_user' WHERE id_kas_osis = $id_kas_osis";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function create_kas_kkr($post)
{
    global $conn;
    $jumlah = strip_tags($post['jumlah']);
    $keterangan = strip_tags($post['keterangan']);
    $tipe_kas = strip_tags($post['tipe_kas']);
    $id_user = strip_tags($post['id_user']);

    // Validasi jumlah
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        return -2; // Indikator bahwa jumlah tidak valid
    }

    // Validasi tipe kas
    if ($tipe_kas !== 'pemasukan' && $tipe_kas !== 'pengeluaran') {
        return -3; // Indikator bahwa tipe kas tidak valid
    }

    // Ambil total kas tipe pemasukan
    $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_kkr WHERE tipe_kas = 'pemasukan'";
    $result = mysqli_query($conn, $query_total_pemasukan);
    $row = mysqli_fetch_assoc($result);
    $total_pemasukan = $row['total_pemasukan'] ?? 0;

    // Ambil total kas tipe pengeluaran
    $query_total_pengeluaran = "SELECT SUM(jumlah) AS total_pengeluaran FROM kas_kkr WHERE tipe_kas = 'pengeluaran'";
    $result = mysqli_query($conn, $query_total_pengeluaran);
    $row = mysqli_fetch_assoc($result);
    $total_pengeluaran = $row['total_pengeluaran'] ?? 0;

    // Hitung sisa kas
    $sisa_kas = $total_pemasukan - $total_pengeluaran;

    // Pengecekan jumlah kas hanya untuk tipe kas 'pengeluaran'
    if ($tipe_kas === 'pengeluaran' && $jumlah > $sisa_kas) {
        return -1; // Indikator bahwa jumlah kas baru lebih besar dari sisa kas
    }

    // Query untuk menambahkan data kas
    $query = "INSERT INTO `kas_kkr`(`jumlah`, `keterangan`, `tipe_kas`, `id_user`) VALUES ('$jumlah', '$keterangan', '$tipe_kas', '$id_user')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete_kas_kkr($id_kas_kkr)
{
    global $conn;

    $query = "DELETE FROM kas_kkr WHERE id_kas_kkr = $id_kas_kkr";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_kas_kkr($post)
{
    global $conn;
    $id_kas_kkr = $post['id_kas_kkr'];
    $jumlah = strip_tags($post['jumlah']);
    $keterangan = strip_tags($post['keterangan']);
    $tipe_kas = strip_tags($post['tipe_kas']);
    $id_user = strip_tags($post['id_user']);

    // Validasi jumlah
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        return -2; // Indikator bahwa jumlah tidak valid
    }

    // Ambil jumlah sebelumnya dari database
    $query_sebelumnya = "SELECT jumlah, tipe_kas FROM kas_kkr WHERE id_kas_kkr = $id_kas_kkr";
    $result_sebelumnya = mysqli_query($conn, $query_sebelumnya);
    $row_sebelumnya = mysqli_fetch_assoc($result_sebelumnya);
    $jumlah_sebelumnya = $row_sebelumnya['jumlah'];
    $tipe_kas_sebelumnya = $row_sebelumnya['tipe_kas'];

    // Pengecekan jumlah yang diubah tidak boleh lebih kecil dari jumlah sebelumnya jika tipe kas adalah pemasukan
    if ($tipe_kas_sebelumnya == 'pemasukan' && $jumlah < $jumlah_sebelumnya) {
        return -3; // Indikator bahwa jumlah baru lebih kecil dari jumlah sebelumnya
    }

    if ($tipe_kas == 'pengeluaran') {
        // Ambil total kas tipe pemasukan
        $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_kkr WHERE tipe_kas = 'pemasukan'";
        $result = mysqli_query($conn, $query_total_pemasukan);
        $row = mysqli_fetch_assoc($result);
        $total_pemasukan = $row['total_pemasukan'];

        // Pengecekan jumlah kas
        if ($jumlah > $total_pemasukan) {
            return -1; // Indikator bahwa jumlah kas baru lebih besar dari total pemasukan
        }
    }

    // Query untuk mengubah data kas
    $query = "UPDATE kas_kkr SET jumlah='$jumlah', keterangan='$keterangan', tipe_kas='$tipe_kas', id_user='$id_user' WHERE id_kas_kkr = $id_kas_kkr";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function create_kas_pramuka($post)
{
    global $conn;
    $jumlah = strip_tags($post['jumlah']);
    $keterangan = strip_tags($post['keterangan']);
    $tipe_kas = strip_tags($post['tipe_kas']);
    $id_user = strip_tags($post['id_user']);

    // Validasi jumlah
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        return -2; // Indikator bahwa jumlah tidak valid
    }

    // Validasi tipe kas
    if ($tipe_kas !== 'pemasukan' && $tipe_kas !== 'pengeluaran') {
        return -3; // Indikator bahwa tipe kas tidak valid
    }

    // Ambil total kas tipe pemasukan
    $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_pramuka WHERE tipe_kas = 'pemasukan'";
    $result = mysqli_query($conn, $query_total_pemasukan);
    $row = mysqli_fetch_assoc($result);
    $total_pemasukan = $row['total_pemasukan'] ?? 0;

    // Ambil total kas tipe pengeluaran
    $query_total_pengeluaran = "SELECT SUM(jumlah) AS total_pengeluaran FROM kas_pramuka WHERE tipe_kas = 'pengeluaran'";
    $result = mysqli_query($conn, $query_total_pengeluaran);
    $row = mysqli_fetch_assoc($result);
    $total_pengeluaran = $row['total_pengeluaran'] ?? 0;

    // Hitung sisa kas
    $sisa_kas = $total_pemasukan - $total_pengeluaran;

    // Pengecekan jumlah kas hanya untuk tipe kas 'pengeluaran'
    if ($tipe_kas === 'pengeluaran' && $jumlah > $sisa_kas) {
        return -1; // Indikator bahwa jumlah kas baru lebih besar dari sisa kas
    }

    // Query untuk menambahkan data kas
    $query = "INSERT INTO `kas_pramuka`(`jumlah`, `keterangan`, `tipe_kas`, `id_user`) VALUES ('$jumlah', '$keterangan', '$tipe_kas', '$id_user')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete_kas_pramuka($id_kas_pramuka)
{
    global $conn;

    $query = "DELETE FROM kas_pramuka WHERE id_kas_pramuka = $id_kas_pramuka";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_kas_pramuka($post)
{
    global $conn;
    $id_kas_pramuka = $post['id_kas_pramuka'];
    $jumlah = strip_tags($post['jumlah']);
    $keterangan = strip_tags($post['keterangan']);
    $tipe_kas = strip_tags($post['tipe_kas']);
    $id_user = strip_tags($post['id_user']);

    // Validasi jumlah
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        return -2; // Indikator bahwa jumlah tidak valid
    }

    // Ambil jumlah sebelumnya dari database
    $query_sebelumnya = "SELECT jumlah, tipe_kas FROM kas_pramuka WHERE id_kas_pramuka = $id_kas_pramuka";
    $result_sebelumnya = mysqli_query($conn, $query_sebelumnya);
    $row_sebelumnya = mysqli_fetch_assoc($result_sebelumnya);
    $jumlah_sebelumnya = $row_sebelumnya['jumlah'];
    $tipe_kas_sebelumnya = $row_sebelumnya['tipe_kas'];

    // Pengecekan jumlah yang diubah tidak boleh lebih kecil dari jumlah sebelumnya jika tipe kas adalah pemasukan
    if ($tipe_kas_sebelumnya == 'pemasukan' && $jumlah < $jumlah_sebelumnya) {
        return -3; // Indikator bahwa jumlah baru lebih kecil dari jumlah sebelumnya
    }

    if ($tipe_kas == 'pengeluaran') {
        // Ambil total kas tipe pemasukan
        $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_pramuka WHERE tipe_kas = 'pemasukan'";
        $result = mysqli_query($conn, $query_total_pemasukan);
        $row = mysqli_fetch_assoc($result);
        $total_pemasukan = $row['total_pemasukan'];

        // Pengecekan jumlah kas
        if ($jumlah > $total_pemasukan) {
            return -1; // Indikator bahwa jumlah kas baru lebih besar dari total pemasukan
        }
    }

    // Query untuk mengubah data kas
    $query = "UPDATE kas_pramuka SET jumlah='$jumlah', keterangan='$keterangan', tipe_kas='$tipe_kas', id_user='$id_user' WHERE id_kas_pramuka = $id_kas_pramuka";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function create_kas_pmr($post)
{
    global $conn;
    $jumlah = strip_tags($post['jumlah']);
    $keterangan = strip_tags($post['keterangan']);
    $tipe_kas = strip_tags($post['tipe_kas']);
    $id_user = strip_tags($post['id_user']);

    // Validasi jumlah
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        return -2; // Indikator bahwa jumlah tidak valid
    }

    // Validasi tipe kas
    if ($tipe_kas !== 'pemasukan' && $tipe_kas !== 'pengeluaran') {
        return -3; // Indikator bahwa tipe kas tidak valid
    }

    // Ambil total kas tipe pemasukan
    $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_pmr WHERE tipe_kas = 'pemasukan'";
    $result = mysqli_query($conn, $query_total_pemasukan);
    $row = mysqli_fetch_assoc($result);
    $total_pemasukan = $row['total_pemasukan'] ?? 0;

    // Ambil total kas tipe pengeluaran
    $query_total_pengeluaran = "SELECT SUM(jumlah) AS total_pengeluaran FROM kas_pmr WHERE tipe_kas = 'pengeluaran'";
    $result = mysqli_query($conn, $query_total_pengeluaran);
    $row = mysqli_fetch_assoc($result);
    $total_pengeluaran = $row['total_pengeluaran'] ?? 0;

    // Hitung sisa kas
    $sisa_kas = $total_pemasukan - $total_pengeluaran;

    // Pengecekan jumlah kas hanya untuk tipe kas 'pengeluaran'
    if ($tipe_kas === 'pengeluaran' && $jumlah > $sisa_kas) {
        return -1; // Indikator bahwa jumlah kas baru lebih besar dari sisa kas
    }

    // Query untuk menambahkan data kas
    $query = "INSERT INTO `kas_pmr`(`jumlah`, `keterangan`, `tipe_kas`, `id_user`) VALUES ('$jumlah', '$keterangan', '$tipe_kas', '$id_user')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete_kas_pmr($id_kas_pmr)
{
    global $conn;

    $query = "DELETE FROM kas_pmr WHERE id_kas_pmr = $id_kas_pmr";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_kas_pmr($post)
{
    global $conn;
    $id_kas_pmr = $post['id_kas_pmr'];
    $jumlah = strip_tags($post['jumlah']);
    $keterangan = strip_tags($post['keterangan']);
    $tipe_kas = strip_tags($post['tipe_kas']);
    $id_user = strip_tags($post['id_user']);

    // Validasi jumlah
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        return -2; // Indikator bahwa jumlah tidak valid
    }

    // Ambil jumlah sebelumnya dari database
    $query_sebelumnya = "SELECT jumlah, tipe_kas FROM kas_pmr WHERE id_kas_pmr = $id_kas_pmr";
    $result_sebelumnya = mysqli_query($conn, $query_sebelumnya);
    $row_sebelumnya = mysqli_fetch_assoc($result_sebelumnya);
    $jumlah_sebelumnya = $row_sebelumnya['jumlah'];
    $tipe_kas_sebelumnya = $row_sebelumnya['tipe_kas'];

    // Pengecekan jumlah yang diubah tidak boleh lebih kecil dari jumlah sebelumnya jika tipe kas adalah pemasukan
    if ($tipe_kas_sebelumnya == 'pemasukan' && $jumlah < $jumlah_sebelumnya) {
        return -3; // Indikator bahwa jumlah baru lebih kecil dari jumlah sebelumnya
    }

    if ($tipe_kas == 'pengeluaran') {
        // Ambil total kas tipe pemasukan
        $query_total_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas_pmr WHERE tipe_kas = 'pemasukan'";
        $result = mysqli_query($conn, $query_total_pemasukan);
        $row = mysqli_fetch_assoc($result);
        $total_pemasukan = $row['total_pemasukan'];

        // Pengecekan jumlah kas
        if ($jumlah > $total_pemasukan) {
            return -1; // Indikator bahwa jumlah kas baru lebih besar dari total pemasukan
        }
    }

    // Query untuk mengubah data kas
    $query = "UPDATE kas_pmr SET jumlah='$jumlah', keterangan='$keterangan', tipe_kas='$tipe_kas', id_user='$id_user' WHERE id_kas_pmr = $id_kas_pmr";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_data_or($post)
{
    global $conn;
    $id_organisasi = $post['id_organisasi'];
    $nama_organisasi = strip_tags($post['nama_organisasi']);
    $ketua_organisasi = strip_tags($post['ketua_organisasi']);
    $pembina_organisasi = strip_tags($post['pembina_organisasi']);
    $id_user_bendahara = strip_tags($post['id_user_bendahara']);
    $last_edit_by = strip_tags($post['last_edit_by']);

    // Query untuk mengubah data organisasi
    $query = "UPDATE data_organisasi SET nama_organisasi='$nama_organisasi', ketua_organisasi='$ketua_organisasi', pembina_organisasi='$pembina_organisasi', id_user_bendahara=$id_user_bendahara, last_edit_by='$last_edit_by' WHERE id_organisasi = $id_organisasi";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function create_data_user($post)
{
    global $conn;
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $jabatan = strip_tags($post['jabatan']);
    $jenis_kelamin = strip_tags($post['jenis_kelamin']);
    $no_telp = strip_tags($post['no_telp']);
    $is_banned = (int) $post['is_banned'];

    // Escape special characters for use in SQL statement
    $username_safe = mysqli_real_escape_string($conn, $username);

    // Check if a similar username already exists and exclude the current user
    $input_usn_query = "SELECT * FROM `users` WHERE `username`='$username_safe'";
    $input_usn = mysqli_query($conn, $input_usn_query);

    if (mysqli_num_rows($input_usn) > 0) {
        return 'ada'; // Username already exists
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users`(`nama`, `username`, `password`, `jabatan`, `no_telp`, `jenis_kelamin`, `is_banned`) VALUES ('$nama','$username_safe','$hashed_password','$jabatan', '$no_telp', '$jenis_kelamin', '$is_banned')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}

function update_data_user($post)
{
    global $conn;
    $id_user = strip_tags($post['id_user']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $jabatan = strip_tags($post['jabatan']);
    $jenis_kelamin = strip_tags($post['jenis_kelamin']);
    $no_telp = strip_tags($post['no_telp']);
    $is_banned = (int)$post['is_banned'];

    // Escape special characters for use in SQL statement
    $username_safe = mysqli_real_escape_string($conn, $username);

    // Check if a similar username already exists excluding the current user
    $input_usn_query = "SELECT * FROM `users` WHERE `username`='$username_safe' AND `id_user` != '$id_user'";
    $input_usn = mysqli_query($conn, $input_usn_query);

    if (mysqli_num_rows($input_usn) > 0) {
        return 'ada'; // Username already exists
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE `users` SET `nama`='$nama', `username`='$username_safe', `password`='$hashed_password', `jabatan`='$jabatan', `no_telp`='$no_telp', `jenis_kelamin`='$jenis_kelamin', `is_banned`='$is_banned' WHERE `id_user`='$id_user'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}
