<?php
ob_start();
include "koneksi.php";
if (isset($_SESSION["username"])) {
    header("location:index/index.php");
} else {
    $_SESSION['tamu'] = "<div class='alert alert-danger' onclick='this.remove();'>Untuk menggunakan fitur lainnya silakan masuk terlebih dahulu!</div>";
}
$_SESSION['alert'] = ""
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbeautiful Room Furniture - Tamu</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style_pembeli.css?v=1">
    <link rel="icon" type="image/x-icon" href="assets/images/logo/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="page-container">
        <?php
        if (isset($_SESSION['alert1']))
            ;
        echo $_SESSION['alert1'];
        $_SESSION['alert1'] = "";
        ?>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top shadow">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mx-auto" id="navbarTogglerDemo01">
                    <a class="navbar-brand mx-auto" href="">
                        <img src="assets/images/logo/logo_transparent_cropped.png" alt="Logo"
                            class="d-inline-block align-text-top rounded logo">
                    </a>
                    <form class="d-flex search-bar col-7 mx-auto" role="search" method="GET" action="tamu/produk.php">
                        <input class="form-control me-4" type="search" placeholder="Cari produk yang diinginkan"
                            aria-label="Search" name="keyword">
                        <button class="btn btn-outline-dark me-2" type="submit">Cari</button>
                    </form>
                    <ul class="navbar-nav me-auto mx-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link ms-auto anchor" aria-current="page" href="tamu/kategori.php">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="tamu/produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="tamu/tentang_kami.php">Tentang
                                Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="index/index.php"><i
                                    class="fas fa-cart-plus mx-3 fa-xl"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-auto" aria-current="page" href="index/index.php"><i
                                    class="fas fa-user fa-xl mx-3"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- konten -->
        <div class="col-md-11 mx-auto" id="content-wrap">

            <div id="carouselExampleInterval" class="carousel slide carousel-fade carousel-dark mt-5 pt-5"
                data-bs-ride="carousel">
                <div class="carousel-inner mt-5">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="assets/images/Carousel/carousel1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="assets/images/Carousel/carousel2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="assets/images/Carousel/carousel3.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- Bagian Kategori -->
            <h4 class="text-center font-weight-bold mr-4 mt-4 kategori-pilihan" id="kategori-pilihan">Kategori Pilihan
            </h4>
            <div class="row mx-auto">
                <?php
                $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori LIMIT 4");
                while ($row1 = mysqli_fetch_array($kategori)) {
                    ?>
                    <div class="card ml-2 mr-2 mx-auto mt-4 card-kategori" style="width: 20rem;">
                        <a href="tamu/produk.php?kategori=<?php echo $row1['nama_kategori'] ?>">
                            <img src="assets/images/kategori/<?php echo $row1['gambar_kategori'] ?>"
                                class="card-img img-kategori " alt="...">
                        </a>
                    </div>
                <?php } ?>
                <a href="index/index.php" class="card ml-2 mr-2 mx-auto mt-4" style="width: 3rem;">
                    <img src="assets/images/kategori/etc.jpg" class="card-img img-kategori-etc " alt="...">
                </a>
            </div>
            <!-- Bagian Konten -->
            <h4 class="text-center font-weight-bold mr-4 mt-4">Produk Terbaru</h4>
            <div class="row mx-auto">
                <?php
                $no = 1;
                $produk = mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori USING (id_kategori) ORDER BY id_produk DESC LIMIT 10");
                while ($row = mysqli_fetch_array($produk)) {
                    ?>
                    <a href="tamu/detail_produk.php?id=<?php echo $row['id_produk'] ?>" class="btn card ml-2 mr-2 mx-auto mt-4" style="width: 16.5rem;">
                        <img src="assets/images/produk/<?php echo $row['gambar_produk'] ?>"
                            class="card-img-top img-fluid img-cover" alt="...">
                        <div class="card-body bg-light mb-3">
                            <h5 class="card-title text-truncate">
                                <?php echo $row['nama_produk'] ?>
                            </h5>
                            <span class="truncate">
                                <?php echo $row['deskripsi_produk'] ?>
                            </span>
                            <p class="card-text harga"> Rp.
                                <?php echo number_format($row['harga_produk']) ?>
                            </p>
                            <p class="card-text"> Stok
                                <?php echo $row['stok_produk'] ?>
                            </p>
                            <div class="collapse" id="collapseExample">
                            </div>
                        </div>
                    </a>
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
    <script>
        const flashdata = $('.flash-data').data('flashdata')
        if (flashdata) {
            swal.fire({
                title: 'Inbeautiful',
                text: 'Mohon maaf produk tidak ada atau sudah habis.',
                icon: 'error',
                confirmButtonColor: '#ffc107',
                confirmButtonText: 'Ok',
            })
        }
    </script>
</body>

</html>