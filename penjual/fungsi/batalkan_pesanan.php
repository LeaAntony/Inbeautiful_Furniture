<?php
ob_start();
include '../../koneksi.php';

if (isset($_GET["id_transaksi"])) {
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM detail_transaksi JOIN produk ON detail_transaksi.id_produk = produk.id_produk WHERE id_transaksi='$_GET[id_transaksi]'");
    while ($produk = mysqli_fetch_array($queryProduk)) {

        $stok_produk = $produk['stok_produk'];
        $gambar_produk = $produk['gambar_produk'];
        $id_produk = $produk['id_produk'];
        $jumlah_produk = $produk['jumlah_produk'];

        $stok_sesudah = $stok_produk + $jumlah_produk;
        $query_menambahkan_stok = "UPDATE produk SET stok_produk = '$stok_sesudah' WHERE id_produk = $id_produk ";
        $menambahkan_data_stok = mysqli_query($koneksi, $query_menambahkan_stok);

    }

    $delete = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi = '$_GET[id_transaksi]'");
    $delete2 = mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE id_transaksi = '$_GET[id_transaksi]'");
    $_SESSION['alert'] = "<div class='flash-data1' data-flashdata1='<?php echo $_Session[alert]; ?>'></div> ";
    header("location: ../data_pesanan.php");
}
else {
    header("location: ../data_pesanan.php");
}
?>