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

$cek = mysqli_num_rows($query);

if ($cek > 0) {

    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";

    header("location:index.php");

} else {

    header("location:login.php?pesan=gagal");
}
?>