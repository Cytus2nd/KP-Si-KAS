<?php
if ($_SESSION['jabatan'] >= 3) {
    header('Location: unauthorized');
    exit;
}

function getTotalPages($table, $limit, $is_banned, $cari)
{
    global $conn;
    $sql = "SELECT COUNT(*) as total FROM $table WHERE 1";

    if ($is_banned !== 'semua') {
        $sql .= " AND is_banned = '$is_banned'";
    }

    if (!empty($cari)) {
        $sql .= " AND (nama LIKE '%$cari%' OR username LIKE '%$cari%' OR jabatan LIKE '%$cari%')";
    }

    $result = $conn->query($sql);
    $total = $result->fetch_assoc()['total'];
    return ceil($total / $limit);
}

function getUsers($limit, $offset, $is_banned, $cari, $sort = 'nama_jabatan', $order = 'ASC')
{
    global $conn;
    $sql = "SELECT users.*, jabatan.nama_jabatan 
            FROM users 
            JOIN jabatan ON users.jabatan = jabatan.id_jabatan 
            WHERE 1";

    if ($is_banned !== 'semua') {
        $sql .= " AND is_banned = '$is_banned'";
    }

    if (!empty($cari)) {
        $sql .= " AND (nama LIKE '%$cari%' OR username LIKE '%$cari%' OR nama_jabatan LIKE '%$cari%')";
    }

    $sql .= " ORDER BY $sort $order LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    $users = [];
    while ($user = $result->fetch_assoc()) {
        $users[] = $user;
    }
    return $users;
}
