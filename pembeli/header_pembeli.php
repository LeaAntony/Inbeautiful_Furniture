<?php
ob_start();
include "../koneksi.php";
if (!isset($_SESSION["username"])) {
    header("location:../index/index.php");
} else if ($_SESSION["peran"] == 'Penjual') {
    header("location:../index/index.php");
}

$id_pengguna = $_SESSION['id']
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbeautiful Room Furniture - Pembeli</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <div id="page-container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top shadow">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mx-auto" id="navbarTogglerDemo01">
                    <a class="navbar-brand mx-auto" href="dashboard_pembeli.php">
                        <img src="../assets/images/logo/logo_transparent_cropped.png" alt="Logo"
                            class="d-inline-block align-text-top rounded logo mx-3">
                    </a>
                    <form class="d-flex search-bar col-md-7 mx-auto" role="search" method="GET" action="produk.php">
                        <input class="form-control me-4" type="search" placeholder="Cari produk yang diinginkan"
                            aria-label="Search" name="keyword">
                        <button class="btn btn-outline-dark me-2" type="submit">Cari</button>
                    </form>
                    <ul class="navbar-nav me-auto mx-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link ms-auto anchor" aria-current="page" href="kategori.php">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto " aria-current="page" href="tentang_kami.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="keranjang.php"><i
                                    class="fas fa-cart-plus fa-xl"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="profil.php"><i
                                    class="fas fa-user fa-xl ms-3"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- konten -->
        <div class="col-md-11 mx-auto" id="content-wrap">

            <body>

</html>