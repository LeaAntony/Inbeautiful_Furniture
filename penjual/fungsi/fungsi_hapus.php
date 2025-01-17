<?php
ob_start();
include '../../koneksi.php';

if (isset($_GET["id_produk"])) {
    $produk = mysqli_query($koneksi, "SELECT gambar_produk FROM produk WHERE id_produk = '$_GET[id_produk]'");
    $b = mysqli_fetch_object($produk);

    unlink('../../assets/images/produk/' . $b->gambar_produk);

    $delete = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$_GET[id_produk]'");
    $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>'></div> ";
    header("location: ../data_produk.php");
}
else if (isset($_GET["id_kategori"])) {
    $kategori = mysqli_query($koneksi, "SELECT gambar_kategori FROM kategori WHERE id_kategori = '$_GET[id_kategori]'");
    $b = mysqli_fetch_object($kategori);

    unlink('../../assets/images/kategori/' . $b->gambar_kategori);

    $delete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$_GET[id_kategori]'");
    $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>'></div> ";
    header("location: ../data_kategori.php");
}
else {
    header("location: ../dashboard_penjual.php");
}
?>