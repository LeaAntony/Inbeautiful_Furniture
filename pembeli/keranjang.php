<?php
ob_start();
include "header_pembeli.php";
?>

<link rel="stylesheet" href="../assets/css/style_keranjang.css?v=3">

<!-- Keranjang -->
<div class="col-md-11 mx-auto">
    <div class="mx-auto mt-5 p-5">
        <h3 class="fw-bold pt-5">Keranjang Belanja</h3>
        <?php
        if (isset($_SESSION['alert']))
            ;
        echo $_SESSION['alert'];
        $_SESSION['alert'] = "";
        $_SESSION['sesuai'] = "";
        ?>
        <table class="table table-hover mt-4">
            <thead>
                <tr class="fs-6">
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryProduk = mysqli_query($koneksi, "SELECT * FROM keranjang JOIN produk ON keranjang.id_produk = produk.id_produk WHERE id='$id_pengguna'");
                $total = 0;
                if (mysqli_num_rows($queryProduk) > 0) {
                    while ($produk = mysqli_fetch_array($queryProduk)) {
                        ?>
                        <tr class="fs-6 align-middle">
                            <td style="max-width: 50px"
                                onclick="location.href='detail_produk.php?id=<?php echo $produk['id_produk']; ?>'"> <img
                                    src="../assets/images/produk/<?php echo $produk["gambar_produk"] ?>" alt="" width="80px"
                                    height="80px"> </td>
                            <td class="mx-auto"
                                onclick="location.href='detail_produk.php?id=<?php echo $produk['id_produk']; ?>'">
                                <?php echo $produk["nama_produk"] ?>
                            </td>
                            <td class="mx-auto harga" style="color: #ffc107; font-weight: 500;"
                                onclick="location.href='detail_produk.php?id=<?php echo $produk['id_produk']; ?>'">Rp.
                                <?php echo number_format($produk["harga_produk"]) ?>
                            </td>
                            <td class="mx-auto">
                                <form action="fungsi/ubah_keranjang.php" method="POST">
                                    <input type="hidden" name="id_keranjang" value="<?php echo $produk['id_keranjang']; ?>">
                                    <div class="input-group">
                                        <input class="form-input form-control" type="number" min="1"
                                            max="<?php echo $produk['stok_produk'] ?>" name="jumlah_produk"
                                            value="<?php echo $produk["jumlah_produk"] ?>" required>
                                        <input type="submit" name="ubah" value="Ubah" class="btn btn-primary z-0">
                                    </div>
                                </form>
                            </td>
                            <td style="color: #ffc107; font-weight: 500;"
                                onclick="location.href='detail_produk.php?id=<?php echo $produk['id_produk']; ?>'">Rp.
                                <?php echo number_format($subtotal = ($produk["harga_produk"] * $produk["jumlah_produk"])); ?>
                            </td>
                            <td class="mx-auto text-center"><a
                                    href="fungsi/hapus_keranjang.php?hapus=<?php echo $produk['id_keranjang']; ?>"
                                    class="btn btn-danger hapus">Hapus</a></td>
                        </tr>
                        <?php
                        $total += $subtotal;
                    }
                } else {
                    echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">Keranjang Anda kosong!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Checkout -->
    <div class="mx-auto checkout col-md-10 mt-5 p-5">
        <div class="card mt-3 p-1">
            <div class="container mt-2">
                <a href="fungsi/hapus_keranjang.php?hapus_semua"
                    class="btn btn-danger float-end kosongkan <?php echo ($total > 1) ? '' : 'disabled'; ?>">Kosongkan
                    keranjang</a>
                <h3 class="fw-bold">Checkout</h3>
                <div class="row mt-1 mb-1">
                    <div class="col my-auto">
                        <table>
                            <tr>
                                <td class="fs-5 align-right">Total</td>
                                <td class="fs-5">: </td>
                                <td class="fs-5 harga"> Rp.
                                    <?php echo number_format($total) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col my-auto">
                        <form action="pembayaran.php" method="POST">
                            <button type="submit" name="keranjang"
                                class="btn btn-warning w-75 float-end <?php echo ($total > 1) ? '' : 'disabled'; ?>"><span
                                    class="fs-5">Bayar</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br><br><br><br><br>

<script>
    $('.hapus').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin menghapus produk dari keranjang?',
            icon: 'warning',
            confirmButtonColor: '#dc3545',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })
    $('.kosongkan').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin mengkosongkan keranjang?',
            icon: 'warning',
            confirmButtonColor: '#dc3545',
            showCancelButton: true,
            confirmButtonText: 'Kosongkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })
    const flashdata = $('.flash-data').data('flashdata')
    if (flashdata) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Produk sudah ada di keranjang!',
            icon: 'error',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata2 = $('.flash-data2').data('flashdata2')
    if (flashdata2) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Jumlah produk telah diubah.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata3 = $('.flash-data3').data('flashdata3')
    if (flashdata3) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Produk telah dihapus dari keranjang.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata4 = $('.flash-data4').data('flashdata4')
    if (flashdata4) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Keranjang telah dikosongkan.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata5 = $('.flash-data5').data('flashdata5')
    if (flashdata5) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Mohon maaf ada produk yang melebihi stok, Kami telah menyesuaikan keranjang Anda.',
            icon: 'info',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
</script>
<?php
ob_start();
include "footer_pembeli.php";
?>