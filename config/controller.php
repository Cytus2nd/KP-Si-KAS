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

    function create_user($post) {
        global $db;
        $nama = strip_tags($post['nama']);
        $username = strip_tags($post['username']);
        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $level = strip_tags($post['level']);

        // enkripsi pass
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    function update_user($post) {
        global $db;
        $id_akun = strip_tags($post['id_akun']);
        $nama = strip_tags($post['nama']);
        $username = strip_tags($post['username']);
        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $level = strip_tags($post['level']);

        // enkripsi pass
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = '$id_akun'";

        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }