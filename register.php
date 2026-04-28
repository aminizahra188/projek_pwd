<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Matrain</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">
    <div class="register-box">

        <h2 class="title">Register Akun</h2>

        <form action="proses_register.php" method="POST">

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-register">
                Daftar Sekarang
            </button>

        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="login.php">Login di sini</a>
        </div>

    </div>
</div>

</body>
</html>