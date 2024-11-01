<?php
session_start();

include '../data-base/db.php';
include '../functions/pengaduan.php';

// Memeriksa apakah pengguna adalah admin
if ($_SESSION['role'] != 1) {
    header('Location: ../auth/login.php');
    exit;
}

// Mendapatkan data pengaduan yang statusnya masih proses
$pengaduan_proses = get_pengaduan_by_status($_SESSION['username'], 'proses', $conn);

// Mendapatkan data pengaduan yang sudah selesai/tanggapan
$pengaduan_selesai = get_pengaduan_by_status($_SESSION['username'], 'selesai', $conn);

// Menghitung jumlah pengaduan yang masih proses dan selesai
$jumlah_proses = count($pengaduan_proses);
$jumlah_selesai = count($pengaduan_selesai);

$semua_laporan = $jumlah_proses + $jumlah_selesai;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/icon.svg" type="image/x-icon">
    <title>Sicepu</title>
    <link rel="stylesheet" href="../bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_masyarakat.php">
                <div class="sidebar-brand-text">SICEPU</div>
            </a>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard_masyarakat.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="pengaduan.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Buat Laporan</span>
                </a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-3">
                <a href="../auth/logout.php"><button class="rounded-circle border-0" id="sidebarToggle"></button></a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, <?= $_SESSION['username'] ?></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Laporanku</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $semua_laporan ?></div>
                                                </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Laporan dalam proses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_proses ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laporan Ditanggapi
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_selesai ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-success">
                                    <h6 class="m-0 font-weight-bold text-white">LAPORAN DALAM PROSES</h6>
                                </div>
                                <div class="card-body">
                                    <?php foreach ($pengaduan_proses as $p): ?>
                                        <div class="card p-4 mb-3">
                                            <strong>Tanggal Laporan:</strong> 
                                            <p><?= date('d-m-Y', strtotime($p['created_at'])) ?></p>
                                            <strong>Status:</strong> 
                                            <p><?= $p['status'] ?></p>
                                            <strong>Komentar:</strong>
                                            <p><?= $p['report'] ?></p>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-warning">
                                    <h6 class="m-0 font-weight-bold text-white">LAPORAN SELESAI</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card p-4 mb-3">
                                        <?php foreach ($pengaduan_selesai as $p): ?>
                                            <div class="card p-4 mb-3">
                                            <strong>Tanggal Laporan:</strong> 
                                            <p><?= date('d-m-Y', strtotime($p['created_at'])) ?></p>
                                            <strong>Status:</strong> 
                                            <p><?= $p['status'] ?></p>
                                            <strong>Komentar:</strong>
                                            <p><?= $p['report'] ?></p>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>

        </div>
    </div>
    <!-- <h1>Selamat datang, <?= $_SESSION['name'] ?></h1>
    <a href="pengaduan.php">Buat Pengaduan</a>
    -->

    <script src="./bootstrap/js/sb-admin-2.min.js"></script>
</body>

</html>