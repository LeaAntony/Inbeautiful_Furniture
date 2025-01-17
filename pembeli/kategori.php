<?php
ob_start();
include "header_pembeli.php";
?>


<link rel="stylesheet" href="../assets/css/style_pembeli.css?v=1">
<br>
<br>
<br>
<br>
<!-- Bagian Konten -->
<h2 class="text-center font-weight-bold mr-4 mt-5">Kategori</h2>
<div class="row mx-auto">
    <?php
    $kategori1 = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY rand()");
    while ($row1 = mysqli_fetch_array($kategori1)) {
        ?>
        <div class="card ml-2 mr-2 mx-auto mt-4 card-kategori" style="width: 19rem;">
            <a href="produk.php?kategori=<?php echo $row1['nama_kategori'] ?>">
                <img src="../assets/images/kategori/<?php echo $row1['gambar_kategori'] ?>" class="card-img img-kategori "
                    alt="...">
            </a>
        </div>
    <?php } ?>
</div>
</div>

<?php
include "footer_pembeli.php";
?>