<?php
ob_start();
include '../../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($koneksi, $_POST["email"]);
    $peran = mysqli_real_escape_string($koneksi, $_POST["peran"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $cek = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    $user_exists = mysqli_num_rows($cek);

    if ($user_exists > 0) {
        $_SESSION['alert2'] = "<div class='alert alert-danger' id='alert-danger' onclick='this.remove();'>Username telah digunakan, mohon gunakan username lain!</div>";
        header("location: ../index.php");
    } else {
        $insert = "INSERT INTO `users` (`id`, `peran`, `nama`, `username`, `password`, `email`) VALUES (NULL, '$peran', '$nama', '$username', '$password', '$email')";

        if (mysqli_query($koneksi, $insert)) {
            $_SESSION['alert1'] = "<div class='alert alert-warning' id='alert-warning' onclick='this.remove();'>Akun berhasil didaftarkan, silakan masuk.</div>";
            header("location: ../index.php");
        } else {
            echo '<script>alert("Gagal".mysqli_error($koneksi))</script>';
        }
    }
}
else {
    header("location:../index.php");
}
?>