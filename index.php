<?php
// ============================================
// Halaman Utama - Pilihan Beasiswa
// ============================================

include 'koneksi.php';

// Array data beasiswa beserta ketentuan syaratnya
$beasiswa_list = [
    [
        'nama' => 'Beasiswa Akademik',
        'icon' => '🎓',
        'deskripsi' => 'Diberikan kepada mahasiswa dengan prestasi akademik unggul.',
        'syarat' => [
            'IPK minimal 3.00',
            'Terdaftar sebagai mahasiswa aktif',
            'Tidak sedang menerima beasiswa lain'
        ]
    ],
    [
        'nama' => 'Beasiswa Non-Akademik',
        'icon' => '🏅',
        'deskripsi' => 'Diberikan kepada mahasiswa berprestasi di bidang non-akademik.',
        'syarat' => [
            'IPK minimal 2.75',
            'Memiliki prestasi non-akademik',
            'Aktif dalam organisasi/UKM'
        ]
    ],
    [
        'nama' => 'Beasiswa Afirmasi',
        'icon' => '🤝',
        'deskripsi' => 'Diberikan kepada mahasiswa dari daerah tertinggal atau keluarga kurang mampu.',
        'syarat' => [
            'IPK minimal 2.50',
            'Berasal dari daerah tertinggal',
            'Melampirkan surat keterangan tidak mampu'
        ]
    ],
    [
        'nama' => 'Beasiswa Prestasi Olahraga',
        'icon' => '⚽',
        'deskripsi' => 'Diberikan kepada mahasiswa berprestasi di bidang olahraga.',
        'syarat' => [
            'IPK minimal 2.75',
            'Pernah meraih juara di tingkat provinsi/nasional',
            'Terdaftar sebagai atlet aktif'
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Beasiswa - SIM Beasiswa</title>
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
                <li class="nav-item"><a href="index.php" class="nav-link active">Beranda</a></li>
                <li class="nav-item"><a href="daftar.php" class="nav-link">Daftar Beasiswa</a></li>
                <li class="nav-item"><a href="hasil.php" class="nav-link">Hasil Pendaftaran</a></li>
            </ul>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title h4 text-primary mb-2">Pilihan Beasiswa</h2>
                <p class="text-muted mb-4">Pilih beasiswa yang sesuai dengan kriteria Anda. Setiap beasiswa memiliki ketentuan dan persyaratan yang berbeda.</p>

                <!-- Grid Kartu Beasiswa -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <?php foreach ($beasiswa_list as $beasiswa): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 card-beasiswa">
                            <div class="card-body d-flex flex-column">
                                <div class="fs-1 mb-2"><?php echo $beasiswa['icon']; ?></div>
                                <h5 class="card-title text-primary"><?php echo $beasiswa['nama']; ?></h5>
                                <p class="card-text text-muted small flex-grow-1"><?php echo $beasiswa['deskripsi']; ?></p>

                                <!-- Daftar Syarat -->
                                <div class="bg-light rounded p-3 mb-3">
                                    <h6 class="fw-bold text-primary small mb-2">Persyaratan:</h6>
                                    <ul class="list-unstyled mb-0">
                                        <?php foreach ($beasiswa['syarat'] as $syarat): ?>
                                        <li class="small text-secondary py-1">
                                            <span class="text-success fw-bold me-1">✓</span><?php echo $syarat; ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <!-- Tombol Daftar -->
                                <a href="daftar.php?beasiswa=<?php echo urlencode($beasiswa['nama']); ?>" class="btn btn-primary w-100 mt-auto">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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
