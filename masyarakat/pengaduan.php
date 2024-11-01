<?php
session_start();
include '../data-base/db.php';
include '../functions/pengaduan.php';

if ($_SESSION['role'] != '1') {
    header('Location: ../auth/login.php');
    exit;
}



if (isset($_POST['submit'])) {
    // Validasi input
    $report = $_POST['report'] ?? '';

    // Handling file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $target_dir = "../uploads/";

        // Pindahkan file gambar ke folder tujuan
        move_uploaded_file($tmp_name, $target_dir . $image);
    } else {
        $image = '';  // Jika tidak ada gambar yang diupload
    }

    // Simpan data pengaduan ke database
    if (!empty($report)) {
        $status = buat_pengaduan($_SESSION['user_id'], $report, $image, $conn);

        if ($status) {
            header("Location: dashboard_masyarakat.php");
        } else {
            echo "Terjadi kesalahan, coba lagi!";
        }
    } else {
        echo "Isi laporan wajib diisi!";
    }
}
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
        <!-- Sidebar and Navbar -->
        <!-- (Content truncated for brevity) -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Form Laporan</h1>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-success">
                            <h6 class="m-0 font-weight-bold text-white">Silahkan isi data-data di bawah ini:</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Laporan :</label>
                                    <textarea name="report" required rows="3" class="form-control" id="exampleInputPassword1"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                    <input type="file" name="image" class="form-control" id="inputGroupFile01">
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
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
    <script src="../bootstrap/js/sb-admin-2.min.js"></script>
</body>
</html>
