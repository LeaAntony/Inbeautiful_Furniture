<?php
ob_start();
include "header_penjual.php";

$produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
$b = mysqli_fetch_object($produk);
?>

<link rel="stylesheet" href="../assets/css/style_edit_produk.css?v=1">

<div class="col-md-12 mb-5" style="margin-left: 125px;">
    <h3><strong>Ubah Produk</strong></h3><br>
    <?php
    if (isset($_SESSION['alert']))
        ;
    echo $_SESSION['alert'];
    $_SESSION['alert'] = "";
    ?>
    <form action="fungsi/fungsi_ubah.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label">Kategori Produk</label>
            <input type="hidden" name="id_produk" value="<?php echo $b->id_produk ?>">
            <select class="input form-select" name="nama_kategori" required>
                <option value="" disabled selected>--Pilih Kategori--</option>
                <?php
                $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                while ($r = mysqli_fetch_array($kategori)) {
                    ?>
                    <option value="<?php echo $r['id_kategori'] ?>" <?php echo ($r['id_kategori'] == $b->id_kategori) ? 'selected' : ''; ?>>
                        <?php echo $r['nama_kategori'] ?>
                    </option>
                <?php } ?>
            </select>
        </div><br>
        <div class="form-group">
            <label class="form-label">Gambar Produk </label>
            <input type="hidden" name="gambar_sebelum" value="<?php echo $b->gambar_produk ?>">
            <input type="file" class="form-control" name="gambar_produk">
            <p class="keterangan">(jpg, jpeg, png, gif)*</p>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Produk</label>
            <input type="text" class="form-control" placeholder="Masukkan nama produk" name="nama_produk"
                value="<?php echo $b->nama_produk ?>" required>
        </div><br>
        <div class="form-group">
            <label class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" placeholder="Masukkan deskripsi produk" name="deskripsi_produk" id="editor"
                minlength="25"><?php echo $b->deskripsi_produk ?></textarea>
        </div><br>
        <div class="form-group">
            <label class="form-label">Harga Produk</label>
            <input type="number" min="1" class="form-control" placeholder="Masukkan harga produk" name="harga_produk"
                value="<?php echo $b->harga_produk ?>" required>
        </div><br>
        <div class="form-group">
            <label class="form-label">Stok Produk</label>
            <input type="number" min="1" class="form-control" placeholder="Masukkan stok produk" name="stok_produk"
                value="<?php echo $b->stok_produk ?>" required>
        </div><br>
        <input type="submit" name="produk" value="Ubah" class="btn btn-warning">
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