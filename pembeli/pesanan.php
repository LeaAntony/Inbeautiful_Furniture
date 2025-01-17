<?php
ob_start();
include("header_pembeli.php");

?>

<link rel="stylesheet" href="../assets/css/style_pesanan.css?v=1">
<!-- Isi -->
<div class="row p-5 mx-auto col-md-12 mt-3">

    <!-- Menu -->
    <div class="mx-auto col-md-2" id="menu">
        <div class="mt-5 py-5">
            <div class="row">
                <div class="col my-auto">
                    <h4 class="ms-3 fs-5">Pengguna</h4>
                </div>
            </div>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item py-3">
                    <a class="nav-link fs-5" href="profil.php">
                        <i class="fa-solid fa-user" style="color: #174696;"></i> Profil
                    </a>
                </li>
                <li class="nav-item py-3">
                    <a class="nav-link fs-5" href="pesanan.php">
                        <i class="fa-solid fa-bag-shopping" style="color: #174696;"></i> Pesanan
                    </a>
                </li>
                <hr>
                <li class="nav-item py-3">
                    <a class="nav-link fs-5 keluar" href="../index/keluar.php">
                        <i class="fa-solid fa-right-from-bracket" style="color: #c20000;"></i> Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Pesanan -->
    <div class="mx-auto col-md-10 mt-5 box" id="pesanan">
        <div class="mt-5 mb-3 p-4 bg-warning-subtle rounded-3">
            <h4><i class="fa-solid fa-bag-shopping" style="color: #000000;"></i> Pesanan Saya</h4>
        </div>
        <div class="row p-5 mx-auto border rounded-3">
            <?php
            if (isset($_SESSION['alert']))
                ;
            echo $_SESSION['alert'];
            $_SESSION['alert'] = "";
            ?>
            <table id="tabel-produk" class="table table-hover">
                <thead>
                    <tr>
                        <th class="fs-6">No</th>
                        <th class="fs-6" style="width: 110px;">Tanggal</th>
                        <th class="fs-6">Total Harga</th>
                        <th class="fs-6">Pembayaran</th>
                        <th class="fs-6" style="width: 145px;">No. hp</th>
                        <th class="fs-6">Alamat</th>
                        <th class="fs-6">Status</th>
                        <th class="fs-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = $id_pengguna ORDER BY id_transaksi DESC");
                    while ($row = mysqli_fetch_array($transaksi)) {
                        ?>
                        <tr class="align-middle">
                            <td
                                onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                                <?php echo $no++; ?>
                            </td>
                            <td
                                onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                                <?php echo $row['tanggal_transaksi']; ?>
                            </td>
                            <td style="color: #ffc107; font-weight: 500;"
                                onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                                Rp.
                                <?php echo number_format($row['total_harga']); ?>
                            </td>
                            <td
                                onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                                <?php echo $row['pembayaran']; ?>
                            </td>
                            <td
                                onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                                <?php echo $row['no_hp']; ?>
                            </td>
                            <td
                                onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                                <span class="truncate">
                                    <?php echo $row['alamat']; ?>
                                </span></td>
                            <td
                                onclick="location.href='detail_pesanan.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'">
                                <?php echo $row['status']; ?>
                            </td>
                            <td class="text-center ">
                                <?php
                                if ($row['status'] == 'Dalam Proses') {
                                    ?>
                                    <a class="btn btn-warning konfirmasi"
                                        href="fungsi/selesaikan_pesanan.php?id_transaksi=<?php echo $row['id_transaksi'] ?>">Selesaikan
                                        Pesanan</a>
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
</div>
</div>

<script>
    //datatables
    document.addEventListener("DOMContentLoaded", function () {
        let table = document.getElementById("tabel-produk");
        let dataTable = new DataTable(table, {
            searching: false,
            pageLength: 10,
            lengthChange: false,
            columnDefs: [
                { targets: [0, 1, 6], orderable: true },
                { targets: '_all', orderable: false }

            ]
        });
    });
    $('.keluar').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin keluar?',
            icon: 'warning',
            confirmButtonColor: '#dc3545',
            showCancelButton: true,
            confirmButtonText: 'Keluar',
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
            text: 'Pesanan telah dibuat, mohon menunggu konfirmasi penjual.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
    const flashdata2 = $('.flash-data2').data('flashdata2')
    if (flashdata2) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Pesanan selesai.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
</script>
<?php
include("footer_pembeli.php");
?>