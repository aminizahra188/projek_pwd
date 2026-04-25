<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rail Ticket - Pemesanan Tiket Kereta</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <!-- navbar -->
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
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="login.php" class="btn btn-login">Login</a> <!-- button ke halaman login - login.php? (blm tau pake ap gk) -->
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="register.php" class="btn btn-register">Register</a> <!-- button ke halaman regist - register.php? (blm tau jg pake ap gk) -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- hero -->
    <section class="hero">
        <div class="container">
            <h1>Pesan Tiket Kereta Simple, Mudah, dan Premium</h1>
            <p>
                Nikmati pengalaman booking tiket modern seperti platform tiket kereta profesional
                dengan proses sederhana dan jadwal tetap setiap hari.
            </p>
        </div>
    </section>

    <!-- booking card -->
    <div class="container">
        <div class="card booking-card">
            <div class="booking-title">Cari Tiket Kereta</div>

            <form action="form_pemesanan.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" id="stasiunAsal" name="asal">
                            <option selected disabled>Pilih Stasiun Asal</option>
                            <option value="Stasiun 1">Jakarta</option>
                            <option value="Stasiun 2">Bandung</option>
                            <option value="Stasiun 3">Semarang</option>
                            <option value="Stasiun 4">Yogyakarta</option>
                            <option value="Stasiun 5">Surabaya</option>
                            <option value="Stasiun 6">Malang</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" id="stasiunTujuan" name="tujuan">
                            <option selected disabled>Pilih Stasiun Tujuan</option>
                            <option value="Stasiun 1">Jakarta</option>
                            <option value="Stasiun 2">Bandung</option>
                            <option value="Stasiun 3">Semarang</option>
                            <option value="Stasiun 4">Surabaya</option>
                            <option value="Stasiun 5">Yogyakarta</option>
                            <option value="Stasiun 6">Malang</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="date" class="form-control" name="tanggal">
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="jam">
                            <option selected>Pilih Jam</option>
                            <option>05:00</option>
                            <option>07:00</option>
                            <option>09:00</option>
                            <option>12:00</option>
                            <option>15:00</option>
                            <option>18:00</option>
                            <option>20:00</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-search">Cari Tiket Sekarang</button> <!-- geser ke halaman form_pemesanan.php -->
            </form>
        </div>
    </div>

    <!-- jadwal -->
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

    <!-- fitur -->
    <section class="py-5" id="fitur">
        <div class="container">
            <h2 class="section-title text-center">Kenapa Pilih Triviliki?</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <h4>Fitur 1</h4>
                        <p>blablabla apa kek ntr tinggal di isi</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <h4>Fitur 2</h4>
                        <p>ini jg sama aja</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <h4>Fitur 3</h4>
                        <p>sama jg.....</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-0">tiket.... -Project PWD Pemesanan Tiket Kereta</p>
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
