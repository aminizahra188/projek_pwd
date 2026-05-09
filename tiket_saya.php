<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

$username = $_SESSION['username'];

$data = mysqli_query($conn, "
    SELECT * FROM pemesanan
    WHERE username='$username'
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Saya</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container py-5">

    <h2 class="fw-bold mb-4">Tiket Saya</h2>

    <?php if(mysqli_num_rows($data) == 0) : ?>

        <div class="alert alert-warning">
            Belum ada tiket untuk akun ini.
        </div>

    <?php endif; ?>

    <?php while($d = mysqli_fetch_assoc($data)) : ?>

        <div class="ticket-card">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h3 class="route-title mb-0">
                    <?= $d['asal']; ?> → <?= $d['tujuan']; ?>
                </h3>

                <span class="ticket-id">
                    ID #<?= $d['id']; ?>
                </span>

            </div>

            <div class="row">

                <div class="col-md-3 info-box">
                    <small>Nama Pemesan</small>
                    <h6><?= $d['nama_pemesan']; ?></h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Email</small>
                    <h6><?= $d['email']; ?></h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Tanggal</small>
                    <h6><?= $d['tanggal']; ?></h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Jam</small>
                    <h6><?= $d['jam']; ?></h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Kelas</small>
                    <h6><?= ucfirst($d['kelas']); ?></h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Jumlah Tiket</small>
                    <h6><?= $d['jumlah']; ?> Tiket</h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Harga per Orang</small>
                    <h6>
                        Rp <?= number_format($d['harga_per_orang'],0,',','.'); ?>
                    </h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Total Harga</small>
                    <h6>
                        Rp <?= number_format($d['total_harga'],0,',','.'); ?>
                    </h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Metode Pembayaran</small>
                    <h6><?= $d['metode_pembayaran']; ?></h6>
                </div>

                <div class="col-md-3 info-box">
                    <small>Status Pembayaran</small>

                    <?php if($d['status_pembayaran'] == 'Pembayaran Dikonfirmasi') : ?>

                        <h6>
                            <span class="badge bg-success">
                                Dikonfirmasi
                            </span>
                        </h6>

                    <?php else : ?>

                        <h6>
                            <span class="badge bg-warning text-dark">
                                Menunggu Konfirmasi
                            </span>
                        </h6>

                    <?php endif; ?>

                </div>

            </div>

            <div class="mt-4">

                <?php if($d['status_pembayaran'] == 'Pembayaran Dikonfirmasi') : ?>

                <?php else : ?>

                    <button class="btn btn-secondary" disabled>
                        Menunggu Konfirmasi Admin
                    </button>

                <?php endif; ?>

            </div>

        </div>

    <?php endwhile; ?>

    <a href="index.php" class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>

</body>
</html>