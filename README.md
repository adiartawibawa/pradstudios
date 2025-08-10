# PRADStudio Website

Proyek ini adalah website portofolio dinamis untuk **PRADStudio** yang dibangun menggunakan **TALL Stack** dengan integrasi **Filament Admin** untuk pengelolaan konten.
Seluruh data, termasuk setiap section halaman, dapat diatur secara dinamis melalui panel admin.

---

## 📜 Deskripsi

Website ini dirancang untuk menampilkan profil perusahaan, layanan, portofolio, klien, tim, dan informasi lain yang relevan secara profesional.
Dengan dukungan pengelolaan berbasis database, semua konten dapat diubah tanpa perlu menyentuh kode, memudahkan pengelolaan oleh tim non-teknis.

---

## ✨ Fitur Utama

-   **Konten Dinamis**
    Semua teks, gambar, dan informasi pada setiap section dapat diubah dari panel admin.

-   **Manajemen Layanan (Services)**
    Menambahkan, mengedit, atau menghapus layanan yang ditawarkan.

-   **Portofolio Proyek (Projects)**
    Menampilkan daftar proyek yang pernah dikerjakan, lengkap dengan gambar, deskripsi, kategori, dan tautan terkait.

-   **Manajemen Teknologi (Technologies)**
    Mengelola daftar teknologi yang digunakan dalam setiap proyek.

-   **Klien (Clients)**
    Menyimpan data klien yang pernah bekerja sama, termasuk logo dan informasi perusahaan.

-   **Testimoni (Testimonials)**
    Mengelola ulasan dari klien dengan rating dan tanggal.

-   **Tim (Team Members)**
    Menampilkan profil anggota tim beserta jabatan, departemen, dan tautan media sosial.

-   **Insight / Highlight**
    Menyimpan ringkasan studi kasus atau pencapaian penting.

-   **Pengaturan Section (Sections)**
    Mengatur konten setiap bagian halaman (intro, about, showcase, dsb.) secara fleksibel.

-   **Halaman Statis (Pages)**
    Membuat halaman tambahan dengan SEO metadata.

-   **Form Kontak (Contact Submissions)**
    Menyimpan semua pesan yang dikirimkan melalui formulir kontak.

-   **Pengaturan Global (Settings)**
    Menyimpan informasi umum dan konfigurasi website seperti nama perusahaan, logo, kontak, dan lainnya.

-   **Soft Delete & Arsip**
    Semua data dapat dihapus sementara (soft delete) dan dipulihkan kapan saja.

-   **Urutan & Status**
    Setiap data dapat diatur urutannya (`sort_order`) serta status tampil (`is_active`, `is_published`, `is_featured`).

---

## ⚙️ Instalasi Singkat

1. Clone repository

    ```bash
    git clone https://github.com/adiartawibawa/pradstudios.git
    cd pradstudios
    ```

2. Install dependencies

    ```bash
    composer install
    npm install
    ```

3. Salin `.env` & atur konfigurasi

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Migrasi database

    ```bash
    php artisan migrate
    ```

5. Jalankan server

    ```bash
    php artisan serve
    npm run dev
    ```

---

## 🔑 Akses Panel Admin

1. Buat user admin Filament

    ```bash
    php artisan make:filament-user
    ```

2. Login melalui `/admin` dengan akun yang sudah dibuat.

---

## 📄 Lisensi

MIT License © 2025 PRADStudio
