<?php
ob_start();
include("../../koneksi.php");
if (isset($_POST['ubah'])) {
    $id_pengguna = $_SESSION['id'];
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $cek = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username' AND id != '$id_pengguna'");
    $user_exists = mysqli_num_rows($cek);

    if ($user_exists > 0) {
        $_SESSION['alert'] = "<div class='flash-data' data-flashdata='<?php echo $_Session[alert]; ?>'></div>";
        header("location: ../ubah_profil.php");
    } else {
        $insert = mysqli_query($koneksi, "UPDATE users SET username = '$username', nama = '$nama', no_hp = '$no_hp', alamat = '$alamat' WHERE id = '$id_pengguna' ") or die('query failed');

        if ($insert) {
            $_SESSION['alert'] = "<div class='flash-data1' data-flashdata1='<?php echo $_Session[alert]; ?>'></div>";
            header("location: ../profil.php");
        } else {
            echo '<script>alert("Gagal".mysqli_error($koneksi))</script>';
        }
    }
}
else {
    header("location: ../profil.php");
}
?>