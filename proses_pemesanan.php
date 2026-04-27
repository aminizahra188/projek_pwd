<?php
include 'koneksi.php';

$asal = $_POST['asal'];
$tujuan = $_POST['tujuan'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$penumpang = $_POST['penumpang'];
$kursi = $_POST['kursi'];

mysqli_query($conn, "INSERT INTO pemesanan (asal, tujuan, tanggal, jam, nama_pemesan, email)
VALUES ('$asal','$tujuan','$tanggal','$jam','$nama','$email')");

$id = mysqli_insert_id($conn);

// simpan penumpang
foreach ($penumpang as $i => $p) {
    $k = $kursi[$i];
    mysqli_query($conn, "INSERT INTO penumpang (id_pemesanan, nama_penumpang, kursi)
    VALUES ('$id','$p','$k')");
}
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
            <div class="badge-id">ID: <?= $id ?></div>
        </div>

        <h5>Detail Perjalanan</h5>
        <p><strong><?= $asal ?> → <?= $tujuan ?></strong></p>
        <p><?= $tanggal ?> | <?= $jam ?></p>

        <hr>

        <h5>Data Pemesan</h5>
        <p><?= $nama ?> (<?= $email ?>)</p>

        <hr>

        <h5>Penumpang</h5>
        <ul>
            <?php foreach ($penumpang as $i => $p) : ?>
                <li><?= $p ?> - Kursi <?= $kursi[$i] ?></li>
            <?php endforeach; ?>
        </ul>

        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-primary">Kembali ke Home</a>
        </div>

    </div>

</div>

</body>
</html>