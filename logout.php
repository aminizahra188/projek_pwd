<?php
session_start();

/*hapus semua session*/
session_destroy();

/*kembali ke halaman login*/
header("location:index.php");
?>