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
    <link rel="stylesheet" href="css/style.css?v=700">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top custom-navbar">
    <div class="container">
        <a class="navbar-brand brand-logo" href="#">🚆 Matrain</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#jadwal">Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="tiket_saya.php">Tiket Saya</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="data_pemesanan.php">Data Pemesanan</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['username'])) : ?>
                    <li class="nav-item ms-lg-3">
                        <span class="nav-link">Halo, <?= $_SESSION['username']; ?></span>
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

<section class="hero-full">
    <div class="hero-overlay"></div>

    <div class="container hero-content-full">
        <span class="hero-badge">🚆 Perjalanan nyaman, sampai tujuan aman</span>

        <h1>
            Pesan Tiket Kereta
            <span>Simple, Mudah & Premium</span>
        </h1>

        <p>
            Nikmati pengalaman booking tiket kereta modern dengan proses cepat,
            jadwal tetap setiap hari, dan pilihan kursi sesuai keinginan.
        </p>

        <div class="hero-info">
            <div>
                <strong>7+</strong>
                <small>Jadwal Harian</small>
            </div>

            <div>
                <strong>6</strong>
                <small>Rute Stasiun</small>
            </div>

            <div>
                <strong>24/7</strong>
                <small>Layanan Online</small>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="booking-card-new">
        <div class="booking-title-new">Cari Tiket Kereta</div>

        <form action="form_pemesanan.php" method="POST">
            <div class="row g-3 align-items-end">

                <div class="col-lg-3 col-md-6">
                    <label>Stasiun Asal</label>
                    <select name="asal" id="stasiunAsal" class="form-select" required>
                        <option value="" disabled selected>Pilih stasiun asal</option>
                        <?php foreach ($stasiun as $s) : ?>
                            <option value="<?= $s ?>"><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-lg-3 col-md-6">
                    <label>Stasiun Tujuan</label>
                    <select name="tujuan" id="stasiunTujuan" class="form-select" required>
                        <option value="" disabled selected>Pilih stasiun tujuan</option>
                        <?php foreach ($stasiun as $s) : ?>
                            <option value="<?= $s ?>"><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>

                <div class="col-lg-2 col-md-6">
                    <label>Kelas</label>
                    <select name="kelas" class="form-select" required>
                        <option value="" disabled selected>Pilih kelas</option>
                        <option value="ekonomi">Ekonomi</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <label>Jam</label>
                    <select class="form-select" name="jam" required>
                        <option value="" disabled selected>Pilih jam</option>
                        <?php foreach ($jamList as $jam) : ?>
                            <option value="<?= $jam ?>"><?= $jam ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-search-new">
                Cari Tiket Sekarang
            </button>
        </form>
    </div>
</div>

<section class="section-soft" id="jadwal">
    <div class="container text-center">
        <span class="section-label">Jadwal</span>
        <h2 class="section-title">Jadwal Kereta Tetap Setiap Hari</h2>

        <div class="row g-4">
            <?php foreach ($jamList as $jam) : ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="schedule-card-new">
                        <?= $jam ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-soft pt-0" id="fitur">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Fitur</span>
            <h2 class="section-title">Kenapa Pilih Matrain?</h2>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card-new">
                    <img src="assets/rute.jpg" class="fitur-img-full" alt="Rute Kereta">

                    <div class="feature-content">
                        <h4>Banyak Pilihan Rute</h4>
                        <p>
                            Pengguna dapat memilih stasiun asal dan tujuan sesuai kebutuhan perjalanan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card-new">
                    <img src="assets/kursi.jpg" class="fitur-img-full" alt="Pilih Kursi">

                    <div class="feature-content">
                        <h4>Pilih Kursi & Gerbong</h4>
                        <p>
                            Penumpang dapat memilih kursi dan gerbong sesuai jumlah tiket yang dipesan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card-new">
                    <img src="assets/etiket.jpg" class="fitur-img-full" alt="E-Tiket">

                    <div class="feature-content">
                        <h4>E-Tiket Praktis</h4>
                        <p>
                            Nikmati pengalaman perjalanan modern dengan tiket digital yang praktis dan efisien.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer-new">
    <div class="container text-center">
        <p class="mb-0">Matrain - Pemesanan Tiket Kereta</p>
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