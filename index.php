
<?php
session_start();

$error = $_SESSION['register_error'] ?? '';
$success = $_SESSION['register_success'] ?? '';

unset($_SESSION['register_error'], $_SESSION['register_success']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="register-card">
        <div class="logo">A</div>

        <h1>Buat Akun</h1>
        <p class="subtitle">
            Silakan isi data untuk membuat akun baru.
        </p>

        <?php if ($error): ?>
            <div class="alert error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert success">
                <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <label for="nama">Nama lengkap</label>
            <input
                type="text"
                id="nama"
                name="nama"
                maxlength="100"
                autocomplete="name"
                placeholder="Masukkan nama lengkap"
                required
            >

            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                minlength="3"
                maxlength="50"
                pattern="[A-Za-z0-9_]{3,50}"
                autocomplete="username"
                placeholder="Contoh: pengguna123"
                required
            >

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                maxlength="150"
                autocomplete="email"
                placeholder="nama@email.com"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                minlength="8"
                maxlength="72"
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                required
            >

            <label for="konfirmasi_password">
                Konfirmasi password
            </label>
            <input
                type="password"
                id="konfirmasi_password"
                name="konfirmasi_password"
                minlength="8"
                maxlength="72"
                autocomplete="new-password"
                placeholder="Ulangi password"
                required
            >

            <button type="submit">Daftar Sekarang</button>
        </form>
    </div>
</div>

</body>
</html>
