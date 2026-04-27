<?php
$asal = $_POST['asal'] ?? '';
$tujuan = $_POST['tujuan'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$jam = $_POST['jam'] ?? '';

if (!$asal || !$tujuan || !$tanggal || !$jam) {
    echo "<script>alert('Akses tidak valid!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container py-5">

    <h2 class="text-center mb-4">Form Pemesanan Tiket</h2>

    <!-- DETAIL PERJALANAN -->
    <div class="card p-4 mb-4">
        <h5>Detail Perjalanan</h5>
        <div class="row">
            <div class="col-md-3"><strong>Asal:</strong><br><?= $asal ?></div>
            <div class="col-md-3"><strong>Tujuan:</strong><br><?= $tujuan ?></div>
            <div class="col-md-3"><strong>Tanggal:</strong><br><?= $tanggal ?></div>
            <div class="col-md-3"><strong>Jam:</strong><br><?= $jam ?></div>
        </div>
    </div>

    <!-- FORM -->
    <div class="card p-4">
        <form action="proses_pemesanan.php" method="POST">

            <!-- hidden kirim data -->
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

            <div class="mb-3">
                <input type="number" id="jumlah" class="form-control" min="1" max="5"
                placeholder="Masukkan jumlah tiket" required>
            </div>

            <h5>Data Penumpang & Kursi</h5>

            <div id="penumpangContainer"></div>

            <button type="submit" class="btn btn-primary w-100 mt-3">
                Pesan Sekarang
            </button>

        </form>
    </div>

</div>

<script>
const jumlahInput = document.getElementById('jumlah');
const container = document.getElementById('penumpangContainer');

// daftar kursi
const kursiList = ["A1","A2","A3","A4","B1","B2","B3","B4"];

jumlahInput.addEventListener('input', function() {
    let jumlah = parseInt(this.value) || 0;

    if (jumlah > 5) {
        alert("Maksimal 5 tiket!");
        this.value = 5;
        jumlah = 5;
    }

    container.innerHTML = '';

    for (let i = 1; i <= jumlah; i++) {

        let options = kursiList.map(k => `<option value="${k}">${k}</option>`).join('');

        container.innerHTML += `
            <div class="card p-3 mb-3">
                <label><strong>Penumpang ${i}</strong></label>

                <input type="text" name="penumpang[]" class="form-control mb-2"
                placeholder="Nama penumpang" required>

                <select name="kursi[]" class="form-select" required>
                    <option disabled selected>Pilih Kursi</option>
                    ${options}
                </select>
            </div>
        `;
    }
});
</script>

</body>
</html>