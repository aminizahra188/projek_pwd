<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

/*cek user di tabel admin*/
$query = mysqli_query($conn, "
    SELECT * FROM admin
    WHERE username = '$username'
    AND password = '$password'
");

$data = mysqli_fetch_assoc($query);

if ($data) {

    $_SESSION['username'] = $data['username'];
    $_SESSION['status'] = "login";
    $_SESSION['role'] = $data['role'];

    header("location:index.php");

} else {

    header("location:login.php?pesan=gagal");
}
?>