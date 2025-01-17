<?php
ob_start();
include "header_pembeli.php";

$produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
if (mysqli_num_rows($produk) > 0) {
    $b = mysqli_fetch_array($produk);
    if ($b['stok_produk'] < 1) {
        $_SESSION['alert1'] = "<div class='flash-data' data-flashdata='<?php echo $_SESSION[alert]; ?>'></div>";
        header('location:dashboard_pembeli.php');
    }
} else {
    $_SESSION['alert1'] = "<div class='flash-data' data-flashdata='<?php echo $_SESSION[alert]; ?>'></div>";
    header('location:dashboard_pembeli.php');
}
?>

<link rel="stylesheet" href="../assets/css/style_detail_produk.css?v=1">
</br>
<br>

<body>
    <!-- Product Details -->
    <div class="container mt-5 col-md-12">
        <?php
        if (isset($_SESSION['alert']))
            ;
        echo $_SESSION['alert'];
        $_SESSION['alert'] = "";
        ?>
        <div class="row mt-5">
            <div class="col-md-8 mt-5">
                <div class="product-container1">
                    <img src="../assets/images/produk/<?php echo $b['gambar_produk'] ?>" alt=""
                        class="product-image"></br>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="product-container2">
                    <h2 class="product-title">
                        <?php echo $b['nama_produk'] ?>
                    </h2>
                    <h1 class="product-price">Rp.
                        <?php echo number_format($b['harga_produk']) ?>
                    </h1>
                    <h4>
                        <?php
                        $awal = '0';
                        $produk_terjual = mysqli_query($koneksi, "SELECT jumlah_produk FROM detail_transaksi WHERE id_produk = $b[id_produk]");
                        if (mysqli_num_rows($produk_terjual) > 0) {
                            while ($terjual = mysqli_fetch_array($produk_terjual)) {

                                $jumlah_produk = $terjual['jumlah_produk'];

                                $total_terjual = $jumlah_produk + $awal;
                                $awal = $total_terjual;
                            }
                        }
                        echo $awal;
                        ?>
                        Terjual
                    </h4>
                    <div class="product-actions">
                        <form method="POST" action="fungsi/tambah_keranjang.php">
                            <div class="quantity-control data_produk">
                                <span class="quantity-label">Jumlah</span>
                                <input class="text-center w-25" type="number" id="quantity" name="jumlah_produk"
                                    value="1" min="1" max="<?php echo $b['stok_produk'] ?>">
                                <span class="remaining-label">tersisa
                                    <?php echo $b['stok_produk'] ?> buah
                                </span>
                                <input type="hidden" name="id_produk" value="<?php echo $b['id_produk'] ?>">
                                <input type="hidden" name="id" value="<?php echo $id_pengguna ?>">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-warning product-button" name="submit">Tambah ke
                                Keranjang</button>
                        </form>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning mt-3" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Beli sekarang
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            <?php echo $b['nama_produk']; ?>
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="pembayaran_langsung.php?id=<?php echo $b['id_produk'] ?>"
                                        method="POST">
                                        <div class="modal-body">
                                            <input class="text-center w-25" type="number" id="quantity"
                                                name="jumlah_produk" value="1" min="1"
                                                max="<?php echo $b['stok_produk'] ?>">
                                            <input type="hidden" name="id_produk" value="<?php echo $b['id_produk'] ?>">
                                            <input type="hidden" name="id" value="<?php echo $id_pengguna ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning">Beli</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                        </br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 product-description">
            <p><b>
                    <h4>Deskripsi Produk</h4>
                </b></p>
            <div class="justify">
                <?php echo $b['deskripsi_produk'] ?>
            </div>
        </div>
        <div class="col-md-12 product-terkait">
            <div class="row">
                <p><b>
                        <h4>Produk Terkait</h4>
                    </b></p>
                <?php
                $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok_produk > 0 AND id_kategori=$b[id_kategori] AND id_produk != $b[id_produk] ORDER BY rand() LIMIT 4");
                $countData = mysqli_num_rows($queryProduk);
                if ($countData < 1) {
                    ?>
                    <h3 class="text-center font-weight-bold mr-4 mt-5 hasilx">Mohon maaf, Produk terkait tidak ada</h3>
                    <?php
                }
                while ($produk = mysqli_fetch_array($queryProduk)) {
                    ?>
                    <a href="detail_produk.php?id=<?php echo $produk['id_produk'] ?>"
                        class="btn card card-produk ml-2 mr-2 mx-auto mt-4" style="width: 16.5rem;">
                        <img src="../assets/images/produk/<?php echo $produk['gambar_produk'] ?>"
                            class="card-img-top img-fluid img-cover" alt="...">
                        <div class="card-body bg-light">
                            <h5 class="card-title text-truncate">
                                <?php echo $produk['nama_produk'] ?>
                            </h5>
                            <span class="truncate">
                                <?php echo $produk['deskripsi_produk'] ?>
                            </span>
                            <p class="card-text harga"> Rp.
                                <?php echo number_format($produk['harga_produk']) ?>
                            </p>
                            <p class="card-text"> Stok
                                <?php echo $produk['stok_produk'] ?>
                            </p>
                            <div class="collapse" id="collapseExample">
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>


    <script>
        const flashdata1 = $('.flash-data1').data('flashdata1')
        if (flashdata1) {
            swal.fire({
                title: 'Inbeautiful',
                text: 'Produk ditambahkan ke keranjang.',
                icon: 'success',
                confirmButtonColor: '#ffc107',
                confirmButtonText: 'Ok',
            })
        }
        const flashdata2 = $('.flash-data2').data('flashdata2')
        if (flashdata2) {
            swal.fire({
                title: 'Inbeautiful',
                text: 'Mohon maaf stok tidak sesuai, silakan membeli ulang.',
                icon: 'info',
                confirmButtonColor: '#ffc107',
                confirmButtonText: 'Ok',
            })
        }
    </script>
    <?php
    include "footer_pembeli.php";
    ?>