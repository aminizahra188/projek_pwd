<?php
session_start();
include 'koneksi.php';

if ($_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

$id = $_GET['id'];

$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pemesanan WHERE id='$id'"));

$penumpang = mysqli_query($conn, "SELECT * FROM penumpang WHERE id_pemesanan='$id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tiket Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container py-5">

    <div class="ticket">

        <div class="header d-flex justify-content-between">
            <h4>Tiket Kereta</h4>
            <div class="badge-id">ID: <?= $p['id'] ?></div>
        </div>

        <h5>Detail Perjalanan</h5>
        <p><strong><?= $p['asal'] ?> → <?= $p['tujuan'] ?></strong></p>
        <p><?= $p['tanggal'] ?> | <?= $p['jam'] ?></p>
        <p>Kelas: <strong><?= ucfirst($p['kelas']) ?></strong></p>
        <p>Jumlah Tiket: <strong><?= $p['jumlah'] ?></strong></p>

        <hr>

        <h5>Data Pemesan</h5>
        <p><?= $p['nama_pemesan'] ?> (<?= $p['email'] ?>)</p>

        <hr>

        <h5>Pembayaran</h5>
        <p>Metode: <strong><?= $p['metode_pembayaran'] ?></strong></p>
        <p>Total Bayar: <strong>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></strong></p>

        <a href="upload_bukti.php?id=<?= $p['id'] ?>" class="btn btn-warning">
            Upload Bukti
        </a>

        <hr>

        <h5>Penumpang</h5>
        <ul>
            <?php while($row = mysqli_fetch_assoc($penumpang)) : ?>
                <li><?= $row['nama_penumpang'] ?> - <?= $row['gerbong'] ?> <?= $row['kursi'] ?></li>
            <?php endwhile; ?>
        </ul>

        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-primary">Kembali ke Home</a>
        </div>

    </div>

</div>

</body>
</html>