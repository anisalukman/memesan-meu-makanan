<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Minuman</title>
    <link rel="stylesheet" href="style.css">
    <style>
        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        p {
            text-align: center;
            color: #FF4500;
            font-family: 'Georgia', serif;
            font-size: 28px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px #d3d3d3;
        }

        .menu-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px auto;
            padding: 0 20px;
            max-width: 1200px;
        }

        .menu-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .menu-item img {
            width: 100%;
            height: 180px;
            object-fit: cover; /* Menyamakan ukuran gambar tanpa distorsi */
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .menu-item h3 {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 5px;
        }

        .menu-item p {
            font-size: 1em;
            color: #555;
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            background-color: #f0f0f0;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .pagination a.active {
            background-color: #ff4500;
            color: #fff;
        }

        .pagination a:hover {
            background-color: #ff8c42;
            color: #fff;
        }
    </style>
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
    </header>
    <main>
        <section>
            <h2>Menu Minuman</h2>
            <p>Berbagai pilihan minuman tersedia untuk Anda.</p>
            <div class="menu-list">
                <?php
                // Koneksi ke database
                $conn = new mysqli('localhost', 'root', '', 'restaurant_db');

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Pagination settings
                $items_per_page = 5;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $items_per_page;

                // Ambil total item untuk pagination
                $total_items_query = "SELECT COUNT(*) as total FROM menu WHERE type = 'drink'";
                $total_items_result = $conn->query($total_items_query);
                $total_items = $total_items_result->fetch_assoc()['total'];
                $total_pages = ceil($total_items / $items_per_page);

                // Mengambil data menu minuman dari database
                $sql = "SELECT * FROM menu WHERE type = 'drink' LIMIT $offset, $items_per_page";
                $result = $conn->query($sql);

                // Memeriksa apakah ada data
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='menu-item'>
                                <img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>
                                <h3>" . $row['name'] . "</h3>
                                <p>" . $row['description'] . "</p>
                                <p class='price'>
                                    <span class='rp'>Rp</span>
                                    <span class='amount'>" . number_format($row['price'], 0, ',', '.') . "</span>
                                </p>
                              </div>";
                    }
                } else {
                    echo "<p>Tidak ada menu minuman.</p>";
                }

                // Tutup koneksi
                $conn->close();
                ?>
            </div>
            <!-- Pagination -->
            <div class="pagination">
                <?php
                $pagination_limit = 5;
                $start_page = max(1, $page - floor($pagination_limit / 2));
                $end_page = min($total_pages, $start_page + $pagination_limit - 1);

                if ($end_page - $start_page < $pagination_limit - 1) {
                    $start_page = max(1, $end_page - $pagination_limit + 1);
                }

                // Tombol "Previous"
                if ($page > 1) {
                    echo "<a href='menu-minuman.php?page=" . ($page - 1) . "'>Previous</a>";
                }

                for ($i = $start_page; $i <= $end_page; $i++) {
                    $active = ($i == $page) ? "class='active'" : "";
                    echo "<a href='menu-minuman.php?page=$i' $active>$i</a>";
                }

                // Tombol "Next"
                if ($page < $total_pages) {
                    echo "<a href='menu-minuman.php?page=" . ($page + 1) . "'>Next</a>";
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>
