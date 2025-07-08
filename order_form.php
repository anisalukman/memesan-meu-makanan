<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root","", "restaurant_db");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data item dan harga
$query = "SELECT name, price FROM menu"; // Ubah 'harga' menjadi 'price'
$result = $conn->query($query);

$hargaItems = [];
while ($row = $result->fetch_assoc()) {
    $hargaItems[$row['name']] = $row['price']; // Ubah 'harga' menjadi 'price'
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
    <style>
        /* CSS untuk header "Serenity Café" */
        h1 {
            text-align: center;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
        }

        /* CSS untuk tulisan "Form Pemesanan Makanan" */
        .form-title {
            text-align: center;
            color: #000000;
            font-family: 'Georgia', serif;
            font-size: 28px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px #d3d3d3;
        }

        /* Memastikan form ada di tengah */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            width: 50%;
            border: 2px solid #add8e6;
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
        }

        form label {
            text-align: center;
            font-family: 'Georgia', serif;
            font-size: 18px;
            color: #333333;
            text-shadow: 1px 1px 2px #add8e6;
        }
    </style>
    <script>
        // Data harga dari PHP
        const hargaItem = <?php echo json_encode($hargaItems); ?>;

        function hitungTotal() {
            const namaItem = document.getElementById("item_name").value;
            const jumlah = parseInt(document.getElementById("quantity").value) || 0;
            const totalHarga = hargaItem[namaItem] * jumlah;

            document.getElementById("total_price").value = totalHarga || 0;
        }
    </script>
</head>
<body>
<header>
    <h1>Serenity Café</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="menu-makanan.php">Menu Makanan</a></li>
            <li><a href="menu-minuman.php">Menu Minuman</a></li>
            <li><a href="orders.php">Daftar Pesanan</a></li>
            <li><a href="order_form.php">Silahkan Pesan di Sini</a></li>
        </ul>
    </nav>
    <link rel="stylesheet" href="form.css">
</header>
                 
<form action="process_order.php" method="POST">
    <label for="customer_name">Nama Pelanggan:</label>
    <input type="text" id="customer_name" name="customer_name" required>
    <br><br>
    
    <label for="item_name">Nama Item:</label>
    <select id="item_name" name="item_name" onchange="hitungTotal()" required>
        <option value="">-- Pilih Item --</option>
        <?php
        foreach ($hargaItems as $nama => $harga) {
            echo "<option value=\"$nama\">$nama</option>";
        }
        ?>
    </select>
    <br><br>
    
    <label for="quantity">Jumlah:</label>
    <input type="number" id="quantity" name="quantity" min="1" oninput="hitungTotal()" required>
    <br><br>
    
    <label for="total_price">Total Harga:</label>
    <input type="number" id="total_price" name="total_price" readonly>
    <br><br>
    
    <button type="submit">Pesan</button>
</form>
</body>
</html>