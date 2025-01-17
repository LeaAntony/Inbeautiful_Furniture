<?php
ob_start();
include "header_penjual.php"
    ?>

<link rel="stylesheet" href="../assets/css/style_data_produk.css?v=3">

<div class="col-md-12 mb-5" style="margin-left: 125px;">
    <h3><strong>Data Produk</strong></h3><br>
    <a href="tambah_produk.php" class="btn btn-warning">Tambah Produk</a>
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
                <th class="tabel">Kategori</th>
                <th class="tabel">Gambar</th>
                <th class="tabel_nama">Nama</th>
                <th class="tabel_deskripsi">Deskripsi</th>
                <th class="tabel">Harga</th>
                <th class="tabel">Stok</th>
                <th style="width: 125px;" class="tabel text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $produk = mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori USING (id_kategori) ORDER BY id_produk DESC");
            while ($row = mysqli_fetch_array($produk)) {
                ?>
                <tr class="align-middle">
                    <td>
                        <?php echo $no++ ?>
                    </td>
                    <td>
                        <?php echo "<div class='truncate'>" . $row['nama_kategori'] . "</div>" ?>
                    </td>
                    <td> <img src="../assets/images/produk/<?php echo $row['gambar_produk'] ?>" alt="" width="110px"
                            height="110px"> </td>
                    <td>
                        <?php echo "<div class='truncate'>" . $row['nama_produk'] . "</div>" ?>
                    </td>
                    <td> <span class="truncate tabel_deskripsi">
                            <?php echo $row['deskripsi_produk'] ?>
                        </span></td>
                    <td style="color: #ffc107; font-weight: 500;"> Rp.
                        <?php echo number_format($row['harga_produk']) ?>
                    </td>
                    <td>
                        <?php echo $row['stok_produk'] ?>
                    </td>
                    <td class="text-center mx-auto">
                        <a class="btn btn-primary" href="ubah_produk.php?id=<?php echo $row['id_produk'] ?>">Ubah</a>
                        <a class="btn btn-danger hapus"
                            href="fungsi/fungsi_hapus.php?id_produk=<?php echo $row['id_produk'] ?>" value="hapus">Hapus</a>
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
                { targets: [0, 1, 3], orderable: true },
                { targets: '_all', orderable: false }

            ]
        });
    });
    $('.hapus').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin menghapus data produk?',
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
    const flashdata = $('.flash-data').data('flashdata')
    if (flashdata) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Data produk telah dihapus.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata1 = $('.flash-data1').data('flashdata1')
    if (flashdata1) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Data produk telah ditambahkan.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata2 = $('.flash-data2').data('flashdata2')
    if (flashdata2) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Data produk telah diubah.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
</script>

<?php
include "footer_penjual.php"
    ?>