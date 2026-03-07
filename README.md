# Javas Project Management System

Aplikasi Project Management internal berbasis web yang dibangun menggunakan Laravel 12 dan Livewire. Aplikasi ini memungkinkan tim untuk mengelola project dan memantau task melalui antarmuka Kanban Board yang modern dan minimalis.

## 🚀 Fitur Utama

- **Role-Based Access Control (RBAC):** Pemisahan hak akses antara Administrator (memiliki akses penuh) dan Member (hanya mengakses data miliknya atau yang ditugaskan kepadanya).
- **Dashboard Interaktif:** Ringkasan statistik task (To Do, In Progress, Done) dan daftar project terkini.
- **Manajemen Project:** Operasi CRUD untuk project dengan fitur pencarian (*real-time search*) dan pagination.
- **Kanban Task Board:** Manajemen task di dalam project dengan antarmuka Kanban untuk memudahkan pemantauan status.
- **Single-File Components (SFC):** Menggunakan fitur terbaru Livewire untuk performa UI yang reaktif tanpa mengorbankan prinsip *server-rendered*.

## 🛠️ Tech Stack

- **Framework:** Laravel 12.x
- **Frontend:** Laravel Livewire, Blade Templating, Tailwind CSS (Zinc Palette)
- **Database:** MySQL
- **Authentication:** Laravel Fortify (via Livewire Starter Kit)

## 📦 Panduan Instalasi & Menjalankan Aplikasi

[cite_start]Ikuti langkah-langkah berikut untuk menginstal [cite: 26] [cite_start]dan menjalankan aplikasi [cite: 27] di *local environment*:

1. **Clone repository ini**
   ```bash
   git clone <url-repository-kamu>
   cd javas-coding-challenge
   ```
2. **Install dependensi PHP dan Node.js**
   ```bash
    composer install
    npm install
    ```
3. **Setup Environment File** 
    Duplikat file .env.example menjadi .env dan generate application key.
   ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. **Konfigurasi Database**
   Buka file .env dan sesuaikan kredensial database lokal Anda (pastikan database MySQL sudah dibuat, misal: coding_challenge_javas):
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=coding_challenge_javas
    DB_USERNAME=root
    DB_PASSWORD=
    ```
5. **Jalankan Migrasi dan Database Seeder**
    Command ini akan membangun skema tabel sekaligus mengisi data dummy awal (Admin dan Members).
    ```bash
    php artisan migrate:fresh --seed
    ```
6. **Build Asset Frontend & Jalankan Server**
    Buka dua terminal terpisah dan jalankan perintah berikut:

    Terminal 1 (Untuk memproses Tailwind CSS secara real-time):
    ```bash
    npm run dev
    ```
    Terminal 2 (Untuk menjalankan server Laravel):
    ```bash
    php artisan serve
    ```
7. **Akses Aplikasi**
   Buka browser dan akses http://localhost:8000.

## 🔐 Akun Testing (Seeder)

Anda dapat menggunakan akun berikut untuk menguji otorisasi aplikasi:

| Role | Email | Password |
|------|-------|----------|
| **Administrator** | `admin@javas.com` | `password` |
| **Member 1** | `member1@javas.com` | `password` |
| **Member 2** | `member2@javas.com` | `password` |

---

## 🏗️ Arsitektur & Best Practices

Aplikasi ini mengadopsi pola arsitektur **MVC (Model-View-Controller)** yang dioptimalkan dengan ekosistem Laravel modern dan menerapkan prinsip *Clean Code*.

### 1. Model & Database Layer (Query Optimization)
Menggunakan **Eloquent ORM** dengan relasi (`Project hasMany Tasks`, `Task belongsTo Assignee`). 
Untuk menjaga performa dan menghindari *N+1 Query Problem*, aplikasi ini memanfaatkan teknik seperti:
- `withCount()` untuk menghitung relasi secara efisien di level database.
- `whereHas()` untuk memfilter data berdasarkan hak akses relasi secara dinamis.
- *Eager Loading* untuk memuat data terkait dalam satu query.

### 2. View/Controller Layer (Livewire SFC & Clean Code)
Alih-alih menggunakan Controller konvensional, logika presentasi dan penanganan state digabungkan di dalam **Livewire Single-File Components (SFC)**. 
- **Dynamic UI (Tanpa Page Reload):** Memanfaatkan Livewire untuk menciptakan interaksi dinamis (seperti *real-time search* dan pengiriman form modal) yang 100% murni *server-rendered* menggunakan Blade sesuai *requirement*, tanpa memerlukan framework JavaScript terpisah.
- **Reusable Components:** Mengekstraksi elemen UI yang kompleks (seperti Modal Form) ke dalam *Blade Components* (`<x-quick-task-modal>`) agar kode HTML tidak menumpuk dan mudah dipelihara.
- **Maintainability:** Penggunaan *Constants* pada status task untuk menghindari *magic string* dan meningkatkan keterbacaan kode.

### 3. Security & Authorization Layer
Keamanan aplikasi dijaga secara berlapis dengan memaksimalkan fitur keamanan bawaan Laravel:
- **CSRF Protection:** Seluruh form submission dan interaksi komponen (Livewire actions) dilindungi secara otomatis oleh sistem verifikasi token CSRF bawaan Laravel untuk mencegah serangan *Cross-Site Request Forgery* sesuai standar requirement.
- **RBAC (Role-Based Access Control):** Otorisasi dijaga ketat di sisi backend menggunakan **Laravel Policies** (`ProjectPolicy`, `TaskPolicy`) dan **Gates**.
  - ✅ **Member** tidak dapat memanipulasi atau melihat data milik pengguna lain.
  - ✅ **Administrator** mendapatkan akses global melalui fungsi `Gate::before`.
