<?php
ob_start();
include "header_pembeli.php";

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


<link rel="stylesheet" href="../assets/css/style_pembeli.css?v=1">
<br>
<br>
<br>
<br>
<!-- Bagian Konten -->
<h2 class="text-center font-weight-bold mr-4 mt-5">Produk</h2>
<?php
if (isset($_GET["keyword"])) {
    ?>
    <h4 class="text-center font-weight-bold mr-4">Berikut hasil pencarian dari
        <?php
        echo "<FONT COLOR='#ffc107'>'" . "$keyword" . "'</FONT>";
        ?>
    </h4>
<?php
}
if (isset($_GET["kategori"])) {
    ?>
    <h4 class="text-center font-weight-bold mr-4">Berikut produk dari kategori
        <?php
        echo "<FONT COLOR='#ffc107'>'" . "$_GET[kategori]" . "'</FONT>";
        ?>
    </h4>
<?php
}
?>

<div class="row mx-auto">
    <?php
    if ($countData < 1) {
        ?>
        <h3 class="text-center font-weight-bold mr-4 mt-5 hasilx">Mohon maaf, Produk yang anda cari tidak tersedia</h3>
    <?php } ?>
    <?php
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

<?php
include "footer_pembeli.php";
?>