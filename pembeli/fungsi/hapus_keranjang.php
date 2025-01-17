<?php
ob_start();
include("../../koneksi.php");

if (isset($_GET['hapus'])) {
    $hapus = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_keranjang = '$hapus'") or die('query failed');
    $_SESSION['alert'] = "<div class='flash-data3' data-flashdata3='<?php echo $_Session[alert]; ?>'></div>";
    header('location:../keranjang.php');
}
else if (isset($_GET['hapus_semua'])) {
    $id_pengguna = $_SESSION['id'];
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE id = '$id_pengguna'") or die('query failed');
    $_SESSION['alert'] = "<div class='flash-data4' data-flashdata4='<?php echo $_Session[alert]; ?>'></div>";
    header('location:../keranjang.php');
}
else {
    header('location:../keranjang.php');
}
?>