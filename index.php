<?php
session_start();

$stasiun = ["Jakarta", "Bandung", "Cirebon", "Semarang", "Yogyakarta", "Surabaya"];
$jamList = ["05:00", "07:00", "09:00", "12:00", "15:00", "18:00", "20:00"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Kereta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Matrain</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#jadwal">Jadwal</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#fitur">Fitur</a>
                </li>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="data_pemesanan.php">Data Pemesanan</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['username'])) : ?>
                    <li class="nav-item ms-lg-3">
                        <span class="nav-link">
                            Halo, <?= $_SESSION['username']; ?>
                        </span>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a href="logout.php" class="btn btn-danger rounded-pill px-4">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="login.php" class="btn btn-login">Login</a>
                    </li>

                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="register.php" class="btn btn-register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <h1>Pesan Tiket Kereta Simple, Mudah, dan Premium</h1>
        <p>
            Nikmati pengalaman booking tiket modern seperti platform tiket kereta profesional
            dengan proses sederhana dan jadwal tetap setiap hari.
        </p>
    </div>
</section>

<div class="container">
    <div class="card booking-card">
        <div class="booking-title">Pesan Tiket Kereta</div>

        <form action="form_pemesanan.php" method="POST">
            <div class="row g-3">

                <div class="col-md-3">
                    <select name="asal" id="stasiunAsal" class="form-select" required>
                        <option value="" disabled selected>Pilih Stasiun Asal</option>
                        <?php foreach ($stasiun as $s) : ?>
                            <option value="<?= $s ?>"><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="tujuan" id="stasiunTujuan" class="form-select" required>
                        <option value="" disabled selected>Pilih Stasiun Tujuan</option>
                        <?php foreach ($stasiun as $s) : ?>
                            <option value="<?= $s ?>"><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="date" class="form-control" name="tanggal" required>
                </div>

                <div class="col-md-2">
                    <select name="kelas" class="form-select" required>
                        <option value="" disabled selected>Kelas</option>
                        <option value="ekonomi">Ekonomi</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select class="form-select" name="jam" required>
                        <option value="" disabled selected>Pilih Jam</option>
                        <?php foreach ($jamList as $jam) : ?>
                            <option value="<?= $jam ?>"><?= $jam ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-search">Cari Tiket Sekarang</button>
        </form>
    </div>
</div>

<section class="py-5" id="jadwal">
    <div class="container text-center">
        <h2 class="section-title">Jadwal Kereta Tetap Setiap Hari</h2>

        <div class="row g-4">
            <div class="col-md-3 col-6"><div class="schedule-card">05:00</div></div>
            <div class="col-md-3 col-6"><div class="schedule-card">07:00</div></div>
            <div class="col-md-3 col-6"><div class="schedule-card">09:00</div></div>
            <div class="col-md-3 col-6"><div class="schedule-card">12:00</div></div>
            <div class="col-md-3 col-6"><div class="schedule-card">15:00</div></div>
            <div class="col-md-3 col-6"><div class="schedule-card">18:00</div></div>
            <div class="col-md-3 col-6"><div class="schedule-card">20:00</div></div>
        </div>
    </div>
</section>

<section class="py-5" id="fitur">
    <div class="container">
        <h2 class="section-title text-center">Kenapa Pilih Matrain?</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Harga Sesuai Rute</h4>
                    <p>Harga tiket dihitung otomatis berdasarkan jarak antar stasiun.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Pilih Kursi</h4>
                    <p>Penumpang bisa memilih kursi sesuai jumlah tiket yang dipesan.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Pembayaran Mudah</h4>
                    <p>Tersedia metode pembayaran Transfer Bank, QRIS, E-Wallet, dan Bayar di Loket.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container-fluid text-center">
        <p class="mb-0">Matrain - Project PWD Pemesanan Tiket Kereta</p>
    </div>
</footer>

<script>
const stasiunAsal = document.getElementById('stasiunAsal');
const stasiunTujuan = document.getElementById('stasiunTujuan');

function updateStasiunOptions() {
    const asalValue = stasiunAsal.value;
    const tujuanValue = stasiunTujuan.value;

    Array.from(stasiunAsal.options).forEach(option => {
        option.disabled = false;
        if (option.value && option.value === tujuanValue) {
            option.disabled = true;
        }
    });

    Array.from(stasiunTujuan.options).forEach(option => {
        option.disabled = false;
        if (option.value && option.value === asalValue) {
            option.disabled = true;
        }
    });
}

stasiunAsal.addEventListener('change', updateStasiunOptions);
stasiunTujuan.addEventListener('change', updateStasiunOptions);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>