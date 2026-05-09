<?php
session_start();
include 'koneksi.php';

if ($_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "
    DELETE FROM penumpang
    WHERE id_pemesanan = '$id'
");

$query = mysqli_query($conn, "
    DELETE FROM pemesanan
    WHERE id = '$id'
");

if ($query) {
    echo "
    <script>
        alert('Data berhasil dihapus!');
        window.location='data_pemesanan.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Gagal menghapus data!');
        window.location='data_pemesanan.php';
    </script>
    ";
}
?>