<?php
// Mengonfigurasi koneksi ke database MySQL
$servername = "localhost";  // Nama server (biasanya 'localhost' untuk pengembangan lokal)
$username = "root";         // Nama pengguna database
$password = "";             // Password pengguna database (kosong jika belum diset)
$dbname = "restaurant_db";  // Nama database yang telah dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
