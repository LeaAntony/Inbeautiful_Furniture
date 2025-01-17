<?php
ob_start();
include '../../koneksi.php';
if (isset($_POST['produk'])) {

    $kategori = $_POST['nama_kategori'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];

    $filename = $_FILES['gambar_produk']['name'];
    $tmp_name = $_FILES['gambar_produk']['tmp_name'];

    $type1 = explode('.', $filename);
    $type2 = $type1[1];

    $filename = 'produk' . time() . '.' . $type2;

    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

    if (!in_array($type2, $tipe_diizinkan)) {
        $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>' '></div>";
        header("location: ../tambah_produk.php");
    } else {
        move_uploaded_file($tmp_name, '../../assets/images/produk/' . $filename);

        $insert = mysqli_query($koneksi, "INSERT INTO produk VALUES (null, '" . $kategori . "', '" . $filename . "', '" . $nama_produk . "', '" . $deskripsi_produk . "', '" . $harga_produk . "', '" . $stok_produk . "')");

        if ($insert) {
            $_SESSION['alert'] = "<div class='flash-data1' data-flashdata1='<?php echo $_Session[alert]; ?>' '></div>";
            header("location: ../data_produk.php");
            exit();
        } else {
            echo '<script>alert("Gagal".mysqli_error($koneksi))</script>';
        }
    }
}
else if (isset($_POST['kategori'])) {

    $nama_produk = $_POST['nama_kategori'];

    $filename = $_FILES['gambar_kategori']['name'];
    $tmp_name = $_FILES['gambar_kategori']['tmp_name'];

    $type1 = explode('.', $filename);
    $type2 = $type1[1];

    $filename = 'kategori' . time() . '.' . $type2;

    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

    if (!in_array($type2, $tipe_diizinkan)) {
        $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>' '></div>";
        header("location: ../tambah_kategori.php");
    } else {
        move_uploaded_file($tmp_name, '../../assets/images/kategori/' . $filename);

        $insert = mysqli_query($koneksi, "INSERT INTO kategori VALUES (null, '" . $filename . "', '" . $nama_produk . "')");

        if ($insert) {
            $_SESSION['alert'] = "<div class='flash-data1' data-flashdata1='<?php echo $_Session[alert]; ?>' '></div>";
            header("location: ../data_kategori.php");
            exit();
        } else {
            echo '<script>alert("Gagal".mysqli_error($koneksi))</script>';
        }
    }
}
else {
    header("location: ../dashboard_penjual.php");
}
?>