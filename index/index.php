<?php
error_reporting(0);
include "../koneksi.php";

if ($_SESSION["peran"] == 'Pembeli') {
    header("location:../pembeli/dashboard_pembeli.php");
} else if ($_SESSION["peran"] == 'Penjual') {
    header("location:../penjual/dashboard_penjual.php");
} else {

    $username = "";
    $password = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_index.css?v=1">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo/icon.png">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <title>Inbeautiful Room Furniture - Index</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <a href="../admin" class="position-absolute top-0 end-0 mx-3"><h6><i class="fa-solid fa-user navbar-brand"></i> Admin</h6></a>
            <form action="fungsi/fungsi_daftar.php" method="POST">
                <h1>Daftar</h1>
                <?php
                if (isset($_SESSION['alert2']))
                    ;
                echo $_SESSION['alert2'];
                if ($_SESSION['alert2']) {
                    echo '
                            <script>
                                window.onload = function() {
                                document.getElementsByClassName("registerClick")[0].click();
                                };
                            </script>
                        ';
                }
                ;
                $_SESSION['alert2'] = "";
                ?>
                <input type="hidden" name="peran" id="" value="Pembeli">
                <label for="Role" class="form-label">Email</label>
                <input type="email" name="email" id="" placeholder="Masukkan email Anda" required>
                <label for="Name" class="form-label">Nama</label>
                <input type="text" placeholder="Masukkan username Anda" name="nama" required>
                <label for="Username" class="form-label">Username</label>
                <input type="text" placeholder="Masukkan username Anda" name="username" required>
                <label for="Password" class="form-label">Password</label>
                <input type="password" placeholder="Masukkan password Anda" name="password" required>
                <button type="submit" name="submit" value="Daftar">Daftar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <a href="../admin" class="position-fixed mx-3"><h6><i class="fa-solid fa-user navbar-brand"></i> Admin</h6></a>
            <form action="fungsi/fungsi_masuk.php" method="POST">
                <h1>Masuk</h1>
                <?php
                if (isset($_SESSION['alert1']))
                    ;
                echo $_SESSION['alert1'];
                $_SESSION['alert1'] = "";
                if (isset($_SESSION['tamu']))
                    ;
                echo $_SESSION['tamu'];
                $_SESSION['tamu'] = "";

                ?>
                <label for="Username" class="form-label">Username</label>
                <input type="text" name="username" placeholder="Masukkan username Anda" required>
                <label for="Username" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Masukkan password Anda" required>
                <button type="submit" name="submit" value="Masuk">Masuk</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    
                    <img src="../assets/images/logo/logo_transparent_cropped.png" class="logo" alt="">
                    <p>Sudah memiliki akun? silahkan login!</p>
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="../assets/images/logo/logo_transparent_cropped.png" class="logo" alt="">
                    <p>Belum memiliki akun? silakan daftar terlebih dahulu!</p>
                    <button class="hidden registerClick" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script_index.js"></script>
</body>

</html>