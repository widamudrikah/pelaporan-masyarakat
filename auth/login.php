<?php
session_start();
include '../data-base/db.php';
include '../functions/auth.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = login($username, $password, $conn);

    if ($login['role'] == 2) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 2;
        header('Location: ../petugas/dashboard_petugas.php');
    } else if ($login['role'] == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 1;
        header('Location: ../masyarakat/dashboard_masyarakat.php');
    } else {
        echo "username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sicepu</title>
    <link rel="shortcut icon" href="./assets/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap/css/sb-admin-2.min.css">

</head>

<body class="bg-gradient-primary">
    <div class="container h-100">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <dotlottie-player src="https://lottie.host/1b6c09b4-1d95-49fa-9342-8dcffa6f1377/bvCI1iBG8P.json" background="transparent" speed="1" style="width: 500px; height: 500px;" loop autoplay></dotlottie-player>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Selamat Datang!</h1>
                                        <h3 class="h6 text-gray-900 mb-4">SICEPU hadir untuk menampung semua keluh kesah masyarakat</h3>
                                    </div>
                                    <!-- Form login -->
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" required class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <!-- End login form -->
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script src="bootstrap/js/sb-admin-2.min.js"></script>
</body>

</html>