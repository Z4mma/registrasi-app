
<?php
session_start();
require_once 'database.php';

function gagal($pesan)
{
    $_SESSION['register_error'] = $pesan;
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi_password'] ?? '';

if ($nama === '' || $username === '' || $email === '') {
    gagal('Semua kolom wajib diisi.');
}

if (strlen($nama) > 100) {
    gagal('Nama maksimal 100 karakter.');
}

if (!preg_match('/^[A-Za-z0-9_]{3,50}$/', $username)) {
    gagal('Username harus 3-50 karakter, berupa huruf, angka, atau underscore.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)
    || strlen($email) > 150) {
    gagal('Format email tidak valid.');
}

if (strlen($password) < 8 || strlen($password) > 72) {
    gagal('Password harus 8-72 karakter.');
}

if ($password !== $konfirmasi) {
    gagal('Konfirmasi password tidak cocok.');
}

try {
    $cek = $pdo->prepare(
        'SELECT id FROM users
         WHERE username = :username OR email = :email
         LIMIT 1'
    );

    $cek->execute([
        'username' => $username,
        'email' => $email
    ]);

    if ($cek->fetch()) {
        gagal('Username atau email sudah terdaftar.');
    }

    // Membuat salt acak secara otomatis
    $salt = bin2hex(random_bytes(16));

$stmt = $pdo->prepare(
    "INSERT INTO users (nama, username, email, password)
     VALUES (:nama, :username, :email, :password)"
);

$stmt->execute([
    ':nama'     => $nama,
    ':username' => $username,
    ':email'    => $email,
    ':password' => $salt
]);

    $_SESSION['register_success'] =
        'Registrasi berhasil! Akun kamu sudah dibuat.';

    header('Location: index.php');
    exit;

}catch (PDOException $e) {
    die('Error database: ' . $e->getMessage());
}
