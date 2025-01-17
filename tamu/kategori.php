<?php
ob_start();
include "../koneksi.php";
if (isset($_SESSION["username"])) {
    header("location:../index/index.php");
} else {
    $_SESSION['tamu'] = "<div class='alert alert-danger' onclick='this.remove();'>Untuk menggunakan fitur lainnya silakan masuk terlebih dahulu!</div>";
}

if (isset($_GET["keyword"])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET["keyword"]);
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok_produk > 0 AND nama_produk LIKE '%$keyword%' ORDER BY rand()");
} else if (isset($_GET["kategori"])) {
    $queryGetKategoriId = mysqli_query($koneksi, "SELECT id_kategori FROM kategori WHERE nama_kategori='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok_produk > 0 AND id_kategori='$kategoriId[id_kategori]' ORDER BY rand()");
} else {
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok_produk > 0 ORDER BY rand()");
}

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbeautiful Room Furniture - Tamu</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_pembeli.css?v=1">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <a class="navbar-brand mx-auto" href="../">
                        <img src="../assets/images/logo/logo_transparent_cropped.png" alt="Logo"
                            class="d-inline-block align-text-top rounded logo">
                    </a>
                    <form class="d-flex search-bar col-7 mx-auto" role="search" method="GET" action="produk.php">
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
                            <a class="nav-link ms-auto" aria-current="page" href="tentang_kami.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="../index/index.php"><i
                                    class="fas fa-cart-plus mx-3 fa-xl"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="../index/index.php"><i
                                    class="fas fa-user fa-xl mx-3"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- konten -->
        <div class="col-md-11 mx-auto" id="content-wrap">

            <link rel="stylesheet" href="../assets/css/style_pembeli.css?v=1">
            <br>
            <br>
            <br>
            <br>
            <!-- Bagian Konten -->
            <h2 class="text-center font-weight-bold mr-4 mt-5">Kategori</h2>
            <div class="row mx-auto">
                <?php
                $kategori1 = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY rand()");
                while ($row1 = mysqli_fetch_array($kategori1)) {
                    ?>
                    <div class="card ml-2 mr-2 mx-auto mt-4 card-kategori" style="width: 19rem;">
                        <a href="produk.php?kategori=<?php echo $row1['nama_kategori'] ?>">
                            <img src="../assets/images/kategori/<?php echo $row1['gambar_kategori'] ?>"
                                class="card-img img-kategori " alt="...">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <div class="copyright text-center text-white font-weight-bold bg-dark p-2">
            <p>&copy; 2023 by InBeautiful Room</p>
        </div>
    </footer>
    </div>

    <!-- JS -->
</body>

</html>