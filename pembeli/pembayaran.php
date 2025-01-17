<?php
include("header_pembeli.php");

$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE id = $id_pengguna ") or die(mysqli_error($koneksi));
$user = mysqli_fetch_array($sql);

if (isset($_POST["keranjang"])) {
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM keranjang JOIN produk ON keranjang.id_produk = produk.id_produk WHERE id='$id_pengguna'");
} else {
    header('location:keranjang.php');
}

?>

<link rel="stylesheet" href="../assets/css/style_pembayaran.css?v=4">
<!--Konten-->
<div style="margin-top: 130px;" class="container">
    <form action="fungsi/transaksi.php" method="POST">
        <div class="row">
            <div class="col-md-7 mt-5">
                <h2 class="font-weight-bold">
                    <bold>Checkout</bold>
                </h2><br>
                <h5>Alamat Pengiriman</h5>
                <hr>
                <!-- Informasi Pembeli -->
                <h5>Nama Pembeli :
                    <?php echo $user['nama']; ?>
                </h5>
                <h5>Nomor Handphone : <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}"
                        name="no_hp" value="<?php echo $user['no_hp']; ?>" required> </h5>
                <p class="small">Format: 08XX-XXXX-XXXX</p>
                <h5>Alamat Pembeli : <textarea class="form-control" name="alamat" style="height:100px;" name="" id=""
                        cols="30" rows="10" required> <?php echo $user['alamat']; ?> </textarea> </h5>
                <hr>

                <div class="d-flex align-items-center">
                    <img src="../assets/images/logo/logo_transparent_cropped.png" alt="Logo"
                        class="d-inline-block align-text-top rounded logo">
                    <h5 style="margin-left: 30px;">INBEAUTIFUL ROOM FURNITURE</h5>
                </div><br>
                <h6>Batam, Kepulauan Riau</h6><br>

                <?php
                $total = 0;
                if (mysqli_num_rows($queryProduk) > 0) {
                    while ($produk = mysqli_fetch_array($queryProduk)) {
                        ?>
                        <div class="d-flex align-items-right my-2" onclick="location.href='detail_produk.php?id=<?php echo $produk['id_produk']; ?>'">
                            <img src="../assets/images/produk/<?php echo $produk["gambar_produk"] ?>" alt="" width="110px"
                                height="110px">
                            <input type="hidden" name="gambar_produk" id="" value="<?php echo $produk["gambar_produk"] ?>">
                            <div>
                                <h6 style="margin-left: 10px;">
                                    <?php echo $produk["nama_produk"] ?>
                                </h6>
                                <input type="hidden" name="nama_produk" id="" value="<?php echo $produk["nama_produk"] ?>">
                                <input type="hidden" name="stok_produk" id="" value="<?php echo $produk["stok_produk"] ?>">
                                <h6 style="margin-left: 10px;">Jumlah :
                                    <?php
                                        echo $produk["jumlah_produk"];
                                        if ($produk['stok_produk'] < $produk["jumlah_produk"]){
                                            if ($produk['stok_produk'] < 1) {
                                                mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_produk = '$produk[id_produk]' AND id_keranjang = '$produk[id_keranjang]'") or die('query failed');
                                            } 
                                            else {
                                                mysqli_query($koneksi, "UPDATE keranjang SET jumlah_produk = '$produk[stok_produk]' WHERE id_produk = '$produk[id_produk]' AND id_keranjang = '$produk[id_keranjang]'") or die('query failed');
                                            }
                                            $_SESSION['sesuai'] = "tidak";
                                        }
                                    ?>
                                </h6>
                                <input type="hidden" name="jumlah_produk" id="" value="<?php echo $produk["jumlah_produk"] ?>">
                                <h5 style="margin-left: 10px; color: #ffc107;">Rp.
                                    <?php echo number_format($subtotal = ($produk["harga_produk"] * $produk["jumlah_produk"])); ?>
                                </h5>
                                <input type="hidden" name="subtotal" id=""
                                    value="<?php echo $subtotal = ($produk["harga_produk"] * $produk["jumlah_produk"]); ?>">
                            </div>
                        </div>
                        <?php
                        $total += $subtotal;
                    }
                } else {
                    echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">tidak ada produk yang Anda pilih!</td></tr>';
                }
                if ($_SESSION['sesuai'] == "tidak") {
                    $_SESSION['alert'] = "<div class='flash-data5' data-flashdata5='<?php echo $_SESSION[alert]; ?>'></div>";
                    header('location: keranjang.php');
                }
                ?>
                <div>
                    <h5>Opsi Pembayaran</h5>
                    <select class="form-select" name="pembayaran" id="">
                        <option value="cod"> COD (Cash On Delivery) </option>
                        <option value="" disabled> Virtual Account - Coming soon </option>
                        <option value="" disabled> E-Wallet - Coming soon </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 bayar mx-auto">
                <div class="container border rounded shadow p-4 mt-5">
                    <h5>
                        <bold>Ringkasan belanja</bold>
                    </h5><br>
                    <div class="d-flex align-items-center">
                        <h5>Total Harga</h5>
                        <h5 style="margin-left: 50px;"></h5>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center">
                        <h4>
                            <bold>Total Belanja</bold>
                        </h4>
                        <h4 style="margin-left: 90px; color: #ffc107;">Rp.
                            <?php echo number_format($total) ?>
                        </h4>
                        <input type="hidden" name="total_harga" id="" value="<?php echo $total ?>">
                    </div><br>
                    <input type="hidden" name="id" id="" value="<?php echo $id_pengguna ?>">
                    <input type="hidden" name="status" id="" value="Menunggu Konfirmasi">
                    <button type="submit" name="submit"
                        class="btn btn-warning btn-lg w-100 <?php echo ($total > 1) ? '' : 'disabled'; ?>"
                        value="Kirim">Buat Pesanan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<br><br><br>
</div>

<?php
include("footer_pembeli.php");
?>