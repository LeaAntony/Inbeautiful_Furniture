<?php
ob_start();
include "../koneksi.php";
if (isset($_SESSION["username"])) {
    header("location:../index/index.php");
} else {
    $_SESSION['tamu'] = "<div class='alert alert-danger' onclick='this.remove();'>Untuk menggunakan fitur lainnya silakan masuk terlebih dahulu!</div>";
}

$produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$_GET[id]'");

if (mysqli_num_rows($produk) > 0) {
    $b = mysqli_fetch_array($produk);
    if ($b['stok_produk'] < 1) {
        $_SESSION['alert1'] = "<div class='flash-data' data-flashdata='<?php echo $_SESSION[alert]; ?>'></div>";
        header('location:../index.php');
    }
} else {
    $_SESSION['alert1'] = "<div class='flash-data' data-flashdata='<?php echo $_SESSION[alert]; ?>'></div>";
    header('location:../index.php');
}

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

            <link rel="stylesheet" href="../assets/css/style_detail_produk.css?v=1">
            </br>
            <br>
            <!-- Product Details -->
            <div class="container mt-5 col-md-12">
                <?php
                if (isset($_SESSION['alert']))
                    ;
                echo $_SESSION['alert'];
                $_SESSION['alert'] = "";
                ?>
                <div class="row mt-5">
                    <div class="col-md-8 mt-5">
                        <div class="product-container1">
                            <img src="../assets/images/produk/<?php echo $b['gambar_produk'] ?>" alt=""
                                class="product-image"></br>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="product-container2">
                            <h2 class="product-title">
                                <?php echo $b['nama_produk'] ?>
                            </h2>
                            <h1 class="product-price">Rp.
                                <?php echo number_format($b['harga_produk']) ?>
                            </h1>
                            <h4>
                                <?php
                                $awal = '0';
                                $produk_terjual = mysqli_query($koneksi, "SELECT jumlah_produk FROM detail_transaksi WHERE id_produk = $b[id_produk]");
                                if (mysqli_num_rows($produk_terjual) > 0) {
                                    while ($terjual = mysqli_fetch_array($produk_terjual)) {

                                        $jumlah_produk = $terjual['jumlah_produk'];

                                        $total_terjual = $jumlah_produk + $awal;
                                        $awal = $total_terjual;
                                    }
                                }
                                echo $awal;
                                ?>
                                Terjual
                            </h4>
                            <div class="product-actions">
                                <form method="POST" action="../index/index.php">
                                    <div class="quantity-control data_produk">
                                        <span class="quantity-label">Jumlah</span>
                                        <input class="text-center w-25" type="number" id="quantity" name="jumlah_produk"
                                            value="1" min="1" max="<?php echo $b['stok_produk'] ?>">
                                        <span class="remaining-label">tersisa
                                            <?php echo $b['stok_produk'] ?> buah
                                        </span>
                                        <input type="hidden" name="id_produk" value="<?php echo $b['id_produk'] ?>">
                                        <input type="hidden" name="id" value="<?php echo $id_pengguna ?>">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-warning product-button" name="submit">Tambah ke
                                        Keranjang</button>
                                </form>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning mt-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Beli sekarang
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    <?php echo $b['nama_produk']; ?>
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="../index/index.php"
                                                method="POST">
                                                <div class="modal-body">
                                                    <input class="text-center w-25" type="number" id="quantity"
                                                        name="jumlah_produk" value="1" min="1"
                                                        max="<?php echo $b['stok_produk'] ?>">
                                                    <input type="hidden" name="id_produk"
                                                        value="<?php echo $b['id_produk'] ?>">
                                                    <input type="hidden" name="id" value="<?php echo $id_pengguna ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">Beli</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                </br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 product-description">
                    <p><b>
                            <h4>Deskripsi Produk</h4>
                        </b></p>
                    <div class="justify">
                        <?php echo $b['deskripsi_produk'] ?>
                    </div>
                </div>
                <div class="col-md-12 product-terkait">
                    <div class="row">
                        <p><b>
                                <h4>Produk Terkait</h4>
                            </b></p>
                        <?php
                        $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok_produk > 0 AND id_kategori=$b[id_kategori] AND id_produk != $b[id_produk] ORDER BY rand() LIMIT 4");
                        $countData = mysqli_num_rows($queryProduk);
                        if ($countData < 1) {
                            ?>
                            <h3 class="text-center font-weight-bold mr-4 mt-5 hasilx">Mohon maaf, Produk terkait tidak ada
                            </h3>
                            <?php
                        }
                        while ($produk = mysqli_fetch_array($queryProduk)) {
                            ?>
                            <a href="detail_produk.php?id=<?php echo $produk['id_produk'] ?>"
                                class="btn card card-produk ml-2 mr-2 mx-auto mt-4" style="width: 16.5rem;">
                                <img src="../assets/images/produk/<?php echo $produk['gambar_produk'] ?>"
                                    class="card-img-top img-fluid img-cover" alt="...">
                                <div class="card-body bg-light">
                                    <h5 class="card-title text-truncate">
                                        <?php echo $produk['nama_produk'] ?>
                                    </h5>
                                    <span class="truncate">
                                        <?php echo $produk['deskripsi_produk'] ?>
                                    </span>
                                    <p class="card-text harga"> Rp.
                                        <?php echo number_format($produk['harga_produk']) ?>
                                    </p>
                                    <p class="card-text"> Stok
                                        <?php echo $produk['stok_produk'] ?>
                                    </p>
                                    <div class="collapse" id="collapseExample">
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
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