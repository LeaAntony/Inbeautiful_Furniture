<?php
ob_start();
include("../../koneksi.php");
if (isset($_POST['ubah'])) {
    $jumlah_produk = mysqli_real_escape_string($koneksi, $_POST['jumlah_produk']);
    $id_keranjang = $_POST['id_keranjang'];
    mysqli_query($koneksi, "UPDATE keranjang SET jumlah_produk = '$jumlah_produk' WHERE id_keranjang = '$id_keranjang'") or die('query failed');
    $_SESSION['alert'] = "<div class='flash-data2' data-flashdata2='<?php echo $_Session[alert]; ?>'></div>";
    header("location: ../keranjang.php");
}
else {
    header("location: ../keranjang.php");
}
?>