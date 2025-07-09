# Setup Database Supabase untuk CRUD App

## Langkah-langkah Setup:

### 1. Buat Project Supabase

1. Kunjungi [supabase.com](https://supabase.com)
2. Login atau daftar akun baru
3. Klik "New Project"
4. Isi detail project:
   - Name: `crud-mahasiswa`
   - Database Password: [buat password yang kuat]
   - Region: pilih yang terdekat (Singapore untuk Indonesia)
5. Klik "Create new project"
6. Tunggu hingga project siap (biasanya 1-2 menit)

### 2. Dapatkan Kredensial API

1. Di dashboard project, buka tab **Settings** → **API**
2. Copy **Project URL** dan **anon public** key
3. Simpan untuk digunakan di konfigurasi

### 3. Jalankan SQL Setup

1. Di dashboard Supabase, buka **SQL Editor**
2. Copy semua kode dari file `database/setup.sql`
3. Paste di SQL Editor dan klik **Run**
4. Verifikasi tabel berhasil dibuat

### 4. Konfigurasi Aplikasi

1. Edit file `config/config.php`
2. Ganti placeholder dengan kredensial yang sudah didapat:
   ```php
   define('SUPABASE_URL', 'https://your-project-id.supabase.co');
   define('SUPABASE_ANON_KEY', 'your-anon-key-here');
   ```

### 5. Test Koneksi

1. Jalankan aplikasi dengan `.\start.bat` (Windows) atau `php -S localhost:8000`
2. Buka http://localhost:8000/test-api.php
3. Klik "Test Connection" untuk memverifikasi koneksi

## Struktur Tabel Students

| Column     | Type         | Constraints      |
| ---------- | ------------ | ---------------- |
| id         | SERIAL       | PRIMARY KEY      |
| nim        | VARCHAR(20)  | UNIQUE, NOT NULL |
| nama       | VARCHAR(100) | NOT NULL         |
| jurusan    | VARCHAR(50)  | NOT NULL         |
| email      | VARCHAR(100) | UNIQUE, NOT NULL |
| created_at | TIMESTAMP    | DEFAULT NOW()    |
| updated_at | TIMESTAMP    | DEFAULT NOW()    |

## Row Level Security (RLS)

Untuk keamanan production, disarankan untuk:

1. **Update Policy** - Ganti policy yang permissive dengan yang lebih spesifik
2. **Authentication** - Implementasi sistem login
3. **Role-based Access** - Buat role untuk admin dan user

### Contoh Policy Lebih Aman:

```sql
-- Hapus policy lama
DROP POLICY "Allow all operations on students" ON students;

-- Buat policy baru dengan autentikasi
CREATE POLICY "Authenticated users can view students" ON students
    FOR SELECT USING (auth.role() = 'authenticated');

CREATE POLICY "Authenticated users can insert students" ON students
    FOR INSERT WITH CHECK (auth.role() = 'authenticated');
```

## Troubleshooting

### Error: "relation students does not exist"

- Pastikan SQL di `database/setup.sql` sudah dijalankan
- Verifikasi tabel ada di **Table Editor** Supabase

### Error: "Invalid API key"

- Periksa SUPABASE_URL dan SUPABASE_ANON_KEY di config.php
- Pastikan tidak ada spasi atau karakter tambahan

### Error: "Row Level Security"

- Pastikan RLS sudah di-enable
- Verifikasi policy sudah dibuat dengan benar

### CORS Error

- File .htaccess sudah mengatur CORS headers
- Untuk development lokal, error ini normal dan bisa diabaikan

## Data Sample

Setelah setup selesai, akan ada 5 data sample mahasiswa:

- Ahmad Rizki Pratama (2021001)
- Siti Nurhaliza (2021002)
- Budi Santoso (2021003)
- Dewi Sartika (2021004)
- Eko Prasetyo (2021005)

## Backup & Restore

### Backup Data:

```sql
SELECT * FROM students ORDER BY created_at;
```

### Restore Data:

```sql
INSERT INTO students (nim, nama, jurusan, email)
VALUES ('NIM', 'Nama', 'Jurusan', 'email@example.com');
```
