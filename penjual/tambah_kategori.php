<?php
ob_start();
include "header_penjual.php";
?>

<link rel="stylesheet" href="../assets/css/style_tambah_produk.css?v=1">

<div class="col-md-12 mb-5" style="margin-left: 125px;">
    <h3><strong>Tambah Kategori</strong></h3><br>
    <?php
    if (isset($_SESSION['alert']))
        ;
    echo $_SESSION['alert'];
    $_SESSION['alert'] = "";
    ?>
    <form action="fungsi/fungsi_tambah.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label">Gambar Kategori</label>
            <input type="file" class="form-control" name="gambar_kategori" required>
            <p class="keterangan">(jpg, jpeg, png, gif)*</p>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" placeholder="Masukkan nama produk" name="nama_kategori" required>
        </div><br>
        <input type="submit" name="kategori" value="Tambah" class="btn btn-warning">
    </form>
    <br>
</div>
</div>

<script>
    const flashdata = $('.flash-data').data('flashdata')
    if (flashdata) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Format file tidak diizinkan (format yang diizinkan adalah jpg, jpeg, png, gif).',
            icon: 'error',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
</script>
<?php
include "footer_penjual.php"
    ?>