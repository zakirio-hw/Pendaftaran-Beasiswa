<?php
// ============================================
// Halaman Form Pendaftaran Beasiswa
// ============================================

include 'koneksi.php';

// Ambil parameter beasiswa dari URL jika ada
$selected_beasiswa = isset($_GET['beasiswa']) ? $_GET['beasiswa'] : '';

// Daftar pilihan beasiswa
$daftar_beasiswa = [
    'Beasiswa Akademik',
    'Beasiswa Non-Akademik',
    'Beasiswa Afirmasi',
    'Beasiswa Prestasi Olahraga'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Beasiswa - SIM Beasiswa</title>
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
                <li class="nav-item"><a href="daftar.php" class="nav-link active">Daftar Beasiswa</a></li>
                <li class="nav-item"><a href="hasil.php" class="nav-link">Hasil Pendaftaran</a></li>
            </ul>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="card-title h4 text-primary mb-1">Form Pendaftaran Beasiswa</h2>
                        <p class="text-muted mb-4">Isi data diri Anda dengan lengkap untuk mendaftar beasiswa.</p>

                        <!-- Form Pendaftaran -->
                        <form action="simpan.php" method="POST" enctype="multipart/form-data" id="formDaftar" onsubmit="return validateForm()">

                            <!-- Field: Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <!-- Field: Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required oninput="validateEmailInput()">
                                <small id="emailError" class="text-danger"></small>
                            </div>

                            <!-- Field: Nomor HP -->
                            <div class="mb-3">
                                <label for="no_hp" class="form-label fw-semibold">Nomor HP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx" required onkeypress="return onlyNumbers(event)" oninput="validatePhoneInput()">
                                <small id="phoneError" class="text-danger"></small>
                            </div>

                            <!-- Field: Semester -->
                            <div class="mb-3">
                                <label for="semester" class="form-label fw-semibold">Semester Saat Ini <span class="text-danger">*</span></label>
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="">-- Pilih Semester --</option>
                                    <?php for ($i = 1; $i <= 8; $i++): ?>
                                    <option value="<?php echo $i; ?>">Semester <?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <!-- Field: IPK Terakhir (dengan tombol Generate) -->
                            <div class="mb-3">
                                <label for="ipk_terakhir" class="form-label fw-semibold">IPK Terakhir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light" id="ipk_terakhir" name="ipk_terakhir" readonly required>
                                    <button class="btn btn-warning text-white" type="button" onclick="generateIPK()">Generate IPK</button>
                                </div>
                                <small id="ipkInfo" class="text-muted">Klik tombol "Generate IPK" untuk mendapatkan nilai IPK random</small>
                            </div>

                            <!-- Field: Pilihan Beasiswa -->
                            <div class="mb-3">
                                <label for="pilihan_beasiswa" class="form-label fw-semibold">Pilihan Beasiswa <span class="text-danger">*</span></label>
                                <select class="form-select" id="pilihan_beasiswa" name="pilihan_beasiswa" required>
                                    <option value="">-- Pilih Beasiswa --</option>
                                    <?php foreach ($daftar_beasiswa as $b): ?>
                                    <option value="<?php echo $b; ?>" <?php echo ($selected_beasiswa == $b) ? 'selected' : ''; ?>>
                                        <?php echo $b; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Field: Upload Berkas Syarat -->
                            <div class="mb-3">
                                <label for="berkas" class="form-label fw-semibold">Upload Berkas Syarat</label>
                                <input type="file" class="form-control" id="berkas" name="berkas" accept=".pdf,.jpg,.jpeg,.png,.zip" onchange="validateFile()">
                                <small id="fileError" class="text-danger"></small>
                                <small class="text-muted d-block">Format: PDF, JPG, PNG, ZIP. Maksimal 2MB.</small>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-2 mt-4">
                                <a href="index.php" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-success" id="btnDaftar">Daftar</button>
                            </div>

                        </form>
                    </div>
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

    <!-- ============================================ -->
    <!-- JavaScript untuk Logika Form Pendaftaran     -->
    <!-- ============================================ -->
    <script>

        // Generate random IPK saat halaman dimuat
        window.onload = function () {
            generateIPK();
        };

        // ==========================================
        // Fungsi: Generate IPK Random (2.90 - 3.40)
        // ==========================================
        function generateIPK() {
            var randomIPK = (Math.random() * 0.5 + 2.9).toFixed(2);
            document.getElementById('ipk_terakhir').value = randomIPK;
            checkIPK(randomIPK);
        }

        // ==========================================
        // Fungsi: Cek Nilai IPK
        // Jika IPK < 3, disable pilihan & upload
        // ==========================================
        function checkIPK(ipk) {
            var pilihanSelect = document.getElementById('pilihan_beasiswa');
            var berkasInput = document.getElementById('berkas');
            var btnDaftar = document.getElementById('btnDaftar');
            var ipkInfo = document.getElementById('ipkInfo');

            if (parseFloat(ipk) < 3) {
                pilihanSelect.disabled = true;
                berkasInput.disabled = true;
                btnDaftar.disabled = true;
                pilihanSelect.value = '';
                ipkInfo.innerHTML = '⚠️ IPK Anda di bawah 3.00, sehingga tidak dapat mendaftar beasiswa.';
                ipkInfo.className = 'text-warning fw-semibold';
            } else {
                pilihanSelect.disabled = false;
                berkasInput.disabled = false;
                btnDaftar.disabled = false;
                ipkInfo.innerHTML = '✅ IPK Anda memenuhi syarat. Silakan lengkapi data lainnya.';
                ipkInfo.className = 'text-success';
            }
        }

        // ==========================================
        // Fungsi: Validasi Format Email
        // ==========================================
        function validateEmailInput() {
            var email = document.getElementById('email').value;
            var error = document.getElementById('emailError');
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email.length > 0 && !regex.test(email)) {
                error.textContent = 'Format email tidak valid. Contoh: nama@domain.com';
            } else {
                error.textContent = '';
            }
        }

        // ==========================================
        // Fungsi: Hanya Menerima Angka (untuk No HP)
        // ==========================================
        function onlyNumbers(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        // ==========================================
        // Fungsi: Validasi Input Nomor HP
        // ==========================================
        function validatePhoneInput() {
            var phone = document.getElementById('no_hp').value;
            var error = document.getElementById('phoneError');

            if (phone.length > 0 && isNaN(phone)) {
                error.textContent = 'Nomor HP hanya boleh berisi angka.';
            } else {
                error.textContent = '';
            }
        }

        // ==========================================
        // Fungsi: Validasi File Upload
        // ==========================================
        function validateFile() {
            var fileInput = document.getElementById('berkas');
            var error = document.getElementById('fileError');
            var file = fileInput.files[0];

            if (file) {
                var fileName = file.name;
                var fileExt = fileName.split('.').pop().toLowerCase();
                var allowedExt = ['pdf', 'jpg', 'jpeg', 'png', 'zip'];

                if (allowedExt.indexOf(fileExt) === -1) {
                    error.textContent = 'Format file tidak didukung. Gunakan PDF, JPG, PNG, atau ZIP.';
                    fileInput.value = '';
                    return false;
                }

                if (file.size > 2 * 1024 * 1024) {
                    error.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
                    fileInput.value = '';
                    return false;
                }

                error.textContent = '';
            }
            return true;
        }

        // ==========================================
        // Fungsi: Validasi Form Sebelum Submit
        // ==========================================
        function validateForm() {
            var email = document.getElementById('email').value;
            var phone = document.getElementById('no_hp').value;
            var pilihan = document.getElementById('pilihan_beasiswa').value;
            var ipk = document.getElementById('ipk_terakhir').value;
            var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!regexEmail.test(email)) {
                alert('Masukkan format email yang valid!');
                document.getElementById('email').focus();
                return false;
            }

            if (isNaN(phone) || phone.length < 8) {
                alert('Nomor HP harus berisi minimal 8 digit angka!');
                document.getElementById('no_hp').focus();
                return false;
            }

            if (ipk === '') {
                alert('IPK belum di-generate. Klik tombol "Generate IPK"!');
                return false;
            }

            if (parseFloat(ipk) >= 3 && pilihan === '') {
                alert('Silakan pilih jenis beasiswa!');
                document.getElementById('pilihan_beasiswa').focus();
                return false;
            }

            return true;
        }

    </script>

</body>
</html>
