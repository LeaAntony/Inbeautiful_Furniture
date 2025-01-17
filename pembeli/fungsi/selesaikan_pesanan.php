<?php
ob_start();
include '../../koneksi.php';

if (isset($_GET["id_transaksi"])) {
    $status = 'Selesai';

    $update = mysqli_query($koneksi, "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$_GET[id_transaksi]'");
    $_SESSION['alert'] = "<div class='flash-data2' data-flashdata2='<?php echo $_SESSION[alert]; ?>'></div> ";
    header("location: ../pesanan.php");
}
else {
    header("location: ../pesanan.php");
}
?>