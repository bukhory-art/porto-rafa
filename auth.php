<?php
session_start();
// Data Dummy Pengguna
$dummy_users = [
    'guru' => 'password123',
    'siswa' => 'siswa123',
    'admin' => 'admin'
];

//terima data dari form login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
 
// validasi
if(isset($dummy_users [$username]) && $dummy_users [$username] === $password)   {
    // login sukses
    $_SESSION['user'] = $username;
    header("Location: welcome.php");
} else {
    // login gagal
    header("Location: login.php?error=1");
}
exit;
?>