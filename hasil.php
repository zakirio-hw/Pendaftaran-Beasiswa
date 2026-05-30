<?php
// ============================================
// Halaman Hasil Pendaftaran Beasiswa
// ============================================

include 'koneksi.php';

// Query untuk mengambil semua data pendaftaran
$query = "SELECT * FROM beasiswa ORDER BY id DESC";
$result = mysqli_query($conn, $query);

// Hitung jumlah data
$total_pendaftar = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran - SIM Beasiswa</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Header dengan gradient -->
    <header class="header py-4 text-white text-center">
        <div class="container">
            <h1 class="h3 mb-1">Sistem Informasi Pendaftaran Beasiswa</h1>
            <p class="mb-0 opacity-75">Universitas Contoh - Tahun Akademik 2025/2026</p>
        </div>
    </header>

    <!-- Navigasi Bootstrap -->
    <nav class="navbar navbar-expand navbar-dark bg-primary shadow-sm">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="index.php" class="nav-link">Beranda</a></li>
                <li class="nav-item"><a href="daftar.php" class="nav-link">Daftar Beasiswa</a></li>
                <li class="nav-item"><a href="hasil.php" class="nav-link active">Hasil Pendaftaran</a></li>
            </ul>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title h4 text-primary mb-1">Hasil Pendaftaran Beasiswa</h2>
                <p class="text-muted mb-4">Berikut adalah daftar mahasiswa yang telah mendaftar beasiswa.</p>

                <!-- Info Total Pendaftar -->
                <div class="alert alert-success py-2 d-flex align-items-center gap-2">
                    <strong>Total Pendaftar:</strong> <?php echo $total_pendaftar; ?> mahasiswa
                </div>

                <?php if ($total_pendaftar > 0): ?>

                <!-- Tabel Data Pendaftaran -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Semester</th>
                                <th>IPK</th>
                                <th>Pilihan Beasiswa</th>
                                <th>Status Ajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                                <td><?php echo $row['semester']; ?></td>
                                <td><?php echo number_format($row['ipk_terakhir'], 2); ?></td>
                                <td><?php echo htmlspecialchars($row['pilihan_beasiswa']); ?></td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <?php echo htmlspecialchars($row['status_ajuan']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <?php else: ?>

                <!-- Pesan jika belum ada data -->
                <div class="text-center py-5">
                    <p class="text-muted fs-5 mb-3">Belum ada pendaftar beasiswa.</p>
                    <a href="daftar.php" class="btn btn-primary">Daftar Sekarang</a>
                </div>

                <?php endif; ?>

                <!-- Tombol Aksi -->
                <div class="d-flex gap-2 mt-4">
                    <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                    <a href="daftar.php" class="btn btn-success">Daftar Baru</a>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 text-white text-center">
        <div class="container">
            <p class="mb-0 small opacity-75">&copy; 2026 Universitas Contoh. Sistem Informasi Pendaftaran Beasiswa.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Bebaskan memori dan tutup koneksi
mysqli_free_result($result);
mysqli_close($conn);
?>
