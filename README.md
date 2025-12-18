# SIG Desa Tegalsambi

Sistem Informasi Geografis (SIG) untuk Desa Tegalsambi. Aplikasi ini bertujuan untuk menyajikan informasi pemetaan geografis desa, data kependudukan, berita, dan fasilitas umum yang ada di Desa Tegalsambi berbasis web yang user-friendly dan informatif.

## Daftar Isi
- [Tentang Aplikasi](#tentang-aplikasi)
- [Fitur Utama](#fitur-utama)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Panduan Instalasi](#panduan-instalasi)
- [Cara Menjalankan](#cara-menjalankan)
- [Akun Default](#akun-default)

## Tentang Aplikasi
Aplikasi ini dibangun menggunakan framework **Laravel 8**. Sistem ini dirancang untuk memudahkan pemerintah desa dalam memetakan potensi, infrastruktur, dan fasilitas desa, serta memberikan informasi yang transparan dan mudah diakses oleh masyarakat umum melalui antarmuka peta interaktif.

## Fitur Utama
- **Peta Interaktif**: Visualisasi lokasi penting seperti kantor desa, fasilitas kesehatan, sekolah, tempat ibadah, dan UMKM menggunakan integrasi peta (Google Maps/Leaflet).
- **Panel Admin**: Dashboard khusus untuk administrator mengelola seluruh konten website termasuk data lokasi (POI), berita, galeri, dan data penduduk.
- **Berita & Informasi**: Halaman untuk menyampaikan berita terkini, pengumuman, dan agenda kegiatan desa.
- **Profil Desa**: Menampilkan sejarah, visi & misi, serta struktur organisasi pemerintahan desa.
- **Galeri Foto**: Dokumentasi kegiatan dan potensi desa.
- **Kontak via WhatsApp**: Formulir kontak yang terintegrasi langsung dengan WhatsApp untuk memudahkan komunikasi warga dengan perangkat desa.

## Persyaratan Sistem
Sebelum melakukan instalasi, pastikan lingkungan pengembangan (local environment) Anda memenuhi persyaratan berikut:

- **PHP**: Versi ^7.3 atau ^8.0
- **Composer**: Dependency manager untuk PHP.
- **Node.js & NPM**: Untuk memproses aset frontend (CSS/JS).
- **Database**: MySQL atau MariaDB.
- **Web Server**: Apache atau Nginx (Laragon/XAMPP sangat direkomendasikan untuk pengguna Windows).

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi di komputer lokal Anda:

1.  **Clone Repository**
    Buka terminal atau command prompt, lalu clone repository ini ke direktori web server Anda (misal: `www` atau `htdocs`):
    ```bash
    git clone https://github.com/VinzSatoru/sigdesategalsambi_1438.git
    cd sig_desa_tegalsambi
    ```

2.  **Install Dependensi Backend**
    Jalankan perintah berikut untuk mengunduh library Laravel yang dibutuhkan:
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**
    Duplikasi file konfigurasi `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    atau pada Windows (Command Prompt):
    ```cmd
    copy .env.example .env
    ```
    
    Buka file `.env` menggunakan teks editor dan sesuaikan pengaturan database:
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sig_desa_tegalsambi  # Pastikan database ini sudah dibuat di MySQL
    DB_USERNAME=root
    DB_PASSWORD=                     # Kosongkan jika default XAMPP/Laragon
    ```

4.  **Generate Application Key**
    Buat kunci enkripsi aplikasi:
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi dan Seeding Database**
    Jalankan perintah ini untuk membuat struktur tabel di database dan mengisi data awal (termasuk akun admin):
    ```bash
    php artisan migrate --seed
    ```

6.  **Install Dependensi Frontend**
    Install paket Node.js dan compile aset (Tailwind CSS dll):
    ```bash
    npm install
    npm run dev
    ```

## Cara Menjalankan

Setelah proses instalasi selesai, Anda dapat menjalankan aplikasi menggunakan built-in server Laravel:

```bash
php artisan serve
```

Aplikasi akan dapat diakses melalui browser di alamat:
[http://localhost:8000](http://localhost:8000)

## Akun Default

Aplikasi ini dilengkapi dengan data seeder untuk akun Administrator. Gunakan kredensial berikut untuk masuk ke Panel Admin:

- **Email**: `admin@tegalsambi.desa.id`
- **Password**: `password`

> **PENTING**: Demi keamanan, segera ganti password akun administrator setelah Anda berhasil login untuk pertama kalinya.
