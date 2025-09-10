# Aplikasi Arsip Surat Desa Karangduren  

## Deskripsi  
Aplikasi ini merupakan sistem arsip digital yang dibangun sebagai bagian dari praktik demonstrasi Sertifikasi LSP pada bidang pengembangan perangkat lunak. Sistem berbasis web ini dirancang untuk mengelola arsip surat.

Setiap surat dipindai (scan) dalam format PDF dan diunggah ke dalam sistem. Aplikasi menyediakan fitur pencarian berdasarkan judul, pengunduhan arsip, serta pengelolaan kategori surat. Dengan demikian, pengelolaan arsip menjadi lebih terstruktur, mudah diakses, dan efisien.  

---

## Tujuan  
- Membuktikan kemampuan peserta dalam merancang dan mengimplementasikan aplikasi berbasis web sesuai kebutuhan pengguna  
- Memberikan solusi pengarsipan surat resmi desa dalam bentuk digital  
- Memenuhi instruksi kerja praktik ujian sertifikasi LSP  

---

## Fitur Aplikasi  
### 1. Manajemen Arsip Surat
   - Upload file surat dalam format PDF
   - Pencarian arsip berdasarkan judul surat
   - Aksi: Lihat, Unduh, Hapus (dengan konfirmasi)

### 2. Form Tambah/Edit Surat
   - Input judul surat
   - Pilih kategori (Undangan, Pengumuman, Nota Dinas, Pemberitahuan)
   - Validasi file hanya menerima PDF
   - Notifikasi berhasil disimpan

### 3. Manajemen Kategori Surat
   - Melihat daftar kategori yang ada
   - Menambah kategori baru
   - Mengedit kategori yang sudah ada
   - Menghapus kategori
   - ID kategori otomatis (auto increment)

### 4. Pratinjau Arsip
   - Menampilkan detail arsip surat
   - Tombol kembali ke halaman utama
   - Tombol unduh untuk menyimpan file PDF

### 5. Halaman About
   - Menampilkan foto pembuat, nama, NIM, serta tanggal pembuatan aplikasi

---

## Teknologi yang Digunakan  
- **Framework**: Laravel 12
- **Database**: MySQL 8
- **Bahasa Pemrograman**: PHP 8.x
- **Frontend**: Blade Template + Tailwind CSS

---

## Cara Menjalankan Aplikasi  

### 1. Clone Repository
```bash
git clone https://github.com/username/arsip-surat.git
cd arsip-surat
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run dev
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`, lalu sesuaikan dengan konfigurasi database:
```
DB_DATABASE=arsip_surat
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi Database
```bash
php artisan migrate
```

Atau impor file `arsip_surat.sql` yang disediakan.

### 5. Menjalankan Server
```bash
php artisan serve
```

Aplikasi dapat diakses melalui http://127.0.0.1:8000.

---

## Dokumentasi Tampilan

### Halaman Utama (Arsip Surat)
<img width="1920" height="1020" alt="image" src="https://github.com/user-attachments/assets/2ffc62bf-d366-4c15-b570-0975e098200f" />

### Form Tambah Arsip
<img width="1920" height="1020" alt="image" src="https://github.com/user-attachments/assets/304f208d-48b2-4fe6-b6bf-8cdce945e16a" />

### Konfirmasi Hapus
<img width="1920" height="1020" alt="image" src="https://github.com/user-attachments/assets/34ecc33e-88ad-43c9-b6dd-d390c150d8df" />

### Detail Surat
<img width="1920" height="1020" alt="image" src="https://github.com/user-attachments/assets/cc318c0e-adbf-41f1-91ea-ac01c65aa675" />

### Manajemen Kategori
<img width="1920" height="1020" alt="image" src="https://github.com/user-attachments/assets/896edfe2-5cdc-4037-9f67-2aaaba6b62c9" />

### Halaman About
<img width="1900" height="856" alt="image" src="https://github.com/user-attachments/assets/44aae2ac-5833-4b5b-ad46-78c24ab41dd2" />

---

## Catatan  
Aplikasi ini dibuat untuk memenuhi kebutuhan ujian praktik Sertifikasi LSP bidang pengembangan perangkat lunak, dan sebagai simulasi implementasi sistem informasi arsip surat.
