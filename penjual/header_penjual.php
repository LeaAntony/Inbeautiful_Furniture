<?php
ob_start();
include "../koneksi.php";
if (!isset($_SESSION["username"])) {
    header("location:../index/index.php");
} else if ($_SESSION["peran"] == 'Pembeli') {
    header("location:../index/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>InBeautiful - Dashboard Penjual</title>
</head>

<body>
    <div id="page-container">
        <!-- Navbar -->
        <nav class="navbar fixed-top bg-warning">
            <div class="container-fluid">
                <a href="dashboard_penjual.php" class="navbar-brand">
                    <img src="../assets/images/logo/logo_transparent_cropped.png" width="50%" height="50%">
                </a>
                <div>
                    <span id="tanggal"></span>
                </div>
                <div class="user-info">
                    <i class="fa-solid fa-user navbar-brand" style="color: #000000;"></i>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM `users` WHERE `username`='$_SESSION[username]'") or die();
                    $fetch = mysqli_fetch_array($query);
                    echo "<FONT COLOR='#000000'>" . $fetch['nama'] . "</FONT>";
                    ?>
                </div>
            </div>
        </nav>

        <!-- Menu -->
        <div class="row mt-5 no-gutters pt-5">
            <div class="col-md-2 bg-body-secondary">
                <ul class="nav flex-column p-3 pt-5">
                    <li class="nav-item">
                        <a class="btn" href="../penjual/dashboard_penjual.php"><i class="fa-solid fa-house"></i>
                            Dashboard</button></a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="btn" href="../penjual/data_kategori.php"><i class="fa-solid fa-box-open"></i>
                            Kategori</button></a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="btn" href="../penjual/data_produk.php"><i class="fa-solid fa-box-open"></i>
                            Produk</button></a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="btn" href="../penjual/data_pesanan.php"><i class="fa-solid fa-cart-shopping"></i>
                            Pesanan</button></a>
                    </li>
                    <br>
                    <hr><br>
                    <li class="nav-item">
                        <a class="btn keluar" href="../index/keluar.php"><i class="fa-solid fa-right-from-bracket"></i>
                            Keluar</a></a>
                    </li>
                </ul>
            </div>

            <!-- Isi -->
            <div class="container col-md-9 pt-5" id="content-wrap">

                <body>

</html>