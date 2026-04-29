# E-Maintenance UNSIKA — PHP + MySQL (XAMPP)

## Cara Install

### 1. Salin folder ke XAMPP
Salin seluruh folder `unsika_maintenance` ini ke:
```
C:\xampp\htdocs\unsika_maintenance\
```

### 2. Jalankan XAMPP
Buka **XAMPP Control Panel**, klik **Start** pada **Apache** dan **MySQL**.

### 3. Buat database
1. Buka browser: `http://localhost/phpmyadmin`
2. Klik tab **Import**
3. Pilih file **`database.sql`** dari folder ini
4. Klik **Go** → database `unsika_maintenance` + tabel `maintenance` otomatis dibuat

### 4. Buka aplikasi
Akses di browser:
```
http://localhost/unsika_maintenance/index.php
```

## Struktur File

| File | Fungsi |
|---|---|
| `database.sql` | Script buat database & tabel (import via phpMyAdmin) |
| `koneksi.php` | Konfigurasi koneksi MySQL |
| `index.php` | Halaman utama: form laporan + daftar laporan + ubah status |
| `proses_simpan.php` | Menyimpan laporan baru ke database (pakai prepared statement) |
| `update_status.php` | Mengubah status laporan (Pending/Diproses/Selesai) |

## Catatan Keamanan
Versi `proses_simpan.php` Anda sebelumnya rentan **SQL Injection** karena memasukkan `$_POST` langsung ke query.
Versi baru ini sudah pakai **prepared statement** (`mysqli_prepare` + `bind_param`) — jauh lebih aman.

## Konfigurasi DB (kalau beda)
Edit `koneksi.php`:
```php
$host = "localhost";
$user = "root";
$pass = "";       // isi kalau MySQL Anda pakai password
$db   = "unsika_maintenance";
```
