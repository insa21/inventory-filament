# Laravel Invoice Management System

Aplikasi ini adalah sistem manajemen faktur yang dibangun menggunakan framework **Laravel** dengan integrasi **Laravel Filament**. Aplikasi ini dirancang untuk mempermudah pengelolaan data pelanggan, barang, dan faktur dengan fitur CRUD (Create, Read, Update, Delete) serta laporan penjualan.

---

## ✨ Fitur Utama

1. **Dasbor**: Menampilkan ringkasan informasi utama.
2. **Manajemen Barang**: Kelola data barang dengan mudah.
3. **Manajemen Pelanggan**: Atur data pelanggan Anda.
4. **Manajemen Faktur**:
    - Menampilkan daftar faktur.
    - Melihat detail faktur.
    - Menambahkan, mengedit, dan menghapus faktur.
5. **Laporan Penjualan**: Analisis data penjualan dengan laporan yang terstruktur.

---

## 🛠️ Teknologi yang Digunakan

-   **Framework**: Laravel 11
-   **Admin Panel**: Laravel Filament
-   **Frontend**: Blade Template Engine dengan Tailwind CSS
-   **Database**: SQLite
-   **Autentikasi**: Laravel Breeze atau Jetstream (opsional)

---

## ⚙️ Instalasi

1. **Clone repository ini**:

    ```bash
    git clone <repository-url>
    ```

2. **Masuk ke direktori project**:

    ```bash
    cd <nama-folder>
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

10. (Opsional) **Seed database dengan data awal**:

```bash
php artisan db:seed
```

11. **Jalankan aplikasi**:

```bash
php artisan serve
```

12. **Akses aplikasi di browser**:

-   Aplikasi: `http://localhost:8000`
-   Panel Admin Filament: `http://localhost:8000/admin`

---

## 🧭 Cara Penggunaan

### Kelola Data Pelanggan

-   Tambahkan pelanggan baru melalui menu **Kelola Customer** di panel admin Filament.
-   Edit atau hapus data pelanggan sesuai kebutuhan.

### Kelola Data Barang

-   Tambahkan data barang melalui menu **Barang**.
-   Edit atau hapus data barang yang sudah terdaftar.

### Kelola Faktur

-   Tambahkan faktur baru melalui tombol **Buat** di halaman Faktur.
-   Lihat detail faktur menggunakan tombol **Lihat**.
-   Edit atau hapus faktur menggunakan tombol **Ubah** dan **Hapus**.

### Laporan Penjualan

-   Analisis data penjualan melalui menu **Laporan Penjualan**.

---

## 📁 Struktur Folder Penting

-   `app/Models`: Berisi model database.
-   `app/Http/Controllers`: Berisi controller untuk logika aplikasi.
-   `resources/views`: Berisi file tampilan Blade.
-   `routes/web.php`: Berisi rute aplikasi.
-   `routes/filament.php`: Berisi rute khusus untuk Laravel Filament.

---

## 🤝 Kontribusi

Kami menyambut kontribusi Anda! Silakan ajukan pull request atau diskusikan ide Anda di bagian **Issues**.

---

## 📜 Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).

---

## 📸 Screenshot

### Tampilan Barang

![Tampilan Barang](resources/image/Barang.png)

### Tampilan Customer

![Tampilan Customer](resources/image/customer.png)

### Tampilan Faktur

![Tampilan Faktur](resources/image/faktur.png)

### Tampilan Laporan Penjualan

![Tampilan Penjualan](resources/image/Penjualan.png)

---

💡 **Terima kasih telah menggunakan aplikasi ini!** Jika Anda memiliki pertanyaan atau masukan, jangan ragu untuk menghubungi kami.
