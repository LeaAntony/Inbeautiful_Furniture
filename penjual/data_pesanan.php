<?php
ob_start();
include "header_penjual.php"
    ?>

<link rel="stylesheet" href="../assets/css/style_data_pesanan.css?v=1">

<div class="col-md-12 mb-5" style="margin-left: 125px;">
    <h3><strong>Data Pesanan</strong></h3>
    <?php
    if (isset($_SESSION['alert']))
        ;
    echo $_SESSION['alert'];
    $_SESSION['alert'] = "";
    ?>
    <table id="tabel-produk" class="table table-striped table-hover mb-5 mx-auto">
        <thead class="table-warning">
            <tr>
                <th scope="col" class="fs-6">No</th>
                <th scope="col" style="width: 105px;" class="fs-6">Tanggal</th>
                <th scope="col" style="min-width: 100px;" class="fs-6">Total Harga</th>
                <th scope="col" class="fs-6">Pembayaran</th>
                <th scope="col" style="min-width: 125px;" class="fs-6">No. hp</th>
                <th scope="col" class="fs-6">Alamat</th>
                <th scope="col" class="fs-6">Status</th>
                <th scope="col" style="min-width: 220px;" class="fs-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
            while ($row = mysqli_fetch_array($transaksi)) {
                ?>
                <tr class="align-middle">
                    <td onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                        <?php echo $no++; ?>
                    </td>
                    <td onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                        <?php echo $row['tanggal_transaksi']; ?>
                    </td>
                    <td style="color: #ffc107; font-weight: 500;"
                        onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">Rp.
                        <?php echo number_format($row['total_harga']); ?>
                    </td>
                    <td onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                        <?php echo $row['pembayaran']; ?>
                    </td>
                    <td onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                        <?php echo $row['no_hp']; ?>
                    </td>
                    <td onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'"> <span
                            class="truncate">
                            <?php echo $row['alamat']; ?>
                        </span></td>
                    <td onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                        <?php echo $row['status']; ?>
                    </td>
                    <td class="mx-auto text-center">
                        <?php
                        if ($row['status'] == 'Menunggu Konfirmasi') {
                            ?>
                            <a class="btn btn-warning konfirmasi"
                                href="fungsi/konfirmasi_pesanan.php?id_transaksi=<?php echo $row['id_transaksi'] ?>">Konfirmasi</a>
                            <a class="btn btn-danger batal ms-2"
                                href="fungsi/batalkan_pesanan.php?id_transaksi=<?php echo $row['id_transaksi'] ?>"
                                value="batal">Batalkan</a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>

<script>
    //datatables
    document.addEventListener("DOMContentLoaded", function () {
        let table = document.getElementById("tabel-produk");
        let dataTable = new DataTable(table, {
            pageLength: 10,
            lengthChange: false,
            columnDefs: [
                { targets: [0, 1, 6], orderable: true },
                { targets: '_all', orderable: false }
            ]
        });
    });
    $('.konfirmasi').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin mengkonfirmasi pesanan?',
            icon: 'warning',
            confirmButtonColor: '#ffc107',
            showCancelButton: true,
            confirmButtonText: 'Konfirmasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })
    $('.batal').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin membatalkan pesanan?',
            icon: 'warning',
            confirmButtonColor: '#dc3545',
            showCancelButton: true,
            confirmButtonText: 'Batalkan',
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
            text: 'Pesanan telah dikonfirmasi.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata1 = $('.flash-data1').data('flashdata1')
    if (flashdata1) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Pesanan dibatalkan.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }

</script>
<?php
include "footer_penjual.php"
    ?>