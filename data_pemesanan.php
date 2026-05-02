<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] != "admin") {
    header("location:login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM pemesanan ORDER BY id ASC");

if (!$data) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container py-5">
    <h2>Data Pemesanan</h2>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nama Pemesan</th>
            <th>Email</th>
            <th>Asal</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>

        <?php if(mysqli_num_rows($data) == 0) : ?>
            <tr>
                <td colspan="8" class="text-center">Belum ada data</td>
            </tr>
        <?php endif; ?>

        <?php while($d = mysqli_fetch_assoc($data)) : ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['nama_pemesan'] ?></td>
            <td><?= $d['email'] ?></td>
            <td><?= $d['asal'] ?></td>
            <td><?= $d['tujuan'] ?></td>
            <td><?= $d['tanggal'] ?></td>
            <td><?= $d['jam'] ?></td>
            <td>
                <a href="edit_pemesanan.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus_pemesanan.php?id=<?= $d['id'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin mau hapus?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
    </table>

    <a href="index.php" class="btn btn-secondary mt-0">Kembali</a>
</div>

</body>
</html>