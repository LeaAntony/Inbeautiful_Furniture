<?php
ob_start();
include "header_penjual.php"
    ?>

<link rel="stylesheet" href="../assets/css/style_data_produk.css?v=2">

<div class="col-md-12 mb-5" style="margin-left: 125px;">
    <h3><strong>Data Kategori</strong></h3><br>
    <a href="tambah_kategori.php" class="btn btn-warning">Tambah Kategori</a>
    <?php
    if (isset($_SESSION['alert']))
        ;
    echo $_SESSION['alert'];
    $_SESSION['alert'] = "";
    ?>
    <table id="tabel-produk" class="table table-striped table-hover mb-5">
        <thead class="table-warning">
            <tr>
                <th class="tabel_no">NO</th>
                <th class="tabel">Gambar</th>
                <th class="tabel">Nama</th>
                <th class="tabel">Jumlah Produk</th>
                <th class="tabel text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
            while ($row = mysqli_fetch_array($kategori)) {
                ?>
                <tr class="align-middle">
                    <td>
                        <?php echo $no++ ?>
                    </td>
                    <td> <img src="../assets/images/kategori/<?php echo $row['gambar_kategori'] ?>" alt="" width="110px"
                            height="110px"> </td>
                    <td>
                        <?php echo "<div class='truncate'>" . $row['nama_kategori'] . "</div>" ?>
                    </td>
                    <td>
                        <?php
                        $awal = 0;
                        $produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori = $row[id_kategori]");
                        while ($row1 = mysqli_fetch_array($produk)) {
                            $jumlah_produk = 1 + $awal;
                            $awal = $jumlah_produk;
                        }
                        echo $awal
                            ?>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="ubah_kategori.php?id=<?php echo $row['id_kategori'] ?>">Ubah</a>
                        <a class="btn btn-danger <?php echo ($awal > 0) ? '' : 'hapus'; ?> <?php echo ($awal < 1) ? '' : 'digunakan'; ?>"
                            href="fungsi/fungsi_hapus.php?id_kategori=<?php echo $row['id_kategori'] ?>"
                            value="hapus">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    //datatables
    document.addEventListener("DOMContentLoaded", function () {
        let table = document.getElementById("tabel-produk");
        let dataTable = new DataTable(table, {
            pageLength: 5,
            lengthChange: false,
            columnDefs: [
                { targets: [0, 2], orderable: true },
                { targets: '_all', orderable: false }

            ]
        });
    });
    $('.hapus').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin menghapus data kategori?',
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
    $('.digunakan').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Kategori tidak bisa dihapus, tolong ubah atau hapus produk yang menggunakan kategori ini terlebih dahulu!',
            icon: 'error',
            CancelButtonColor: '#dc3545',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'Oke'
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
            text: 'Data kategori telah dihapus.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata1 = $('.flash-data1').data('flashdata1')
    if (flashdata1) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Data kategori telah ditambahkan.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata2 = $('.flash-data2').data('flashdata2')
    if (flashdata2) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Data kategori telah diubah.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
</script>

<?php
include "footer_penjual.php"
    ?>