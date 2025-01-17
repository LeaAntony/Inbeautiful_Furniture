<?php
ob_start();
include "header_penjual.php";
?>

<link rel="stylesheet" href="../assets/css/style_penjual.css?v=2">

<div class="col-md-12 mb-5" style="margin-left: 125px;">
    <h2>Selamat Datang
        <?php
        echo "<FONT COLOR='#ffc107'>" . $fetch['nama'] . "</FONT>";
        ?>
        di InBeautiful Room
    </h2>
    <hr>
    <div class="container"></div>
    <img src="../assets/images/banner/banner_penjual.png" class="img-fluid w-100" alt="...">
    <p class="mt-4">
        Anda berada di halaman dashboard penjual. Sebagai penjual, anda dapat mengatur
        produk jualan anda. Di menu Produk, anda dapat menambahkan produk baru, mengedit detail produk
        dan menghapus produk yang sudah ada. Di menu Pembelian, anda dapat melihat daftar riwayat
        transaksi yang dilakukan oleh pembeli. Anda dapat melihat produk apa yang dibeli serta tanggal
        transaksinya.
    </p>
</div>
</div>

<?php
include "footer_penjual.php"
    ?>