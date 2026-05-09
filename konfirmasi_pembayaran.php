<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:login.php");
    exit;
}

$id = $_GET['id'] ?? '';

if ($id == '') {
    echo "<script>alert('ID tidak ditemukan!'); window.location='data_pemesanan.php';</script>";
    exit;
}

$query = mysqli_query($conn, "
    UPDATE pemesanan 
    SET 
        status_pembayaran='Pembayaran Dikonfirmasi',
        status_tiket='Terkonfirmasi'
    WHERE id='$id'
");

if ($query) {
    echo "
    <script>
        alert('Pembayaran berhasil dikonfirmasi!');
        window.location='data_pemesanan.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Gagal konfirmasi: <?= mysqli_error($conn) ?>');
        window.location='data_pemesanan.php';
    </script>
    ";
}
?>