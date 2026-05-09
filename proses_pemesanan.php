<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

$username = $_SESSION['username'];

$asal = $_POST['asal'];
$tujuan = $_POST['tujuan'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$kelas = $_POST['kelas'];
$jarak = $_POST['jarak'];

$nama = $_POST['nama'];
$email = $_POST['email'];

$gerbong = $_POST['gerbong'];
$penumpang = $_POST['penumpang'];
$kursi = $_POST['kursi'];

$metode_pembayaran = $_POST['metode_pembayaran'];
$harga_per_orang = $_POST['harga_satuan'];

$jumlah = count($penumpang);
$total_harga = $jumlah * $harga_per_orang;

mysqli_query($conn, "INSERT INTO pemesanan 
(username, asal, tujuan, tanggal, jam, kelas, jumlah, jarak, harga_per_orang, total_harga, metode_pembayaran, nama_pemesan, email, status_pembayaran, status_tiket)
VALUES 
('$username','$asal','$tujuan','$tanggal','$jam','$kelas','$jumlah','$jarak','$harga_per_orang','$total_harga','$metode_pembayaran','$nama','$email','Belum Bayar','Menunggu Konfirmasi')");

$id = mysqli_insert_id($conn);

foreach ($penumpang as $i => $p) {
    $k = $kursi[$i];

    mysqli_query($conn, "INSERT INTO penumpang 
    (id_pemesanan, nama_penumpang, kursi, gerbong)
    VALUES 
    ('$id','$p','$k','$gerbong')");
}

header("location:tiket.php?id=$id");
exit;
?>