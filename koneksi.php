<?php
// ============================================
// Koneksi ke Database MySQL
// ============================================

// Konfigurasi database
$host = "localhost";        // Host database
$user = "root";             // Username MySQL (default XAMPP: "root")
$pass = "";                 // Password MySQL (default XAMPP: "")
$db   = "daftar_beasiswa";  // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
