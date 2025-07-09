-- SQL untuk membuat tabel students di Supabase
-- Jalankan query ini di SQL Editor Supabase

-- 1. Membuat tabel students
CREATE TABLE students (
    id SERIAL PRIMARY KEY,
    nim VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW()
);

-- 2. Membuat function untuk update timestamp
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ language 'plpgsql';

-- 3. Membuat trigger untuk auto-update timestamp
CREATE TRIGGER update_students_updated_at 
    BEFORE UPDATE ON students 
    FOR EACH ROW 
    EXECUTE FUNCTION update_updated_at_column();

-- 4. Enable Row Level Security (RLS)
ALTER TABLE students ENABLE ROW LEVEL SECURITY;

-- 5. Membuat policy untuk akses public (untuk demo)
-- PERINGATAN: Ini memberikan akses penuh ke semua orang
-- Untuk production, sesuaikan dengan kebutuhan keamanan Anda
CREATE POLICY "Allow all operations on students" ON students
    FOR ALL USING (true) WITH CHECK (true);

-- 6. Insert data contoh (opsional)
INSERT INTO students (nim, nama, jurusan, email) VALUES
('2021001', 'Ahmad Rizki Pratama', 'Teknik Informatika', 'ahmad.rizki@email.com'),
('2021002', 'Siti Nurhaliza', 'Sistem Informasi', 'siti.nurhaliza@email.com'),
('2021003', 'Budi Santoso', 'Teknik Komputer', 'budi.santoso@email.com'),
('2021004', 'Dewi Sartika', 'Manajemen Informatika', 'dewi.sartika@email.com'),
('2021005', 'Eko Prasetyo', 'Teknik Informatika', 'eko.prasetyo@email.com');

-- 7. Verifikasi data
SELECT * FROM students ORDER BY created_at DESC;
