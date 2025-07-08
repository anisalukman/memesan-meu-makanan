<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-image: url('images/background2.jpg'); /* Ganti dengan jalur gambar Anda */
    background-size: cover; /* Agar gambar menyesuaikan layar */
    background-repeat: no-repeat; /* Mencegah pengulangan gambar */
    background-position: center; /* Memusatkan gambar */
    color: #333;
    margin: 0;
    padding: 0;
}
        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        header nav ul {
            list-style: none;
            padding: 0;
        }
        header nav ul li {
            display: inline;
            margin: 0 10px;
        }
        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        main {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Serenity Café </h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu-makanan.php">Menu Makanan</a></li>
                <li><a href="menu-minuman.php">Menu Minuman</a></li>
                <li><a href="orders.php">Daftar Pesanan</a></li>
                <li><a href="order_form.php">silahkan pesan di sini</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Daftar Pesanan</h2>
                <?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'restaurant_db');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel 'orders'
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Nama Item</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status Pesanan</th>
                <th>Tanggal Pesanan</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['order_id']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['item_name']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['total_price']}</td>
                <td>{$row['order_status']}</td>
                <td>{$row['order_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Belum ada pesanan.";
}

$conn->close();
?>