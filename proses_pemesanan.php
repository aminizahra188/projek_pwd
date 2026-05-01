<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

include 'koneksi.php';

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
(asal, tujuan, tanggal, jam, kelas, jumlah, jarak, harga_per_orang, total_harga, metode_pembayaran, nama_pemesan, email)
VALUES 
('$asal','$tujuan','$tanggal','$jam','$kelas','$jumlah','$jarak','$harga_per_orang','$total_harga','$metode_pembayaran','$nama','$email')");

$id = mysqli_insert_id($conn);

foreach ($penumpang as $i => $p) {
    $k = $kursi[$i];

    mysqli_query($conn, "INSERT INTO penumpang 
    (id_pemesanan, nama_penumpang, kursi, gerbong)
    VALUES 
    ('$id','$p','$k','$gerbong')");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Anda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=20">
</head>
<body>

<div class="container py-5">

    <div class="ticket">

        <div class="header d-flex justify-content-between">
            <h4>Tiket Kereta</h4>
            <div class="badge-id">ID: <?= $id ?></div>
        </div>

        <h5>Detail Perjalanan</h5>
        <p><strong><?= $asal ?> → <?= $tujuan ?></strong></p>
        <p><?= $tanggal ?> | <?= $jam ?></p>
        <p>Kelas: <strong><?= ucfirst($kelas) ?></strong></p>
        <p>Jarak: <strong><?= $jarak ?> stasiun</strong></p>
        <p>Jumlah Tiket / Kursi: <strong><?= $jumlah ?></strong></p>

        <hr>

        <h5>Data Pemesan</h5>
        <p><?= $nama ?> (<?= $email ?>)</p>

        <hr>

        <h5>Pembayaran</h5>
        <p>Metode: <strong><?= $metode_pembayaran ?></strong></p>
        <p>Harga per Tiket: Rp <?= number_format($harga_per_orang, 0, ',', '.') ?></p>
        <p>Total Bayar: <strong>Rp <?= number_format($total_harga, 0, ',', '.') ?></strong></p>
        <a href="upload_bukti.php?id=<?= $id ?>" class="btn btn-warning">upload pembayaran</a>

        <hr>

        <h5>Penumpang</h5>
        <ul>
            <?php foreach ($penumpang as $i => $p) : ?>
                <li><?= $p ?> - <?= $gerbong ?> Kursi <?= $kursi[$i] ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-primary">Kembali ke Home</a>
        </div>

    </div>

</div>

</body>
</html>