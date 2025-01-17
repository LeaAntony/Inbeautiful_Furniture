<?php
ob_start();
include '../../koneksi.php';
if (isset($_POST['produk'])) {

    $id_produk = $_POST['id_produk'];
    $kategori = $_POST['nama_kategori'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];
    $gambar_sebelum = $_POST['gambar_sebelum'];

    $filename = $_FILES['gambar_produk']['name'];
    $tmp_name = $_FILES['gambar_produk']['tmp_name'];

    if ($filename != '') {
        $type1 = explode('.', $filename);
        $type2 = $type1[1];

        $filename = 'produk' . time() . '.' . $type2;

        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($type2, $tipe_diizinkan)) {
            $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>' '></div>";
            header("location: ../ubah_produk.php?id=$id_produk");
        } else {
            unlink('../../assets/images/produk/' . $gambar_sebelum);

            move_uploaded_file($tmp_name, '../../assets/images/produk/' . $filename);

            $update = mysqli_query($koneksi, "UPDATE produk SET
                    id_kategori = '" . $kategori . "',
                    gambar_produk = '" . $filename . "',
                    nama_produk = '" . $nama_produk . "',
                    deskripsi_produk = '" . $deskripsi_produk . "',
                    harga_produk = '" . $harga_produk . "',
                    stok_produk = '" . $stok_produk . "'
                    WHERE id_produk = '" . $id_produk . "'
                ");
        }
    } else {
        $update = mysqli_query($koneksi, "UPDATE produk SET
                    id_kategori = '" . $kategori . "',
                    nama_produk = '" . $nama_produk . "',
                    deskripsi_produk = '" . $deskripsi_produk . "',
                    harga_produk = '" . $harga_produk . "',
                    stok_produk = '" . $stok_produk . "'
                    WHERE id_produk = '" . $id_produk . "'
            ");
    }

    if ($update) {
        $_SESSION['alert'] = "<div class='flash-data2' data-flashdata2='<?php echo $_Session[alert]; ?>' '></div>";
        header("location: ../data_produk.php");
    } else {
        echo '<script>alert("Gagal".mysqli_error($koneksi)</script>)';
    }
}
else if (isset($_POST['kategori'])) {

    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    $gambar_sebelum = $_POST['gambar_sebelum'];

    $filename = $_FILES['gambar_kategori']['name'];
    $tmp_name = $_FILES['gambar_kategori']['tmp_name'];

    if ($filename != '') {
        $type1 = explode('.', $filename);
        $type2 = $type1[1];

        $filename = 'kategori' . time() . '.' . $type2;

        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($type2, $tipe_diizinkan)) {
            $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>' '></div>";
            header("location: ../ubah_kategori.php?id=$id_kategori");
        } else {
            unlink('../../assets/images/kategori/' . $gambar_sebelum);

            move_uploaded_file($tmp_name, '../../assets/images/kategori/' . $filename);

            $update = mysqli_query($koneksi, "UPDATE kategori SET
                    gambar_kategori = '" . $filename . "',
                    nama_kategori = '" . $nama_kategori . "'
                    WHERE id_kategori = '" . $id_kategori . "'
                ");
        }
    } else {
        $update = mysqli_query($koneksi, "UPDATE kategori SET
                    nama_kategori = '" . $nama_kategori . "'
                    WHERE id_kategori = '" . $id_kategori . "'
            ");
    }

    if ($update) {
        $_SESSION['alert'] = "<div class='flash-data2' data-flashdata2='<?php echo $_Session[alert]; ?>' '></div>";
        header("location: ../data_kategori.php");
    } else {
        echo '<script>alert("Gagal".mysqli_error($koneksi)</script>)';
    }
}
else {
    header("location: ../dashboard_penjual.php");
}
?>