<?php
    ob_start();
    session_start();

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname   = 'db_inbeautiful';

    $koneksi     = mysqli_connect($hostname, $username, $password, $dbname);
    // or die ('Gagal terhubung ke database');
    if (!$koneksi) {
        die("Koneksi Gagal");
    }
    ob_end_flush();
?>