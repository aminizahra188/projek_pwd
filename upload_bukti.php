<?php
include 'koneksi.php';

$id = $_GET['id'] ?? '';

if ($id == '') {
    echo "<script>alert('ID pemesanan tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Bukti Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container py-5">
    <div class="card p-4">
        <h3>Upload Bukti Pembayaran</h3>
        <p>ID Pemesanan: <strong><?= $id ?></strong></p>

        <form action="proses_upload_bukti.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">

    <input type="file" name="bukti" class="form-control" accept="image/*,.pdf" required>

    <button type="submit" class="btn btn-primary mt-3">
        Upload Bukti
    </button>
</form>
    </div>
</div>
</body>
</html>