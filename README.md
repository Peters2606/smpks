![Laravel](https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg)
![Tailwind CSS](https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Tailwind_CSS_Logo.svg/85px-Tailwind_CSS_Logo.svg.png)
<img src="https://icon.icepanel.io/Technology/png-shadow-512/Composer.png" alt="Composer Logo" width="85"/>
<img src="https://icon.icepanel.io/Technology/svg/MySQL.svg" alt="Mysql Logo" width="85"/>
<img src="https://icon.icepanel.io/Technology/svg/Livewire.svg" alt="Livewire Logo" width="85"/>

# ✨ SMPKS - Sistem Manajemen Persetujuan Kontrak

Sistem Manajemen Persetujuan Kontrak (SMPKS) adalah aplikasi web inovatif yang dirancang untuk merampingkan dan mengotomatisasi seluruh siklus hidup persetujuan kontrak. Dibuat sebagai proyek **Capstone** oleh Kelompok 39 Program Studi Teknik Informatika, Universitas Methodist Indonesia tahun 2022. SMPKS berfokus pada peningkatan **efisiensi**, **transparansi**, dan **akuntabilitas** dalam alur kerja persetujuan kontrak.

-----

## 🎯 Tujuan Proyek

Proyek ini dibuat untuk menjawab tantangan dalam manajemen kontrak manual, dengan empat tujuan utama:

  * **Efisiensi:** Mengurangi waktu dan upaya yang dibutuhkan dalam proses persetujuan kontrak yang berbelit-belit.
  * **Transparansi:** Menyediakan visibilitas penuh terhadap status dan riwayat setiap kontrak secara *real-time*.
  * **Akuntabilitas:** Memastikan setiap langkah persetujuan tercatat dengan jelas, dengan pihak yang bertanggung jawab teridentifikasi.
  * **Manajemen Data Terpusat:** Menyimpan semua informasi dan dokumen kontrak di satu lokasi yang aman dan mudah diakses.

-----

## 🚀 Fitur Unggulan

SMPKS dilengkapi dengan serangkaian fitur canggih untuk mengelola kontrak secara komprehensif:

  * ### **Manajemen Kontrak** 📑

      * **Tambah Kontrak Baru:** Formulir yang mudah digunakan untuk memasukkan detail kontrak.
      * **Upload File Pendukung:** Lampirkan dokumen terkait (PDF, DOCX) langsung ke dalam sistem.
      * **Daftar Kontrak:** Tampilan tabel yang dilengkapi fitur pencarian dan filter berdasarkan tahun.

  * ### **Alur Persetujuan Fleksibel** ✅

      * **Persetujuan Bertahap:** Kontrak melewati alur persetujuan bertahap oleh **Admin**, **Legal**, dan **Marketing**.
      * **Pembatalan Persetujuan:** Opsi untuk membatalkan persetujuan dalam periode waktu yang ditentukan.
      * **Pencatatan Riwayat:** Sistem secara otomatis mencatat waktu review dan persetujuan oleh setiap peran.

  * ### **Pengelolaan Pengguna** 🧑‍💼 (Khusus Admin)

      * **Pendaftaran Pengguna:** Hanya Admin yang dapat menambahkan pengguna baru dan menetapkan peran mereka.
      * **Daftar Pengguna:** Tampilan untuk mengelola pengguna yang terdaftar di sistem.

  * ### **Dashboard Interaktif** 📊

      * Menampilkan visualisasi statistik kontrak secara menyeluruh *(total kontrak, kontrak aktif, kontrak segera habis, kontrak habis)*.

  * ### **Kotak Surat Kontrak** 📬

      * Memberi peringatan dini untuk kontrak yang akan segera berakhir dalam 30, 60, atau 90 hari, membantu tim Anda tetap proaktif.

  * ### **Riwayat Kontrak Terperinci** 📜

      * Melihat linimasa lengkap dari setiap kontrak, dari pembuatan hingga persetujuan akhir.

-----

## 🛠️ Teknologi yang Digunakan

Proyek ini dibangun menggunakan kombinasi teknologi modern untuk performa dan skalabilitas:

  * **Framework:** Laravel 12
  * **Bahasa Pemrograman:** PHP 8.3.24
  * **Manajemen Dependensi:** Composer 2.8.10
  * **Interaktivitas Frontend:** Livewire (untuk komponen UI yang dinamis)
  * **Styling:** Tailwind CSS (untuk desain antarmuka yang cepat dan responsif)
  * **Database:** MySQL

-----

## ⚙️ Instalasi dan Setup

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal:

1.  **Clone repositori:**
    ```bash
    git clone [URL_REPOSITORI_ANDA]
    cd SMPKS
    ```
2.  **Instal dependensi PHP:**
    ```bash
    composer install
    ```
3.  **Salin file `.env` dan buat kunci aplikasi:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Konfigurasi database:**
    Edit file `.env` dan isi detail koneksi database Anda.
5.  **Jalankan migrasi database:**
    ```bash
    php artisan migrate
    ```
6.  **Buat symbolic link untuk storage:**
    ```bash
    php artisan storage:link
    ```
7.  **Jalankan server pengembangan:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan tersedia di `http://127.0.0.1:8000`.

-----

**Catatan:** Pastikan Anda memiliki PHP 8.3.24+, Composer 2.8.10+, dan Node.js/NPM terinstal di sistem Anda.
