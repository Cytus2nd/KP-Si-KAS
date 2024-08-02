<?php 
    session_start();

    // membatasi sebelum login
    if(!isset($_SESSION['login'])) {
        echo "<script>
                document.location.href = 'login'
              </script>";
        exit;
    }

    // kosongkan sesion
    $_SESSION = [];

    session_unset();
    session_destroy();
    header("location: index");
