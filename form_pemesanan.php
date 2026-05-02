<?php
session_start();

if ($_SESSION['status'] != "login") {
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
    <link rel="stylesheet" href="css/style.css?v=200">

    <style>
        #kursiContainer {
            display: block !important;
            width: fit-content !important;
            margin: 20px 0 !important;
            padding: 20px !important;
            background: #f8fafc !important;
            border-radius: 14px !important;
        }

        .seat-row {
            display: flex !important;
            flex-direction: row !important;
            gap: 10px !important;
            margin-bottom: 10px !important;
        }

        .seat-btn {
            width: 55px !important;
            height: 45px !important;
            border: none !important;
            border-radius: 10px !important;
            background: #e5e7eb !important;
            color: #111827 !important;
            font-weight: 700 !important;
            cursor: pointer !important;
            flex: 0 0 55px !important;
        }

        .seat-btn:hover {
            background: #d1d5db !important;
        }

        .seat-btn.selected {
            background: #198754 !important;
            color: white !important;
        }

        .seat-btn.terisi {
            background: #dc3545 !important;
            color: white !important;
            cursor: not-allowed !important;
        }

        .seat-aisle {
            width: 45px !important;
            flex: 0 0 45px !important;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <div class="page-title">
        <h2>Form Pemesanan Tiket</h2>
    </div>

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
                <option value="Gerbong 1">Gerbong 1</option>
                <option value="Gerbong 2">Gerbong 2</option>
                <option value="Gerbong 3">Gerbong 3</option>
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
    ["A1","A2","A3","A4","A5","A6"],
    ["B1","B2","B3","B4","B5","B6"],
    ["C1","C2","C3","C4","C5","C6"],
    ["D1","D2","D3","D4","D5","D6"],
    ["E1","E2","E3","E4","E5","E6"],
    ["F1","F2","F3","F4","F5","F6"],
    ["G1","G2","G3","G4","G5","G6"],
    ["H1","H2","H3","H4","H5","H6"]
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
    btn.className = "seat-btn";
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

    kursiRows.forEach(rowData => {
        const row = document.createElement('div');
        row.className = "seat-row";

        row.appendChild(buatTombolKursi(rowData[0]));
        row.appendChild(buatTombolKursi(rowData[1]));
        row.appendChild(buatTombolKursi(rowData[2]));

        const lorong = document.createElement('div');
        lorong.className = "seat-aisle";
        row.appendChild(lorong);

        row.appendChild(buatTombolKursi(rowData[3]));
        row.appendChild(buatTombolKursi(rowData[4]));
        row.appendChild(buatTombolKursi(rowData[5]));

        kursiContainer.appendChild(row);
    });
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