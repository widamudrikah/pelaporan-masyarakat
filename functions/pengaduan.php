<?php

function buat_pengaduan($user_id, $message, $image, $conn) {
    // Gunakan prepared statement untuk mencegah SQL injection dan menangani error SQL
    $stmt = $conn->prepare("INSERT INTO reports (user_id, message, image, status, created_at) VALUES (?, ?, ?, ?, NOW())");
    
    // Setting nilai default untuk status
    $status = 'proses';
    
    // Menghubungkan parameter ke prepared statement
    $stmt->bind_param("ssss", $user_id, $message, $image, $status);

    // Eksekusi statement dan kembalikan hasilnya
    return $stmt->execute();
}


// Fungsi untuk mengambil pengaduan berdasarkan status
function get_pengaduan_by_status($username, $status, $conn) {
    // Ambil id dari masyarakat berdasarkan userusername
    $query_id = "SELECT id FROM user WHERE username ='$username'";
    $result_id = mysqli_query($conn, $query_id);
    $row = mysqli_fetch_assoc($result_id);
    $id = $row['id'];

    // Ambil pengaduan sesuai status yang diberikan
    $query = "SELECT * FROM reports WHERE id ='$id' AND status='$status'";
    $result = mysqli_query($conn, $query);
    
    $pengaduan = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pengaduan[] = $row;
    }
    
    return $pengaduan;
}

?>
