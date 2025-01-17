<?php
ob_start();
include("header_pembeli.php");

$penjual = mysqli_query($koneksi, "SELECT * FROM users WHERE peran = 'Penjual'") or die(mysqli_error($koneksi));
$j = mysqli_fetch_array($penjual);

$pembeli = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN users ON transaksi.id = users.id WHERE id_transaksi = $_GET[id_transaksi]") or die(mysqli_error($koneksi));
$b = mysqli_fetch_array($pembeli);

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = $_GET[id_transaksi]") or die(mysqli_error($koneksi));
$t = mysqli_fetch_array($transaksi);
?>

<link rel="stylesheet" href="../assets/css/style_detail_pesanan.css?v=2">
<!--Konten-->
<div style="margin-top: 150px;" class="container">
    <div class="row">
        <div class="col-md-6">
            <table>
                <tr>
                    <td>
                        <h5>Nama Penjual</h5>
                    </td>
                    <td>
                        <h5>:</h5>
                    </td>
                    <td>
                        <h5>
                            <?php echo $j['nama']; ?>
                        </h5>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table>
                <tr>
                    <td>
                        <h5>Nama Pembeli</h5>
                    </td>
                    <td>
                        <h5>:</h5>
                    </td>
                    <td>
                        <h5>
                            <?php echo $b['nama']; ?>
                        </h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Tanggal Tranksaksi</h5>
                    </td>
                    <td>
                        <h5>:</h5>
                    </td>
                    <td>
                        <h5>
                            <?php echo $t['tanggal_transaksi']; ?>
                        </h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Nomor HP</h5>
                    </td>
                    <td>
                        <h5>:</h5>
                    </td>
                    <td>
                        <h5>
                            <?php echo $t['no_hp']; ?>
                        </h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Alamat Pembeli</h5>
                    </td>
                    <td>
                        <h5>:</h5>
                    </td>
                    <td>
                        <h5>
                            <?php echo $t['alamat']; ?>
                        </h5>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $detail = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_transaksi = $_GET[id_transaksi] ") or die(mysqli_error($koneksi));
                    while ($d = mysqli_fetch_array($detail)) {
                        ?>
                        <tr class="align-middle">
                            <td onclick="location.href='detail_produk.php?id=<?php echo $d['id_produk']; ?>'"><img
                                    src="../assets/images/transaksi/<?php echo $d['gambar_produk']; ?>" alt="" width="110px"
                                    height="110px"></td>
                            <td onclick="location.href='detail_produk.php?id=<?php echo $d['id_produk']; ?>'">
                                <?php echo $d['nama_produk']; ?>
                            </td>
                            <td style="color: #ffc107; font-weight: 500;"
                                onclick="location.href='detail_produk.php?id=<?php echo $d['id_produk']; ?>'">Rp.
                                <?php echo number_format($harga = $d['subtotal'] / $d['jumlah_produk']); ?>
                            </td>
                            <td onclick="location.href='detail_produk.php?id=<?php echo $d['id_produk']; ?>'">
                                <?php echo $d['jumlah_produk']; ?>
                            </td>
                            <td style="color: #ffc107; font-weight: 500;"
                                onclick="location.href='detail_produk.php?id=<?php echo $d['id_produk']; ?>'">Rp.
                                <?php echo number_format($d['subtotal']); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr style="margin-top: 80px;">
        <div class="col-md-4 float-start">
            <h5>Metode Pembayaran :
                <?php
                if ($t['pembayaran'] == 'cod') {
                    echo 'COD';
                }
                ?>
            </h5>
        </div>
        <div class="col-md-4 text-center">
            <h5>Status :
                <?php
                if ($b['status'] == 'Menunggu Konfirmasi') {
                    echo 'Menunggu Konfirmasi';
                } else if ($b['status'] == 'Dalam Proses') {
                    echo 'Dalam Proses';
                } else if ($b['status'] == 'Selesai') {
                    echo 'Selesai';
                }
                ?>
            </h5>
        </div>
        <div class="col-md-4 ">
            <table class="float-end">
                <tr>
                    <td>
                        <h5>Total Harga</h5>
                    </td>
                    <td>
                        <h5>:</h5>
                    </td>
                    <td>
                        <h5 style="color: #ffc107; font-weight: 500;">Rp.
                            <?php echo number_format($t['total_harga']); ?>
                        </h5>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <?php
            if ($b['status'] == 'Dalam Proses') {
                ?>
                <a class="btn btn-warning konfirmasi"
                    href="fungsi/selesaikan_pesanan.php?id_transaksi=<?php echo $b['id_transaksi'] ?>">Selesaikan
                    Pesanan</a>
                <?php
            }
            ?>
        </div>
        <hr class="mt-3"><br>
        <div class="text-center">
            <a href="pesanan.php" class="btn btn-warning btn-lg w-25" value="Kembali">Kembali</a>
        </div>
    </div>
</div>
</div>

<?php
include("footer_pembeli.php");
?>