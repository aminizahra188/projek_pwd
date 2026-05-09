<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

include 'koneksi.php';

$asal = $_POST['asal'] ?? '';
$tujuan = $_POST['tujuan'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$jam = $_POST['jam'] ?? '';
$kelas = $_POST['kelas'] ?? '';

$stasiunList = ["Jakarta", "Bandung", "Cirebon", "Semarang", "Yogyakarta", "Surabaya"];

$indexAsal = array_search($asal, $stasiunList);
$indexTujuan = array_search($tujuan, $stasiunList);

if (!$asal || !$tujuan || !$tanggal || !$jam || !$kelas || $indexAsal === false || $indexTujuan === false || $indexAsal == $indexTujuan) {
    echo "<script>alert('Rute tidak valid!'); window.location='index.php';</script>";
    exit;
}

$jarak = abs($indexTujuan - $indexAsal);
$hargaPerSegmen = 50000;
$hargaDasar = $jarak * $hargaPerSegmen;

if ($kelas == "ekonomi") {
    $hargaSatuan = $hargaDasar;
} elseif ($kelas == "vip") {
    $hargaSatuan = $hargaDasar * 1.5;
} else {
    echo "<script>alert('Kelas tidak valid!'); window.location='index.php';</script>";
    exit;
}

$hargaSatuan = (int) $hargaSatuan;

$kursi_terisi = [];

$query = mysqli_query($conn, "
    SELECT p.kursi, p.gerbong FROM penumpang p
    JOIN pemesanan pm ON p.id_pemesanan = pm.id
    WHERE pm.tanggal='$tanggal'
    AND pm.jam='$jam'
    AND pm.kelas='$kelas'
");

while ($row = mysqli_fetch_assoc($query)) {
    $kursi_terisi[] = $row['gerbong'] . '-' . $row['kursi'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form_pemesanan.css?v=999">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
body {
    background: linear-gradient(135deg, #eef6ff, #f8fbff);
    font-family: 'Poppins', sans-serif;
    color: #0f172a;
}

.container {
    max-width: 1180px;
}

.page-title h2 {
    font-weight: 800;
    font-size: 42px;
    margin-bottom: 28px;
}

.detail-card,
.main-booking-card {
    background: #ffffff;
    border-radius: 28px;
    padding: 35px;
    box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
    margin-bottom: 30px;
}

.detail-card h4,
.main-booking-card h5 {
    font-weight: 800;
    margin-bottom: 22px;
}

.summary-box {
    background: #f8fbff;
    border: 1px solid #dbeafe;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
}

.summary-box small {
    color: #64748b;
    font-weight: 500;
}

.summary-box h6 {
    margin-top: 8px;
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
}

label {
    font-weight: 600;
    margin-bottom: 7px;
}

.form-control,
.form-select {
    height: 56px;
    border-radius: 16px;
    border: 1px solid #dbe4f0;
    padding: 12px 16px;
    font-weight: 500;
}

.form-control:focus,
.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.12);
}

.alert-info {
    background: #e8f7ff;
    border: 1px solid #bdeaff;
    border-radius: 18px;
    padding: 22px;
    font-size: 17px;
}

#kursiContainer {
    width: fit-content;
    margin: 20px 0 30px 0;
    padding: 30px;
    background: #f8fafc;
    border-radius: 22px;
    box-shadow: inset 0 0 0 1px #e5e7eb;
}

.train-seat-map {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.train-seat-row {
    display: flex;
    align-items: center;
    gap: 14px;
}

.train-seat-btn {
    width: 70px;
    height: 55px;
    border: none;
    border-radius: 14px;
    background: #e5e7eb;
    color: #111827;
    font-size: 20px;
    font-weight: 800;
    cursor: pointer;
    transition: 0.2s;
}

.train-seat-btn:hover {
    background: #d1d5db;
    transform: translateY(-2px);
}

.train-seat-btn.selected {
    background: #198754;
    color: white;
}

.train-seat-btn.terisi {
    background: #dc3545;
    color: white;
    cursor: not-allowed;
}

.train-seat-aisle {
    width: 90px;
    height: 55px;
}

#penumpangContainer .card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
}

.booking-btn {
    background: linear-gradient(135deg, #ff7a00, #ff5200);
    color: white;
    border: none;
    width: 100%;
    padding: 16px;
    border-radius: 18px;
    font-weight: 800;
    font-size: 17px;
    box-shadow: 0 15px 35px rgba(255, 109, 0, 0.28);
}

.booking-btn:hover {
    background: linear-gradient(135deg, #ff6500, #e84c00);
}

@media (max-width: 768px) {
    .page-title h2 {
        font-size: 32px;
    }

    .detail-card,
    .main-booking-card {
        padding: 24px;
    }

    #kursiContainer {
        width: 100%;
        overflow-x: auto;
    }
}
</style>
</head>
<body>

<div class="container py-5">

    <div class="page-title mb-4">
        <h2>Form Pemesanan Tiket</h2>
    </div>

    <div class="detail-card mb-4">
        <h4>Detail Perjalanan</h4>

        <div class="row g-3 mt-2">
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
                    <small>Tanggal</small>
                    <h6><?= $tanggal ?></h6>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Jam</small>
                    <h6><?= $jam ?></h6>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Kelas</small>
                    <h6><?= ucfirst($kelas) ?></h6>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Jarak</small>
                    <h6><?= $jarak ?> stasiun</h6>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <small>Harga per Tiket</small>
                    <h6>Rp <?= number_format($hargaSatuan, 0, ',', '.') ?></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="main-booking-card">
        <form id="bookingForm" action="proses_pemesanan.php" method="POST">

            <input type="hidden" name="asal" value="<?= $asal ?>">
            <input type="hidden" name="tujuan" value="<?= $tujuan ?>">
            <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
            <input type="hidden" name="jam" value="<?= $jam ?>">
            <input type="hidden" name="kelas" value="<?= $kelas ?>">
            <input type="hidden" name="jarak" value="<?= $jarak ?>">
            <input type="hidden" name="harga_satuan" id="hargaSatuan" value="<?= $hargaSatuan ?>">

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

            <h5>Jumlah Tiket / Kursi</h5>
            <input type="number" id="jumlah" name="jumlah" class="form-control mb-3" min="1" max="10" required>

            <h5>Pilih Gerbong</h5>
            <select id="gerbong" name="gerbong" class="form-control mb-3" required>
                <option value="" disabled selected>Pilih Gerbong</option>
                <?php for ($i = 1; $i <= 16; $i++) : ?>
                    <option value="Gerbong <?= $i ?>">Gerbong <?= $i ?></option>
                <?php endfor; ?>
            </select>

            <div class="alert alert-info">
                <p class="mb-1">
                    Harga per tiket:
                    <strong>Rp <?= number_format($hargaSatuan, 0, ',', '.') ?></strong>
                </p>
                <p class="mb-0">
                    Total harga:
                    <strong id="totalHarga">Rp 0</strong>
                </p>
            </div>

            <h5>Metode Pembayaran</h5>
            <select name="metode_pembayaran" class="form-control mb-3" required>
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="QRIS">QRIS</option>
                <option value="E-Wallet">E-Wallet</option>
                <option value="Bayar di Loket">Bayar di Loket</option>
            </select>

            <h5>Pilih Kursi</h5>
            <div id="kursiContainer"></div>

            <h5>Data Penumpang</h5>
            <div id="penumpangContainer"></div>

            <button type="submit" class="booking-btn mt-4">
                Pesan Sekarang
            </button>

        </form>
    </div>

</div>

<script>
const kursiTerisi = <?= json_encode($kursi_terisi) ?>;

const jumlahInput = document.getElementById('jumlah');
const gerbongInput = document.getElementById('gerbong');
const penumpangContainer = document.getElementById('penumpangContainer');
const kursiContainer = document.getElementById('kursiContainer');
const hargaSatuan = parseInt(document.getElementById('hargaSatuan').value);
const totalHargaText = document.getElementById('totalHarga');

const kursiRows = [
    ["A1","A2","A3","A4"],
    ["B1","B2","B3","B4"],
    ["C1","C2","C3","C4"],
    ["D1","D2","D3","D4"],
    ["E1","E2","E3","E4"],
    ["F1","F2","F3","F4"],
    ["G1","G2","G3","G4"],
    ["H1","H2","H3","H4"],
    ["I1","I2","I3","I4"],
    ["J1","J2","J3","J4"]
];

let selectedKursi = [];

jumlahInput.addEventListener('input', function() {
    const jumlah = parseInt(jumlahInput.value) || 0;
    const total = jumlah * hargaSatuan;

    totalHargaText.innerText = "Rp " + total.toLocaleString('id-ID');

    selectedKursi = [];
    renderKursi();
    generatePenumpang();
});

gerbongInput.addEventListener('change', function() {
    selectedKursi = [];
    renderKursi();
    generatePenumpang();
});

function buatTombolKursi(k) {
    const btn = document.createElement('button');
    btn.type = "button";
    btn.className = "train-seat-btn";
    btn.innerText = k;

    const keyKursi = gerbongInput.value + '-' + k;

    if (kursiTerisi.includes(keyKursi)) {
        btn.classList.add('terisi');
        btn.disabled = true;
    }

    btn.addEventListener('click', function() {
        const jumlah = parseInt(jumlahInput.value) || 0;

        if (jumlah === 0) {
            alert("Isi jumlah tiket dulu!");
            return;
        }

        if (selectedKursi.includes(k)) {
            selectedKursi = selectedKursi.filter(x => x !== k);
            btn.classList.remove('selected');
        } else {
            if (selectedKursi.length >= jumlah) {
                alert("Jumlah kursi melebihi jumlah tiket!");
                return;
            }

            selectedKursi.push(k);
            btn.classList.add('selected');
        }

        generatePenumpang();
    });

    return btn;
}

function renderKursi() {
    kursiContainer.innerHTML = "";

    if (!gerbongInput.value) {
        kursiContainer.innerHTML = "<p class='text-muted'>Pilih gerbong terlebih dahulu.</p>";
        return;
    }

    const seatMap = document.createElement('div');
    seatMap.className = "train-seat-map";

    kursiRows.forEach(rowData => {
        const row = document.createElement('div');
        row.className = "train-seat-row";

        row.appendChild(buatTombolKursi(rowData[0]));
        row.appendChild(buatTombolKursi(rowData[1]));

        const aisle = document.createElement('div');
        aisle.className = "train-seat-aisle";
        row.appendChild(aisle);

        row.appendChild(buatTombolKursi(rowData[2]));
        row.appendChild(buatTombolKursi(rowData[3]));

        seatMap.appendChild(row);
    });

    kursiContainer.appendChild(seatMap);
}

function generatePenumpang() {
    penumpangContainer.innerHTML = "";

    selectedKursi.forEach((k, i) => {
        penumpangContainer.innerHTML += `
            <div class="card p-3 mb-3">
                <label>
                    <strong>Penumpang ${i + 1} - ${gerbongInput.value} Kursi ${k}</strong>
                </label>

                <input type="hidden" name="kursi[]" value="${k}">
                <input type="text" name="penumpang[]" class="form-control mt-2" placeholder="Nama penumpang" required>
            </div>
        `;
    });
}

document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const jumlah = parseInt(jumlahInput.value) || 0;

    if (!gerbongInput.value) {
        e.preventDefault();
        alert("Pilih gerbong terlebih dahulu!");
        return;
    }

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
});

renderKursi();
</script>

</body>
</html>