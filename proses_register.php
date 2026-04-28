<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

/* buat ngecek ap username udh ada*/
$cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

if (mysqli_num_rows($cek) > 0) {

    echo "
    <script>
        alert('Username sudah digunakan!');
        window.location='register.php';
    </script>
    ";

} else {

    mysqli_query($conn, "
        INSERT INTO admin (username, password)
        VALUES ('$username', '$password')
    ");

    echo "
    <script>
        alert('Register berhasil! Silakan login');
        window.location='login.php';
    </script>
    ";
}
?>