<?php
// Koneksi ke database
$conn = new mysqli("localhost", "username", "password", "nama_database");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$namaPelanggan = $_POST['namaPelanggan'];
$namaItem = $_POST['namaItem'];
$jumlah = $_POST['jumlah'];
$totalHarga = $_POST['totalHarga'];

// Simpan ke database
$query = "INSERT INTO pesanan (nama_pelanggan, nama_item, jumlah, total_harga, status_pesanan, tanggal_pesanan)
          VALUES ('$namaPelanggan', '$namaItem', $jumlah, $totalHarga, 'pending', NOW())";

if ($conn->query($query) === TRUE) {
    echo "Pesanan berhasil disimpan!";
    header("Location: orders.php"); // Kembali ke halaman daftar pesanan
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>