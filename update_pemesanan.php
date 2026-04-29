<?php
include 'koneksi.php';

$id = $_POST['id'];
$asal = $_POST['asal'];
$tujuan = $_POST['tujuan'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];

mysqli_query($conn, "
    UPDATE pemesanan SET
    asal='$asal',
    tujuan='$tujuan',
    tanggal='$tanggal',
    jam='$jam'
    WHERE id='$id'
");

header("location:data_pemesanan.php");
?>