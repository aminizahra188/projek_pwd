<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM pemesanan ORDER BY id ASC");

if (!$data) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemesanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container py-5">
    <h2>Data Pemesanan</h2>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <tr>
                <th>ID</th>
                <th>Nama Pemesan</th>
                <th>Email</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>

            <?php if (mysqli_num_rows($data) == 0) : ?>
                <tr>
                    <td colspan="11" class="text-center">Belum ada data</td>
                </tr>
            <?php endif; ?>

            <?php while ($d = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $d['id']; ?></td>
                    <td><?= $d['nama_pemesan']; ?></td>
                    <td><?= $d['email']; ?></td>
                    <td><?= $d['asal']; ?></td>
                    <td><?= $d['tujuan']; ?></td>
                    <td><?= $d['tanggal']; ?></td>
                    <td><?= $d['jam']; ?></td>

                    <td>
                        Rp <?= number_format($d['total_harga'] ?? 0, 0, ',', '.'); ?>
                    </td>

                    <td>
                        <?php if (($d['status_pembayaran'] ?? '') == 'Pembayaran Dikonfirmasi') : ?>
                            <span class="badge bg-success">Dikonfirmasi</span>

                        <?php elseif (($d['status_pembayaran'] ?? '') == 'Menunggu Konfirmasi') : ?>
                            <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>

                        <?php else : ?>
                            <span class="badge bg-danger">Belum Bayar</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if (!empty($d['bukti_pembayaran'])) : ?>
                            <a href="uploads/<?= $d['bukti_pembayaran']; ?>" 
                               target="_blank" 
                               class="btn btn-info btn-sm">
                                Lihat
                            </a>
                        <?php else : ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="edit_pemesanan.php?id=<?= $d['id']; ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="hapus_pemesanan.php?id=<?= $d['id']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin mau hapus?')">
                            Hapus
                        </a>

                        <?php if (($d['status_pembayaran'] ?? '') == 'Menunggu Konfirmasi') : ?>
                            <a href="konfirmasi_pembayaran.php?id=<?= $d['id']; ?>" 
                               class="btn btn-success btn-sm mt-1"
                               onclick="return confirm('Konfirmasi pembayaran ini?')">
                                Konfirmasi
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
    </div>

    <a href="index.php" class="btn btn-secondary mt-2">Kembali</a>
</div>

</body>
</html>