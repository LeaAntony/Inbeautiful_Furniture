<?php
error_reporting(0);
include "../../koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

    $cek_username = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($koneksi, $cek_username);
    if (mysqli_num_rows($result) > 0) {

        $data_pengguna = mysqli_fetch_assoc($result);
        $is_password = password_verify($password, $data_pengguna["password"]);
        if ($is_password) {

            if ($data_pengguna["peran"] == "Penjual") {
                $_SESSION['username'] = $username;
                $_SESSION['peran'] = "Penjual";
                $_SESSION['alert'] = "";

                header("location:../../penjual/dashboard_penjual.php");
            } else if ($data_pengguna["peran"] == "Pembeli") {
                $_SESSION['username'] = $username;
                $_SESSION['peran'] = "Pembeli";
                $_SESSION['id'] = $data_pengguna["id"];
                $_SESSION['alert'] = "";

                header("location:../../pembeli/dashboard_pembeli.php");
            }
        } else {
            $_SESSION['alert1'] = "<div class='alert alert-danger' onclick='this.remove();'>Password Anda salah!</div>";
            header("location:../index.php");
        }
    } else {
        $_SESSION['alert1'] = "<div class='alert alert-danger' onclick='this.remove();'>Username belum terdaftar!</div>";
        header("location:../index.php");
    }
}
else {
    header("location:../index.php");
}
?>