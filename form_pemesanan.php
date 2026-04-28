<?php
session_start();

if ($_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

include 'koneksi.php';

// ambil data dari index
$asal = $_POST['asal'] ?? '';
$tujuan = $_POST['tujuan'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$jam = $_POST['jam'] ?? '';

// validasi akses
if (!$asal || !$tujuan || !$tanggal || !$jam) {
    echo "<script>alert('Akses tidak valid!'); window.location='index.php';</script>";
    exit;
}

// ambil kursi yang sudah dipesan
$kursi_terisi = [];

$query = mysqli_query($conn, "
    SELECT p.kursi FROM penumpang p
    JOIN pemesanan pm ON p.id_pemesanan = pm.id
    WHERE pm.tanggal='$tanggal' AND pm.jam='$jam'
");

while ($row = mysqli_fetch_assoc($query)) {
    $kursi_terisi[] = $row['kursi'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


</head>
<body>

<div class="container py-5">

    <div class="page-title">
        <h2>Form Pemesanan Tiket</h2>
    </div>

    <!-- DETAIL -->
    <div class="detail-card mb-4">
        <h4>Detail Perjalanan</h4>
        <div class="row g-3">

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Stasiun Asal</small>
                    <h6><?= $asal ?></h6>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Stasiun Tujuan</small>
                    <h6><?= $tujuan ?></h6>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Tanggal Berangkat</small>
                    <h6><?= $tanggal ?></h6>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Jam Keberangkatan</small>
                    <h6><?= $jam ?></h6>
                </div>
            </div>

        </div>
    </div>

    <!-- FORM -->
    <div class="main-booking-card">
        <form id="bookingForm" action="proses_pemesanan.php" method="POST">

            <!-- hidden -->
            <input type="hidden" name="asal" value="<?= $asal ?>">
            <input type="hidden" name="tujuan" value="<?= $tujuan ?>">
            <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
            <input type="hidden" name="jam" value="<?= $jam ?>">

            <h5>Data Pemesan</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>

            <h5>Jumlah Tiket</h5>
            <input type="number" id="jumlah" name="jumlah" class="form-control mb-3" min="1" max="5" required>

            <h5>Pilih Kursi</h5>
            <div id="kursiContainer" class="mb-4"></div>

            <h5>Data Penumpang</h5>
            <div id="penumpangContainer"></div>

            <button type="submit" class="booking-btn mt-4">
                Pesan Sekarang
            </button>

        </form>
    </div>

</div>

<!-- script-->
<script>
const kursiTerisi = <?= json_encode($kursi_terisi) ?>;

const jumlahInput = document.getElementById('jumlah');
const penumpangContainer = document.getElementById('penumpangContainer');
const kursiContainer = document.getElementById('kursiContainer');

const kursiList = ["A1","A2","A3","A4","B1","B2","B3","B4"];

let selectedKursi = [];

// tampilkan kursi
kursiList.forEach(k => {
    const div = document.createElement('div');
    div.classList.add('kursi');
    div.innerText = k;

    // kursi terisi
    if (kursiTerisi.includes(k)) {
        div.classList.add('terisi');
        kursiContainer.appendChild(div);
        return;
    }

    div.addEventListener('click', function() {
        let jumlah = parseInt(jumlahInput.value) || 0;

        if (jumlah === 0) {
            alert("Isi jumlah tiket dulu!");
            return;
        }

        if (selectedKursi.includes(k)) {
            selectedKursi = selectedKursi.filter(x => x !== k);
            div.classList.remove('selected');
        } else {
            if (selectedKursi.length >= jumlah) {
                alert("Jumlah kursi melebihi jumlah tiket!");
                return;
            }

            selectedKursi.push(k);
            div.classList.add('selected');
        }

        generatePenumpang();
    });

    kursiContainer.appendChild(div);
});

function generatePenumpang() {
    penumpangContainer.innerHTML = '';

    selectedKursi.forEach((k, i) => {
        penumpangContainer.innerHTML += `
            <div class="card p-3 mb-3">
                <label><strong>Penumpang ${i+1} - Kursi ${k}</strong></label>

                <input type="hidden" name="kursi[]" value="${k}">
                <input type="text" name="penumpang[]" class="form-control mt-2" placeholder="Nama penumpang" required>
            </div>
        `;
    });
}

const bookingForm = document.getElementById('bookingForm');

bookingForm.addEventListener('submit', function(e) {
    const jumlah = parseInt(jumlahInput.value) || 0;

    if (jumlah === 0) {
        e.preventDefault();
        alert("Isi jumlah tiket terlebih dahulu!");
        return;
    }

    if (selectedKursi.length !== jumlah) {
        e.preventDefault();
        alert("Jumlah kursi harus sesuai dengan jumlah tiket!");
        return;
    }

    if (selectedKursi.length === 0) {
        e.preventDefault();
        alert("Silakan pilih kursi terlebih dahulu!");
        return;
    }
});
</script>

</body>
</html>