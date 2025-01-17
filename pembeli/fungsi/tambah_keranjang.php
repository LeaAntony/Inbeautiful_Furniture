<?php
ob_start();
include '../../koneksi.php';
if (isset($_POST['submit'])) {

    $id_produk = $_POST['id_produk'];
    $id_pengguna = $_POST['id'];
    $jumlah_produk = mysqli_real_escape_string($koneksi, $_POST['jumlah_produk']);

    $cek = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_produk ='$id_produk' AND id='$id_pengguna'");
    $produk_exists = mysqli_num_rows($cek);

    if ($produk_exists > 0) {
        $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>'></div>";
        header("location: ../keranjang.php");
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO keranjang VALUES (null, '" . $id_pengguna . "', '" . $id_produk . "', '" . $jumlah_produk . "')");

        if ($insert) {
            header("location: ../detail_produk.php?id=$id_produk");
            $_SESSION['alert'] = "<div class='flash-data1' data-flashdata1='<?php echo $_Session[alert]; ?>'></div>";
            exit();
        } else {
            echo '<script>alert("Gagal".mysqli_error($koneksi))</script>';
        }
    }
}
else {
    header("location: ../keranjang.php");
}
?>