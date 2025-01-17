<?php
ob_start();
include '../../koneksi.php';
if (isset($_POST['submit'])) {

    $id_pengguna = $_POST['id'];
    $total_harga = $_POST['total_harga'];
    $pembayaran = $_POST['pembayaran'];
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $status = $_POST['status'];
    $query_cek_stok = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$_POST[id_produk]'");
    $cek_stok = mysqli_fetch_array($query_cek_stok);
    if ($cek_stok['stok_produk'] < $_POST["jumlah_produk"]) {
        $_SESSION['alert'] = "<div class='flash-data2' data-flashdata2='<?php echo $_SESSION[alert]; ?>'></div>";
        header("location: ../detail_produk.php?id=$_POST[id_produk]");
    } else {

        $insert1 = mysqli_query($koneksi, "INSERT INTO transaksi VALUES (null, '" . $id_pengguna . "', NOW(), '" . $total_harga . "', '" . $pembayaran . "', '" . $no_hp . "', '" . $alamat . "', '" . $status . "')");

        if ($insert1 === TRUE) {
            $last_id = $koneksi->insert_id;

            $id_transaksi = $last_id;
            $id_produk = $_POST['id_produk'];
            $gambar_produk = $_POST['gambar_produk'];
            $nama_produk = $_POST['nama_produk'];
            $stok_produk = $_POST['stok_produk'];
            $jumlah_produk = $_POST['jumlah_produk'];
            $subtotal = $_POST["subtotal"];

            copy("../../assets/images/produk/" . $gambar_produk, "../../assets/images/transaksi/" . $gambar_produk);

            $insert2 = mysqli_query($koneksi, "INSERT INTO detail_transaksi VALUES (null, '" . $id_transaksi . "', '" . $id_produk . "', '" . $gambar_produk . "', '" . $nama_produk . "', '" . $jumlah_produk . "', '" . $subtotal . "')");

            $stok_sesudah = $stok_produk - $jumlah_produk;
            $query_mengurangi_stok = "UPDATE produk SET stok_produk = '$stok_sesudah' WHERE id_produk = $id_produk ";
            $mengurangi_data_stok = mysqli_query($koneksi, $query_mengurangi_stok);
        }

        if ($insert1 === TRUE && $insert2 === TRUE) {
            header("location: ../pesanan.php");
            $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>' '></div>";
            exit();
        } else {
            echo '<script>alert("Gagal".mysqli_error($koneksi))</script>';
        }
    }
}
else {
    header("location: ../dashboard_pembeli.php");
}
?>