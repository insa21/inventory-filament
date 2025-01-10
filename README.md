# 🧾 Laravel Invoice Management System

Sistem manajemen faktur berbasis web ini dibangun menggunakan framework **Laravel** dengan integrasi **Laravel Filament** untuk admin panel yang modern dan responsif. Aplikasi ini dirancang untuk mempermudah pengelolaan data pelanggan, barang, faktur, serta menyediakan laporan penjualan yang terstruktur.

---

## ✨ Fitur Utama

-   **📊 Dasbor**: Ringkasan informasi penting dalam satu tempat.
-   **🛒 Manajemen Barang**: Tambah, ubah, dan hapus data barang.
-   **👥 Manajemen Pelanggan**: Kelola data pelanggan dengan mudah.
-   **📄 Faktur**:
    -   Lihat daftar faktur dengan detail lengkap.
    -   Tambah, edit, atau hapus faktur sesuai kebutuhan.
-   **📈 Laporan Penjualan**: Analisis data penjualan untuk mendukung keputusan bisnis.

---

## 🛠️ Teknologi yang Digunakan

-   **Framework**: Laravel 11
-   **Admin Panel**: Laravel Filament
-   **Frontend**: Blade Template Engine dengan Tailwind CSS
-   **Database**: SQLite (simple dan cepat)
-   **Autentikasi**: Laravel Breeze atau Jetstream (opsional)

---

## ⚙️ Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi:

1. **Clone repository ini**:

    ```bash
    git clone https://github.com/insa21/inventory-filament.git
    ```

2. **Masuk ke direktori project**:

    ```bash
    cd inventory-filament
    ```

3. **Instal dependensi menggunakan Composer**:

    ```bash
    composer install
    ```

4. **Salin file `.env.example` menjadi `.env`**:

    ```bash
    cp .env.example .env
    ```

5. **Atur konfigurasi database di file `.env`**:

    ```env
    DB_CONNECTION=sqlite
    DB_DATABASE=/path/to/database.sqlite
    ```

    Buat file database SQLite jika belum ada:

    ```bash
    touch database/database.sqlite
    ```

6. **Generate application key**:

    ```bash
    php artisan key:generate
    ```

7. **Jalankan migrasi database**:

    ```bash
    php artisan migrate
    ```

8. **Instal Laravel Filament**:

    ```bash
    composer require filament/filament
    ```

9. **Publish aset dan konfigurasi Filament**:

    ```bash
    php artisan filament:install
    ```

10. **(Opsional) Seed database dengan data awal**:

    ```bash
    php artisan db:seed
    ```

11. **Jalankan aplikasi**:

    ```bash
    php artisan serve
    ```

12. **Akses aplikasi di browser**:
    - Aplikasi: `http://localhost:8000`
    - Panel Admin Filament: `http://localhost:8000/admin`

---

## 🧭 Panduan Penggunaan

### 1. Kelola Data Pelanggan

Tambahkan, edit, atau hapus data pelanggan melalui menu **Kelola Customer** pada panel admin.

### 2. Kelola Data Barang

Tambahkan barang baru, edit, atau hapus data barang melalui menu **Barang**.

### 3. Kelola Faktur

-   Buat faktur baru melalui tombol **Buat** di halaman Faktur.
-   Lihat detail faktur menggunakan tombol **Lihat**.
-   Edit atau hapus faktur menggunakan tombol **Ubah** dan **Hapus**.

### 4. Laporan Penjualan

Lihat laporan penjualan melalui menu **Laporan Penjualan** untuk analisis data.

---

## 📂 Struktur Folder Penting

-   `app/Models`: Model database.
-   `app/Http/Controllers`: Controller untuk logika aplikasi.
-   `resources/views`: File tampilan Blade.
-   `routes/web.php`: Rute aplikasi umum.
-   `routes/filament.php`: Rute khusus untuk Laravel Filament.

---

## 🤝 Kontribusi

Kami menyambut kontribusi Anda! Silakan ajukan **Pull Request** atau diskusikan ide Anda melalui **Issues** di repository ini.

---

## 📜 Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).

---

## 📸 Screenshot

### 📦 Tampilan Barang

![Tampilan Barang](resources/image/Barang.png)

### 👥 Tampilan Customer

![Tampilan Customer](resources/image/customer.png)

### 📄 Tampilan Faktur

![Tampilan Faktur](resources/image/faktur.png)

### 📈 Tampilan Laporan Penjualan

![Tampilan Penjualan](resources/image/Penjualan.png)

---

🌟 **Mulai gunakan aplikasi ini dan tingkatkan produktivitas Anda!** Jika ada pertanyaan atau masukan, jangan ragu untuk menghubungi kami.
