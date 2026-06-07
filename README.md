# DOKUMENTASI LENGKAP SISTEM PREDIKSI POLA PERILAKU LANSIA

---

## BAGIAN 1: GAMBARAN APLIKASI

### Gambaran Aplikasi Sistem Prediksi Pola Perilaku Lansia

Sistem yang dibangun merupakan aplikasi berbasis web yang bertujuan untuk membantu pihak Pusat Sosial Tresna Werdha (PSTW) Kasih Sayang Ibu dalam mengelola data lansia serta melakukan prediksi pola perilaku lansia menggunakan metode Random Forest. Sistem ini dirancang agar petugas dapat memantau kondisi dan aktivitas lansia secara lebih terstruktur dan berbasis data.

---

## BAGIAN 2: HAK AKSES PENGGUNA SISTEM

### 1. Admin / Tata Usaha
* Mengelola data pengguna sistem
* Mengelola data lansia
* Mengelola data aktivitas lansia
* Mengelola data kategori perilaku
* Melihat laporan hasil prediksi

### 2. Petugas / Pengasuh
* Menginput aktivitas harian lansia
* Menginput kondisi perilaku lansia
* Melihat hasil prediksi perilaku lansia

### 3. Kepala UPTD
* Melihat laporan data lansia
* Melihat hasil prediksi pola perilaku
* Melihat statistik dan hasil evaluasi pelayanan lansia

---

## BAGIAN 3: FITUR UTAMA SISTEM

### a. Login Sistem
Pengguna masuk ke sistem menggunakan username dan password sesuai hak akses masing-masing.

### b. Dashboard
Menampilkan ringkasan data seperti:
* Total lansia
* Total aktivitas yang tercatat
* Jumlah prediksi perilaku
* Statistik perilaku lansia

### c. Data Lansia
Menu untuk mengelola data lansia, seperti:
* Nama lansia
* Umur
* Jenis kelamin
* Kondisi kesehatan
* Status sosial
* Riwayat aktivitas

### d. Data Aktivitas Lansia
Petugas dapat mencatat aktivitas harian lansia, misalnya:
* Aktivitas fisik
* Kondisi emosional
* Interaksi sosial
* Kehadiran dalam kegiatan
* Pola makan
* Kondisi kesehatan harian

### e. Prediksi Pola Perilaku Lansia (Random Forest)
Sistem melakukan prediksi berdasarkan data aktivitas yang telah diinput. Hasil prediksi dapat berupa kategori perilaku seperti:
* Stabil
* Perlu Perhatian
* Kurang Aktif
* Berisiko Mengalami Perubahan Perilaku

### f. Hasil Prediksi
Menampilkan:
* Nama lansia
* Data aktivitas
* Hasil prediksi perilaku
* Tingkat akurasi prediksi
* Riwayat prediksi

### g. Laporan
Menyediakan laporan:
* Data lansia
* Data aktivitas
* Hasil prediksi perilaku
* Rekap evaluasi perilaku lansia

---

## BAGIAN 4: ALUR SISTEM

1. Petugas login ke sistem
2. Petugas menginput data aktivitas dan perilaku lansia
3. Data tersimpan ke database
4. Sistem memproses data menggunakan metode Random Forest
5. Sistem menghasilkan prediksi pola perilaku lansia
6. Kepala UPTD dan petugas dapat melihat hasil prediksi sebagai bahan evaluasi pelayanan

---

## BAGIAN 5: TEKNOLOGI YANG DIGUNAKAN

* **Bahasa Pemrograman:** PHP
* **Database:** MySQL
* **Framework (Opsional):** Native PHP
* **Frontend:** HTML, CSS, JavaScript, Bootstrap
* **Metode Prediksi:** Random Forest

---

## BAGIAN 6: STRUKTUR FOLDER DAN KOMENTAR SETIAP FILE

```
pstw/
│
├── index.php                          # File halaman utama / landing page
├── login.php                          # File halaman login sistem
├── logout.php                         # File untuk proses logout pengguna
├── dashboard.php                      # File halaman dashboard utama
├── koneksi.php                        # File koneksi ke database MySQL
├── session.php                        # File pengelolaan session pengguna
├── auth.php                           # File autentikasi dan validasi akses pengguna
│
├── assets/                            # Folder untuk semua file statis (CSS, JS, gambar)
│   │
│   ├── css/                           # Folder stylesheet CSS
│   │   ├── style.css                  # File CSS styling utama aplikasi
│   │   ├── dashboard.css              # File CSS khusus styling dashboard
│   │   ├── form.css                   # File CSS untuk styling form-form
│   │   └── login.css                  # File CSS khusus styling halaman login
│   │
│   ├── js/                            # Folder JavaScript frontend
│   │   ├── app.js                     # File JavaScript utama aplikasi
│   │   ├── validasi.js                # File JavaScript untuk validasi form
│   │   ├── dashboard.js               # File JavaScript untuk fungsi dashboard
│   │   └── chart.js                   # File JavaScript untuk membuat grafik/chart
│   │
│   ├── img/                           # Folder untuk menyimpan gambar statis
│   │   ├── logo.png                   # File logo aplikasi
│   │   ├── user-default.png           # File gambar default user
│   │   └── bg-login.jpg               # File gambar background halaman login
│   │
│   └── vendor/                        # Folder library pihak ketiga
│       ├── bootstrap/                 # Framework CSS Bootstrap
│       ├── jquery/                    # Library jQuery
│       ├── chartjs/                   # Library Chart.js untuk membuat chart
│       └── datatables/                # Library DataTables untuk tabel interaktif
│
├── includes/                          # Folder untuk file-file include/komponen
│   ├── header.php                     # File komponen header halaman
│   ├── navbar.php                     # File komponen navbar navigasi
│   ├── sidebar.php                    # File komponen sidebar menu
│   ├── footer.php                     # File komponen footer halaman
│   └── menu.php                       # File untuk membuat menu navigasi dinamis
│
├── admin/                             # Folder halaman-halaman untuk role Admin
│   │
│   ├── dashboard.php                  # File dashboard admin
│   │
│   ├── users.php                      # File untuk mengelola data pengguna sistem
│   ├── lansia.php                     # File untuk mengelola data lansia
│   ├── aktivitas.php                  # File untuk mengelola data aktivitas lansia
│   ├── kategori_perilaku.php          # File untuk mengelola kategori perilaku
│   ├── prediksi.php                   # File untuk melihat hasil prediksi
│   │
│   └── laporan/                       # Folder laporan-laporan admin
│       ├── laporan_lansia.php         # File laporan data lansia
│       ├── laporan_aktivitas.php      # File laporan data aktivitas lansia
│       ├── laporan_prediksi.php       # File laporan hasil prediksi perilaku
│       └── evaluasi_perilaku.php      # File laporan evaluasi perilaku lansia
│
├── petugas/                           # Folder halaman-halaman untuk role Petugas
│   │
│   ├── dashboard.php                  # File dashboard petugas
│   ├── aktivitas.php                  # File untuk menginput aktivitas lansia
│   ├── kondisi_perilaku.php           # File untuk menginput kondisi perilaku lansia
│   └── prediksi.php                   # File untuk melihat hasil prediksi
│
├── kepala_uptd/                       # Folder halaman-halaman untuk role Kepala UPTD
│   │
│   ├── dashboard.php                  # File dashboard kepala UPTD
│   │
│   ├── laporan/                       # Folder laporan-laporan kepala UPTD
│   │   ├── data_lansia.php            # File laporan data lansia
│   │   ├── aktivitas_lansia.php       # File laporan aktivitas lansia
│   │   ├── hasil_prediksi.php         # File laporan hasil prediksi
│   │   └── evaluasi_pelayanan.php     # File laporan evaluasi pelayanan
│   │
│   └── statistik.php                  # File untuk menampilkan statistik dan analytics
│
├── proses/                            # Folder untuk file-file proses backend
│   ├── login_proses.php               # File proses autentikasi login pengguna
│   └── prediksi_proses.php            # File proses komputasi prediksi Random Forest
│
├── random_forest/                     # Folder untuk implementasi algoritma Random Forest
│   ├── RandomForest.php               # File class/library Random Forest utama
│   ├── dataset_training.php           # File untuk manajemen dataset training
│   ├── training_data.csv              # File data training dalam format CSV
│   └── hasil_prediksi.php             # File untuk mengelola hasil prediksi
│
├── database/                          # Folder database schema dan seeding
│   ├── db_prediksi_lansia.sql         # File SQL untuk membuat struktur database
│   └── seed_data.sql                  # File SQL untuk mengisi data awal (seeding)
│
├── uploads/                           # Folder untuk menyimpan file upload pengguna
│   ├── foto_lansia/                   # Folder untuk menyimpan foto lansia
│   ├── laporan/                       # Folder untuk menyimpan laporan yang diunduh
│   └── dataset/                       # Folder untuk menyimpan dataset yang diupload
│
└── logs/                              # Folder untuk file-file log sistem
    ├── aktivitas.log                  # File log aktivitas pengguna
    └── error.log                      # File log error dan exception
```

---

## BAGIAN 7: RANCANGAN DATABASE SISTEM

### 1. Tabel Users
**Digunakan untuk:** Menyimpan data pengguna sistem

**Nama Tabel:** `users`

| Field      | Type         | Keterangan                  |
| ---------- | ------------ | --------------------------- |
| id_user    | int PK AI    | Primary Key                 |
| nama       | varchar(100) | Nama pengguna               |
| username   | varchar(50)  | Username login              |
| password   | varchar(255) | Password hash               |
| role       | enum         | admin, petugas, kepala_uptd |
| created_at | datetime     | Tanggal dibuat              |

---

### 2. Tabel Lansia
**Digunakan untuk:** Menyimpan data lansia

**Nama Tabel:** `lansia`

| Field             | Type          | Keterangan              |
| ----------------- | ------------- | ----------------------- |
| id_lansia         | int PK AI     | Primary Key             |
| nama_lansia       | varchar(100)  | Nama lansia             |
| umur              | int           | Umur lansia             |
| jenis_kelamin     | enum('L','P') | Laki-laki atau Perempuan |
| kondisi_kesehatan | varchar(100)  | Kondisi kesehatan lansia |
| status_sosial     | varchar(100)  | Status sosial lansia    |
| foto              | text          | Path foto lansia        |
| created_at        | datetime      | Tanggal dibuat          |

---

### 3. Tabel Aktivitas Lansia
**Digunakan untuk:** Menyimpan data aktivitas harian lansia

**Nama Tabel:** `aktivitas_lansia`

| Field              | Type         | Keterangan                      |
| ------------------ | ------------ | ------------------------------- |
| id_aktivitas       | int PK AI    | Primary Key                     |
| id_lansia          | int FK       | Foreign Key ke tabel lansia     |
| aktivitas_fisik    | varchar(100) | Data aktivitas fisik lansia     |
| kondisi_emosional  | varchar(100) | Data kondisi emosional lansia   |
| interaksi_sosial   | varchar(100) | Data interaksi sosial lansia    |
| kehadiran_kegiatan | varchar(100) | Kehadiran lansia dalam kegiatan |
| pola_makan         | varchar(100) | Pola makan lansia               |
| kesehatan_harian   | varchar(100) | Kondisi kesehatan harian        |
| tanggal            | date         | Tanggal aktivitas dicatat       |
| created_by         | int FK       | Foreign Key ke tabel users      |

---

### 4. Tabel Kategori Perilaku
**Digunakan untuk:** Menyimpan kategori-kategori perilaku lansia

**Nama Tabel:** `kategori_perilaku`

| Field         | Type         | Keterangan          |
| ------------- | ------------ | ------------------- |
| id_kategori   | int PK AI    | Primary Key         |
| nama_kategori | varchar(100) | Nama kategori       |
| keterangan    | text         | Deskripsi kategori  |

**Data Default:**
* Stabil
* Perlu Perhatian
* Kurang Aktif
* Berisiko Mengalami Perubahan Perilaku

---

### 5. Tabel Prediksi
**Digunakan untuk:** Menyimpan hasil prediksi dari algoritma Random Forest

**Nama Tabel:** `prediksi`

| Field            | Type         | Keterangan                                |
| ---------------- | ------------ | ----------------------------------------- |
| id_prediksi      | int PK AI    | Primary Key                               |
| id_lansia        | int FK       | Foreign Key ke tabel lansia               |
| id_aktivitas     | int FK       | Foreign Key ke tabel aktivitas_lansia     |
| id_kategori      | int FK       | Foreign Key ke tabel kategori_perilaku    |
| akurasi          | decimal(5,2) | Tingkat akurasi prediksi (0-100)          |
| hasil_prediksi   | varchar(100) | Hasil prediksi perilaku lansia            |
| tanggal_prediksi | datetime     | Tanggal dan waktu prediksi dilakukan      |

---

### 6. Relasi Antar Tabel

```
users (1)
   │
   └──── (N) aktivitas_lansia
            │
            ▼
         lansia (1)
            │
            ├──── (N) aktivitas_lansia
            │
            └──── (N) prediksi
                     │
                     ├──── aktivitas_lansia (1)
                     │
                     └──── kategori_perilaku (1)
```

### Detail Relasi:
* `users.id_user` → `aktivitas_lansia.created_by` (One to Many)
* `lansia.id_lansia` → `aktivitas_lansia.id_lansia` (One to Many)
* `lansia.id_lansia` → `prediksi.id_lansia` (One to Many)
* `aktivitas_lansia.id_aktivitas` → `prediksi.id_aktivitas` (One to Many)
* `kategori_perilaku.id_kategori` → `prediksi.id_kategori` (Many to One)

---

## RINGKASAN

Dokumen ini menyajikan dokumentasi lengkap Sistem Prediksi Pola Perilaku Lansia yang mencakup:

✓ Gambaran aplikasi dan tujuannya
✓ Hak akses untuk 3 role pengguna (Admin, Petugas, Kepala UPTD)
✓ 7 fitur utama sistem dengan penjelasan detail
✓ Alur sistem dari login hingga evaluasi
✓ Teknologi yang digunakan
✓ Struktur folder lengkap dengan komentar untuk setiap file
✓ Desain database dengan 5 tabel utama dan relasi antar tabel

Sistem ini dirancang untuk memberikan kemudahan dalam pengelolaan data lansia dan prediksi pola perilaku menggunakan metode Random Forest, dengan akses terstruktur sesuai peran pengguna.
