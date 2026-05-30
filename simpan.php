<?php
// ============================================
// Proses Simpan Pendaftaran ke Database
// ============================================

include 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form
    $nama              = mysqli_real_escape_string($conn, $_POST['nama']);
    $email             = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp             = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $semester          = (int)$_POST['semester'];
    $ipk_terakhir      = (float)$_POST['ipk_terakhir'];
    $pilihan_beasiswa  = mysqli_real_escape_string($conn, $_POST['pilihan_beasiswa']);
    $status_ajuan      = 'Belum di verifikasi';  // Default status

    // Validasi sederhana: pastikan data tidak kosong
    if (empty($nama) || empty($email) || empty($no_hp) || empty($semester) || empty($ipk_terakhir) || empty($pilihan_beasiswa)) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Query INSERT ke database
    $query = "INSERT INTO beasiswa (nama, email, no_hp, semester, ipk_terakhir, pilihan_beasiswa, status_ajuan) 
              VALUES ('$nama', '$email', '$no_hp', $semester, $ipk_terakhir, '$pilihan_beasiswa', '$status_ajuan')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, tampilkan alert dan redirect ke halaman hasil
        echo "<script>
                alert('✅ Pendaftaran berhasil! Data Anda telah tersimpan.');
                window.location.href = 'hasil.php';
              </script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>
                alert('Gagal menyimpan data: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }

    // Tutup koneksi
    mysqli_close($conn);

} else {
    // Jika diakses langsung bukan dari form
    header('Location: index.php');
    exit;
}
?>
