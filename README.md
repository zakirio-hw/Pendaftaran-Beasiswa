# Sistem Informasi Pendaftaran Beasiswa

Sistem pendaftaran beasiswa online berbasis web menggunakan PHP, MySQL, dan Bootstrap 5.

## Fitur

- **Halaman Utama** — Menampilkan 4 pilihan beasiswa (Akademik, Non-Akademik, Afirmasi, Prestasi Olahraga) beserta persyaratan masing-masing
- **Form Pendaftaran** — Validasi client-side (email, nomor HP, upload file), generate IPK random (2.90–3.40), disable otomatis field jika IPK < 3.00
- **Hasil Pendaftaran** — Tabel seluruh data pendaftar dengan status "Belum di verifikasi"

## Teknologi

- **PHP 7+** (native, tanpa framework)
- **MySQL** via phpMyAdmin
- **Bootstrap 5.3** (CDN)
- **CSS3** (gradient header/footer custom)

## Struktur Database

### Database: `daftar_beasiswa`

### Tabel: `beasiswa`

| Column | Type | Keterangan |
|--------|------|------------|
| id | INT(11) AUTO_INCREMENT PK | ID unik |
| nama | VARCHAR(100) | Nama pendaftar |
| email | VARCHAR(100) | Email |
| no_hp | VARCHAR(20) | Nomor HP |
| semester | INT(2) | Semester 1–8 |
| ipk_terakhir | FLOAT(4,2) | IPK terakhir |
| pilihan_beasiswa | VARCHAR(100) | Jenis beasiswa |
| status_ajuan | VARCHAR(50) | Default: "Belum di verifikasi" |

## Instalasi

1. Clone/paste proyek ke folder `C:\xampp\htdocs\daftar-beasiswa\`
2. Jalankan XAMPP, pastikan Apache dan MySQL aktif
3. Buka phpMyAdmin (`http://localhost/phpmyadmin`), import `database.sql`
4. Atau jalankan langsung via CLI:
   ```
   mysql -u root < database.sql
   ```
5. Buka browser: `http://localhost/daftar-beasiswa/`

> **Catatan:** Sesuaikan username/password MySQL di `koneksi.php` jika berbeda (default XAMPP: root tanpa password)

## Struktur File

```
daftar-beasiswa/
├── index.php          # Halaman pilihan beasiswa
├── daftar.php         # Form pendaftaran
├── simpan.php         # Proses simpan ke database
├── hasil.php          # Tampilkan semua data
├── koneksi.php        # Koneksi MySQL
├── style.css          # Custom CSS (override Bootstrap)
├── database.sql       # Script SQL untuk import
└── README.md          # Dokumentasi
```

## Author

Dikembangkan untuk Sistem Informasi Pendaftaran Beasiswa Universitas Contoh.
