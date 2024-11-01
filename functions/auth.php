<?php
function login($username, $password, $conn) {
    // Query untuk mendapatkan user berdasarkan userusername dan password
    $query = "SELECT role FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Jika ada hasil yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil data role dari hasil query
        $user = mysqli_fetch_assoc($result);
        return ['role' => $user['role']]; // Mengembalikan role sesuai dengan database
    } 
    
    // Jika tidak ada user yang cocok, return status error
    return ['status' => 'error'];
}

?>
