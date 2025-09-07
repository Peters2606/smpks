# SMPKS - Sistem Manajemen Persetujuan Kontrak

## Deskripsi Proyek

SMPKS adalah sebuah aplikasi web yang dirancang untuk mempermudah dan mengotomatisasi proses manajemen dan persetujuan kontrak. Sistem ini menyediakan platform terpusat bagi berbagai departemen (Admin, Legal, Marketing) untuk mengelola siklus hidup kontrak, mulai dari pembuatan, pengajuan persetujuan, hingga pemantauan riwayat dan status kontrak. Tujuan utama SMPKS adalah meningkatkan efisiensi, transparansi, dan akuntabilitas dalam alur kerja persetujuan kontrak, mengurangi keterlambatan, dan meminimalkan kesalahan manual.

## Tujuan

*   **Efisiensi:** Mengurangi waktu dan upaya yang dibutuhkan dalam proses persetujuan kontrak.
*   **Transparansi:** Menyediakan visibilitas penuh terhadap status dan riwayat setiap kontrak.
*   **Akuntabilitas:** Memastikan setiap langkah persetujuan tercatat dengan jelas oleh pihak yang bertanggung jawab.
*   **Manajemen Data Terpusat:** Menyimpan semua informasi kontrak dan file pendukung di satu lokasi yang aman dan mudah diakses.

## Fitur Utama

*   **Manajemen Kontrak:**
    *   **Tambah Kontrak Baru:** Formulir intuitif untuk memasukkan detail kontrak, termasuk nomor PKS, nama kontrak, tanggal mulai/berakhir, dan tahun tarif.
    *   **Upload File Pendukung:** Kemampuan untuk mengunggah file terkait kontrak (PDF, DOC, DOCX) sebagai lampiran.
    *   **Daftar Kontrak:** Tampilan tabel yang komprehensif untuk melihat semua kontrak, dilengkapi dengan fitur pencarian dan filter berdasarkan tahun tarif.
*   **Alur Persetujuan Berbasis Peran:**
    *   **Persetujuan Bertahap:** Kontrak baru memerlukan persetujuan dari Admin, Legal, dan Marketing.
    *   **Pembatalan Persetujuan:** Kemampuan untuk membatalkan persetujuan dalam jangka waktu tertentu (misal: 20 menit) setelah disetujui.
    *   **Pencatatan Review File:** Otomatis mencatat waktu review oleh Legal atau Marketing saat file pendukung diakses.
*   **Manajemen Pengguna (Admin Only):**
    *   **Pendaftaran Pengguna:** Hanya admin yang dapat mendaftarkan pengguna baru dan menetapkan peran (Admin, Legal, Marketing).
    *   **Daftar Pengguna:** Tampilan tabel untuk mengelola daftar pengguna yang terdaftar dalam sistem.
*   **Dashboard Interaktif:**
    *   Menampilkan statistik kunci terkait kontrak (total kontrak, kontrak aktif, kontrak segera habis, kontrak kontrak habis).
    *   Memberikan gambaran umum status kontrak secara visual.
*   **Kotak Surat Kontrak:**
    *   Menampilkan daftar kontrak yang akan segera berakhir dalam periode tertentu (30, 60, atau 90 hari).
    *   Membantu dalam pemantauan kontrak yang memerlukan perhatian segera.
*   **Riwayat Kontrak:**
    *   Tampilan detail yang menunjukkan linimasa persetujuan kontrak, termasuk kapan kontrak dibuat, aktif, direview oleh Legal/Marketing, dan disetujui oleh masing-masing peran.

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan teknologi-teknologi modern untuk memastikan kinerja, skalabilitas, dan kemudahan pengembangan:

*   **Framework:** Laravel 12
*   **Bahasa Pemrograman:** PHP 8.3.24
*   **Manajemen Dependensi PHP:** Composer 2.8.10
*   **Frontend Interaktivitas:** Livewire (untuk komponen UI dinamis)
*   **Styling:** Tailwind CSS (untuk desain antarmuka yang cepat dan responsif)
*   **Database:** MySQL (atau database relasional lainnya yang didukung Laravel)

## Instalasi dan Setup

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1.  **Clone repositori:**
    ```bash
    git clone [URL_REPOSITORI_ANDA]
    cd SMPKS
    ```
2.  **Instal dependensi Composer:**
    ```bash
    composer install
    ```
3.  **Salin file `.env`:**
    ```bash
    cp .env.example .env
    ```
4.  **Buat kunci aplikasi:**
    ```bash
    php artisan key:generate
    ```
5.  **Konfigurasi database:**
    Edit file `.env` dan atur kredensial database Anda.
6.  **Jalankan migrasi database:**
    ```bash
    php artisan migrate
    ```
7.  **Buat symbolic link untuk storage:**
    ```bash
    php artisan storage:link
    ```
8.  **Jalankan server pengembangan:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan tersedia di `http://127.0.0.1:8000`.

---

**Catatan:** Pastikan Anda memiliki PHP 8.3.24+, Composer 2.8.10+, dan Node.js/NPM terinstal di sistem Anda.