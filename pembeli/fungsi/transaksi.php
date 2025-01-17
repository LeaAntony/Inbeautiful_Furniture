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
    $query_cek_stok = mysqli_query($koneksi, "SELECT * FROM keranjang JOIN produk ON keranjang.id_produk = produk.id_produk WHERE id='$id_pengguna'");
    while ($cek_stok = mysqli_fetch_array($query_cek_stok)) {
        if ($cek_stok['stok_produk'] < $cek_stok["jumlah_produk"]) {
            if ($cek_stok['stok_produk'] < 1) {
                mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_produk = '$cek_stok[id_produk]' AND id_keranjang = '$cek_stok[id_keranjang]'") or die('query failed');
            } else {
                mysqli_query($koneksi, "UPDATE keranjang SET jumlah_produk = '$cek_stok[stok_produk]' WHERE id_produk = '$cek_stok[id_produk]' AND id_keranjang = '$cek_stok[id_keranjang]'") or die('query failed');
            }
            $_SESSION['sesuai'] = "tidak";
        }
    }
    if ($_SESSION['sesuai'] == "tidak") {
        $_SESSION['alert'] = "<div class='flash-data5' data-flashdata5='<?php echo $_SESSION[alert]; ?>'></div>";
        header('location: ../keranjang.php');
    } else {
        $insert1 = mysqli_query($koneksi, "INSERT INTO transaksi VALUES (null, '" . $id_pengguna . "', NOW(), '" . $total_harga . "', '" . $pembayaran . "', '" . $no_hp . "', '" . $alamat . "', '" . $status . "')");

        if ($insert1 === TRUE) {
            $last_id = $koneksi->insert_id;

            $queryProduk = mysqli_query($koneksi, "SELECT * FROM keranjang JOIN produk ON keranjang.id_produk = produk.id_produk WHERE id='$id_pengguna'");
            while ($produk = mysqli_fetch_array($queryProduk)) {

                $id_transaksi = $last_id;
                $id_produk = $produk['id_produk'];
                $gambar_produk = $produk['gambar_produk'];
                $nama_produk = $produk['nama_produk'];
                $stok_produk = $produk['stok_produk'];
                $jumlah_produk = $produk['jumlah_produk'];
                $subtotal = ($produk["harga_produk"] * $produk["jumlah_produk"]);

                copy("../../assets/images/produk/" . $gambar_produk, "../../assets/images/transaksi/" . $gambar_produk);

                $insert2 = mysqli_query($koneksi, "INSERT INTO detail_transaksi VALUES (null, '" . $id_transaksi . "', '" . $id_produk . "', '" . $gambar_produk . "', '" . $nama_produk . "', '" . $jumlah_produk . "', '" . $subtotal . "')");

                $query_hapus_keranjang = "DELETE FROM keranjang WHERE id = $id_pengguna";
                $hapus_data_keranjang = mysqli_query($koneksi, $query_hapus_keranjang);

                $stok_sesudah = $stok_produk - $jumlah_produk;
                $query_mengurangi_stok = "UPDATE produk SET stok_produk = '$stok_sesudah' WHERE id_produk = $id_produk ";
                $mengurangi_data_stok = mysqli_query($koneksi, $query_mengurangi_stok);
            }
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
    header("location: ../keranjang.php");
}

?>