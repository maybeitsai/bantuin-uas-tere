# Web CRUD Sederhana dengan PHP, Tailwind CSS & Supabase

Aplikasi web dinamis untuk mengelola data mahasiswa dengan operasi CRUD (Create, Read, Update, Delete) menggunakan PHP, Tailwind CSS, dan database Supabase.

## 🚀 Fitur Utama

- ✅ **CRUD Lengkap**: Tambah, Lihat, Edit, dan Hapus data mahasiswa
- ✅ **Real-time Database**: Menggunakan Supabase sebagai backend database
- ✅ **UI Modern**: Interface yang responsif dengan Tailwind CSS
- ✅ **Validasi Data**: Validasi input di sisi client dan server
- ✅ **Search & Filter**: Pencarian dan filter berdasarkan jurusan
- ✅ **Notifikasi**: SweetAlert2 untuk notifikasi user-friendly
- ✅ **API REST**: Endpoint API yang terstruktur dengan baik

## 📁 Struktur Proyek

```
bantuin-uts-tere/
├── config/
│   ├── config.php          # Konfigurasi utama
│   └── supabase.php        # Client Supabase
├── api/
│   ├── students.php        # API endpoint untuk data mahasiswa
│   └── count.php          # API untuk menghitung total mahasiswa
├── index.php              # Halaman utama
├── students.php           # Halaman kelola data mahasiswa
└── README.md             # Dokumentasi
```

## 🛠️ Setup dan Instalasi

### 1. Persiapan Database Supabase

1. **Buat Akun Supabase**

   - Kunjungi [supabase.com](https://supabase.com)
   - Daftar dan buat project baru

2. **Buat Tabel Students**

   ```sql
   CREATE TABLE students (
       id SERIAL PRIMARY KEY,
       nim VARCHAR(20) UNIQUE NOT NULL,
       nama VARCHAR(100) NOT NULL,
       jurusan VARCHAR(50) NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       created_at TIMESTAMP DEFAULT NOW()
   );
   ```

3. **Set Row Level Security (RLS)**

   ```sql
   -- Enable RLS
   ALTER TABLE students ENABLE ROW LEVEL SECURITY;

   -- Create policy untuk akses publik (untuk demo)
   CREATE POLICY "Allow all operations" ON students
   FOR ALL USING (true) WITH CHECK (true);
   ```

### 2. Konfigurasi Aplikasi

1. **Edit file config/config.php**

   ```php
   define('SUPABASE_URL', 'https://your-project-id.supabase.co');
   define('SUPABASE_ANON_KEY', 'your-anon-key-here');
   ```

2. **Dapatkan Kredensial Supabase**
   - Buka dashboard Supabase project Anda
   - Pergi ke Settings → API
   - Copy **Project URL** dan **anon public key**
   - Paste ke file config.php

### 3. Menjalankan Aplikasi

1. **Setup Local Server**

   ```bash
   # Menggunakan PHP Built-in Server
   php -S localhost:8000

   # Atau menggunakan XAMPP/WAMP
   # Letakkan folder di htdocs/www
   ```

2. **Akses Aplikasi**
   - Buka browser: `http://localhost:8000`
   - Atau: `http://localhost/bantuin-uts-tere`

## 🎯 Cara Penggunaan

### 1. Halaman Utama (index.php)

- Dashboard dengan informasi statistik
- Navigasi ke halaman kelola data mahasiswa
- Tampilan total mahasiswa secara real-time

### 2. Kelola Data Mahasiswa (students.php)

- **Tambah Mahasiswa**: Klik tombol "Tambah Mahasiswa"
- **Edit Data**: Klik ikon edit pada baris data
- **Hapus Data**: Klik ikon hapus (dengan konfirmasi)
- **Pencarian**: Gunakan search box untuk mencari mahasiswa
- **Filter**: Filter berdasarkan jurusan

### 3. API Endpoints

| Method | URL                      | Deskripsi                     |
| ------ | ------------------------ | ----------------------------- |
| GET    | `/api/students.php`      | Ambil semua data mahasiswa    |
| GET    | `/api/students.php?id=1` | Ambil data mahasiswa spesifik |
| POST   | `/api/students.php`      | Tambah mahasiswa baru         |
| PUT    | `/api/students.php?id=1` | Update data mahasiswa         |
| DELETE | `/api/students.php?id=1` | Hapus data mahasiswa          |
| GET    | `/api/count.php`         | Hitung total mahasiswa        |

## 🔧 Kustomisasi

### Menambah Field Baru

1. **Update Database Schema**

   ```sql
   ALTER TABLE students ADD COLUMN semester INTEGER;
   ```

2. **Update Form HTML** (students.php)

   ```html
   <div>
     <label>Semester</label>
     <input type="number" x-model="form.semester" />
   </div>
   ```

3. **Update Validasi** (config/config.php)
   ```php
   if (empty($data['semester'])) {
       $errors[] = 'Semester tidak boleh kosong';
   }
   ```

### Mengubah Tampilan

- Edit file CSS inline di `<head>` section
- Modifikasi class Tailwind CSS sesuai kebutuhan
- Customize warna dengan mengubah class `bg-blue-600`, `text-blue-600`, dll

## 🔒 Keamanan

### Implementasi yang Sudah Ada:

- ✅ Input sanitization dengan `htmlspecialchars()`
- ✅ Validasi data di server-side
- ✅ Prepared statements (melalui Supabase)
- ✅ CORS headers untuk API

### Saran Pengembangan Lebih Lanjut:

- 🔄 Implementasi autentikasi user
- 🔄 Rate limiting untuk API
- 🔄 Logging untuk audit trail
- 🔄 Environment variables untuk kredensial

## 🐛 Troubleshooting

### Error Connection Supabase

```
Error: API Error: Invalid API key
```

**Solusi**: Pastikan SUPABASE_URL dan SUPABASE_ANON_KEY sudah benar

### CORS Error

```
Access to fetch at 'api/students.php' from origin 'http://localhost:8000' has been blocked
```

**Solusi**: Headers CORS sudah diset di file API, pastikan server PHP berjalan dengan benar

### Database Table Not Found

```
relation "students" does not exist
```

**Solusi**: Pastikan tabel students sudah dibuat di Supabase

## 📚 Teknologi yang Digunakan

- **Frontend**: HTML5, Tailwind CSS, Alpine.js
- **Backend**: PHP 7.4+
- **Database**: Supabase (PostgreSQL)
- **UI Components**: Font Awesome, SweetAlert2
- **API**: REST API dengan JSON response

## 🤝 Kontribusi

Jika ingin berkontribusi:

1. Fork repository ini
2. Buat branch feature baru
3. Commit perubahan Anda
4. Push ke branch
5. Buat Pull Request

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Bebas digunakan untuk keperluan pembelajaran dan pengembangan.

---

**Developed with ❤️ using PHP & Supabase**
