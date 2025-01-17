<?php
ob_start();
include "header_pembeli.php";
?>

<link rel="stylesheet" href="../assets/css/style_pembeli.css?v=1">

<div id="carouselExampleInterval" class="carousel slide carousel-fade carousel-dark mt-5 pt-5" data-bs-ride="carousel">
    <div class="carousel-inner mt-5">
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="../assets/images/Carousel/carousel1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="../assets/images/Carousel/carousel2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="../assets/images/Carousel/carousel3.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Bagian Kategori -->
<h4 class="text-center font-weight-bold mr-4 mt-4 kategori-pilihan" id="kategori-pilihan">Kategori Pilihan</h4>
<?php
if (isset($_SESSION['alert1']))
    ;
echo $_SESSION['alert1'];
$_SESSION['alert1'] = "";
?>
<div class="row mx-auto">
    <?php
    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori LIMIT 4");
    while ($row1 = mysqli_fetch_array($kategori)) {
        ?>
        <div class="card ml-2 mr-2 mx-auto mt-4 card-kategori" style="width: 20rem;">
            <a href="produk.php?kategori=<?php echo $row1['nama_kategori'] ?>">
                <img src="../assets/images/kategori/<?php echo $row1['gambar_kategori'] ?>" class="card-img img-kategori "
                    alt="...">
            </a>
        </div>
    <?php } ?>
    <a href="kategori.php" class="card ml-2 mr-2 mx-auto mt-4" style="width: 3rem;">
        <img src="../assets/images/kategori/etc.jpg" class="card-img img-kategori-etc " alt="...">
    </a>
</div>
<!-- Bagian Konten -->
<h4 class="text-center font-weight-bold mr-4 mt-4">Produk Terbaru</h4>
<div class="row mx-auto">
    <?php
    $produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok_produk > 0 ORDER BY id_produk DESC LIMIT 10");
    while ($row = mysqli_fetch_array($produk)) {
        ?>
        <a href="detail_produk.php?id=<?php echo $row['id_produk'] ?>" class="btn card mx-auto card-produk mx-auto mt-4"
            style="width: 16rem;">
            <img src="../assets/images/produk/<?php echo $row['gambar_produk'] ?>" class="card-img-top img-fluid img-cover"
                alt="...">
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

<?php
include "footer_pembeli.php";
?>