<?php
ob_start();
include("header_pembeli.php");

$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE id=$id_pengguna");
$row = mysqli_fetch_array($sql);
?>

<link rel="stylesheet" href="../assets/css/style_profil.css?v=1">
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

    <!-- Profil -->
    <div class="mx-auto col-md-10 box" id="profil">
        <div class="mt-5 mb-3 p-4 bg-warning-subtle rounded-3">
            <h4><i class="fa-solid fa-user " style="color: #000000;"></i> Profil Saya</h4>
        </div>
        <div class="row p-5 mx-auto border rounded-3">
            <?php
            if (isset($_SESSION['alert']))
                ;
            echo $_SESSION['alert'];
            $_SESSION['alert'] = "";
            ?>
            <div class="row">
                <div class="col">
                    <table>
                        <tr class="fs-5">
                            <td class="py-3">Username</td>
                            <td class="px-5">
                                <fieldset disabled="disabled">
                                    <input type="text" name="username" size="100" class="form-control"
                                        value="<?php echo $row['username'] ?>">
                                </fieldset>
                            </td>
                        </tr>
                        <tr class="fs-5">
                            <td class="py-3">Nama</td>
                            <td class="px-5">
                                <fieldset disabled="disabled">
                                    <input type="text" name="nama" size="100" class="form-control"
                                        value="<?php echo $row['nama'] ?>">
                                </fieldset>
                            </td>
                        </tr>
                        <tr class="fs-5">
                            <td class="py-3">No HP</td>
                            <td class="px-5">
                                <fieldset disabled="disabled">
                                    <input type="text" name="nama" size="100" class="form-control"
                                        value="<?php echo $row['no_hp'] ?>">
                                </fieldset>
                            </td>
                        </tr>
                        <tr class="fs-5">
                            <td class="py-5">Alamat</td>
                            <td class="px-5">
                                <fieldset disabled="disabled">
                                    <textarea class="form-control text-area" name="alamat"
                                        rows="5"><?php echo $row['alamat'] ?></textarea>
                                </fieldset>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-5">
                        <a class=" float-end btn btn-small btn-warning" href="ubah_profil.php">
                            Ubah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
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
    const flashdata1 = $('.flash-data1').data('flashdata1')
    if (flashdata1) {
        swal.fire({
            title: 'Inbeautiful',
            text: 'Data pengguna berhasil diperbarui.',
            icon: 'success',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Ok',
        })
    }
</script>
<?php
include("footer_pembeli.php");
?>