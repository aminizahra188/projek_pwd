<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RailTicket - Pemesanan Tiket Kereta</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f8ff;
            color: #1f2937;
        }

        .navbar {
            background: white;
            box-shadow: 0 8px 30px rgba(0,0,0,0.04);
            padding: 16px 0;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 800;
            color: #0194f3 !important;
        }

        .nav-link {
            font-weight: 500;
            color: #374151 !important;
            margin-left: 12px;
        }

        .btn-login {
            border: 1px solid #0194f3;
            color: #0194f3;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .btn-register {
            background: #0194f3;
            color: white;
            border-radius: 50px;
            padding: 9px 22px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(1,148,243,0.18);
        }

        .hero {
            background: linear-gradient(135deg, #0194f3, #2bbcff);
            padding: 90px 0 170px;
            color: white;
        }

        .hero h1 {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.2;
        }

        .hero p {
            font-size: 18px;
            margin-top: 15px;
            max-width: 650px;
        }

        .booking-card {
            margin-top: -90px;
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            padding: 35px;
        }

        .booking-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            padding: 14px;
            border: 1px solid #dbe4f0;
        }

        .btn-search {
            background: #ff6d00;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 14px;
            font-weight: 700;
            width: 100%;
            margin-top: 18px;
        }

        .section-title {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 35px;
        }

        .schedule-card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .feature-card {
            background: white;
            border-radius: 22px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
        }

        .feature-card h4 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.7;
        }

        footer {
            background: #0f172a;
            color: white;
            padding: 30px 0;
            margin-top: 80px;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }

            .booking-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Triviliki</a>

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

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Pesan Tiket Kereta Simple, Mudah, dan Premium</h1>
            <p>
                Nikmatipengalaman booking tiket modern seperti platform tiket kereta profesional
                dengan proses sederhana dan jadwal tetap setiap hari.
            </p>
        </div>
    </section>

    <!-- Booking Card -->
    <div class="container">
        <div class="card booking-card">
            <div class="booking-title">Cari Tiket Kereta</div>

            <form>
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" id="stasiunAsal">
                            <option selected disabled>Pilih Stasiun Asal</option>
                            <option value="Stasiun 1">Stasiun 1</option>
                            <option value="Stasiun 2">Stasiun 2</option>
                            <option value="Stasiun 3">Stasiun 3</option>
                            <option value="Stasiun 4">Stasiun 4</option>
                            <option value="Stasiun 5">Stasiun 5</option>
                            <option value="Stasiun 6">Stasiun 6</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" id="stasiunTujuan">
                            <option selected disabled>Pilih Stasiun Tujuan</option>
                            <option value="Stasiun 1">Stasiun 1</option>
                            <option value="Stasiun 2">Stasiun 2</option>
                            <option value="Stasiun 3">Stasiun 3</option>
                            <option value="Stasiun 4">Stasiun 4</option>
                            <option value="Stasiun 5">Stasiun 5</option>
                            <option value="Stasiun 6">Stasiun 6</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <select class="form-select">
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

                <a href="form_pemesanan.php" class="btn btn-search">Cari Tiket Sekarang</a> <!-- geser ke halaman form_pemesanan.php -->
            </form>
        </div>
    </div>

    <!-- Jadwal -->
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

    <!-- Features -->
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

    <!-- Footer -->
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
