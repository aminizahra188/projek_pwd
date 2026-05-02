<?php
include 'koneksi.php';

if ($_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

$id = $_GET['id'];

// ambil data berdasarkan id
$data = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id='$id'");
$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2>Edit Pemesanan</h2>

    <form action="update_pemesanan.php" method="POST">
        <input type="hidden" name="id" value="<?= $d['id'] ?>">

        <div class="mb-3">
            <label>Asal</label>
            <input type="text" name="asal" class="form-control" value="<?= $d['asal'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="<?= $d['tujuan'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= $d['tanggal'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Jam</label>
            <input type="text" name="jam" class="form-control" value="<?= $d['jam'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="data_pemesanan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>