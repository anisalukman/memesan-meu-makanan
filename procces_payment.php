<?php
include 'connection.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = "UPDATE orders SET order_status = 'completed' WHERE order_id = $order_id";
    if ($conn->query($sql) === TRUE) {
        echo "Pesanan telah diselesaikan.";
    } else {
        echo "Gagal menyelesaikan pesanan: " . $conn->error;
    }
}
?>
<a href="order_list.php">Kembali ke Daftar Pesanan</a>
