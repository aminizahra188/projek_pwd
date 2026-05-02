<?php
include 'koneksi.php';

$id = $_POST['id'] ?? '';

if ($id == '') {
    echo "<script>alert('ID tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

if (!isset($_FILES['bukti'])) {
    echo "<script>alert('Input file bukti tidak ditemukan!'); window.location='upload_bukti.php?id=$id';</script>";
    exit;
}

if ($_FILES['bukti']['error'] != 0) {
    echo "<script>alert('Upload error kode: " . $_FILES['bukti']['error'] . "'); window.location='upload_bukti.php?id=$id';</script>";
    exit;
}

$folder = "uploads";

if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$namaFile = $_FILES['bukti']['name'];
$tmpFile = $_FILES['bukti']['tmp_name'];
$ukuranFile = $_FILES['bukti']['size'];

$ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
$allowed = ['jpg', 'jpeg', 'png', 'pdf'];

if (!in_array($ext, $allowed)) {
    echo "<script>alert('Format file harus JPG, JPEG, PNG, atau PDF!'); window.location='upload_bukti.php?id=$id';</script>";
    exit;
}

if ($ukuranFile > 2 * 1024 * 1024) {
    echo "<script>alert('Ukuran file maksimal 2MB!'); window.location='upload_bukti.php?id=$id';</script>";
    exit;
}

$namaBaru = "bukti_" . time() . "_" . rand(1000, 9999) . "." . $ext;
$pathUpload = $folder . $namaBaru;

if (!move_uploaded_file($tmpFile, $pathUpload)) {
    echo "<script>alert('File gagal dipindahkan ke folder uploads!'); window.location='upload_bukti.php?id=$id';</script>";
    exit;
}

$update = mysqli_query($conn, "
    UPDATE pemesanan 
    SET bukti_pembayaran='$namaBaru',
        status_pembayaran='Sudah Bayar'
    WHERE id='$id'
");

if ($update) {
    echo "<script>alert('Upload bukti pembayaran berhasil!'); window.location='tiket.php?id=$id';</script>";
} else {
    echo "<script>alert('Database error: " . mysqli_error($conn) . "'); window.location='upload_bukti.php?id=$id';</script>";
}
?>