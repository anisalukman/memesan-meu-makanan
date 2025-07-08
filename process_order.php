<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'restaurant_db');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$customer_name = $_POST['customer_name'];
$item_name = $_POST['item_name'];
$quantity = (int) $_POST['quantity'];
$total_price = (int) $_POST['total_price'];
$order_status = 'pending'; // Default status saat pemesanan

// Masukkan data ke tabel 'orders'
$sql = "INSERT INTO orders (customer_name, item_name, quantity, total_price, order_status) 
        VALUES ('$customer_name', '$item_name', $quantity, $total_price, '$order_status')";

if ($conn->query($sql) === TRUE) {
    echo "<div style='text-align: center; margin-top: 50px; font-family: Arial, sans-serif; color: #333;'>";
    echo "<h1 style='font-size: 2.5em; color: #4CAF50; margin-bottom: 20px;'>Pesanan berhasil dibuat!</h1>";
    echo "<a href='orders.php' style='display: inline-block; font-size: 1.2em; color: #ffffff; background-color: #007BFF; text-decoration: none; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s ease;'>Lihat Daftar Pesanan</a>";
    echo "</div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); 
?>
<link rel="stylesheet" href="style.css">