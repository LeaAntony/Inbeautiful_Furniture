<?php
ob_start();
include '../../koneksi.php';

if (isset($_GET["id_transaksi"])) {
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM detail_transaksi JOIN produk ON detail_transaksi.id_produk = produk.id_produk WHERE id_transaksi='$_GET[id_transaksi]'");
    while ($produk = mysqli_fetch_array($queryProduk)) {

        $stok_produk = $produk['stok_produk'];
        $gambar_produk = $produk['gambar_produk'];
        $id_produk = $produk['id_produk'];

        if ($stok_produk < 1) {
            unlink('../../assets/images/produk/' . $gambar_produk);

            $query_menghapus_stok = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = $id_produk ");
        }
    }

    $status = 'Dalam Proses';

    $update = mysqli_query($koneksi, "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$_GET[id_transaksi]'");
    $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_SESSION[alert]; ?>'></div> ";
    header("location: ../data_pesanan.php");
}
else {
    header("location: ../data_pesanan.php");
}
?>