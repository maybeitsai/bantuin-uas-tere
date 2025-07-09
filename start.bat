@echo off
echo =========================================
echo    CRUD App PHP Supabase - Quick Start
echo =========================================
echo.

:: Check if PHP is installed
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: PHP tidak ditemukan!
    echo Silakan install PHP terlebih dahulu.
    echo Download dari: https://www.php.net/downloads.php
    pause
    exit /b 1
)

echo PHP terdeteksi:
php --version | findstr "PHP"
echo.

:: Check if config is set up
if not exist "config\config.php" (
    echo ERROR: File konfigurasi tidak ditemukan!
    echo Pastikan file config\config.php sudah ada.
    pause
    exit /b 1
)

:: Check Supabase configuration
findstr "your-project-id" config\config.php >nul
if %errorlevel% equ 0 (
    echo.
    echo ⚠️  PERINGATAN: Konfigurasi Supabase belum diatur!
    echo.
    echo Silakan edit file config\config.php dan ganti:
    echo - SUPABASE_URL dengan URL project Supabase Anda
    echo - SUPABASE_ANON_KEY dengan API key Supabase Anda
    echo.
    echo Tekan Enter untuk melanjutkan atau Ctrl+C untuk membatalkan...
    pause >nul
)

echo.
echo Starting PHP Development Server...
echo.
echo 🚀 Server berjalan di: http://localhost:8000
echo.
echo Halaman yang tersedia:
echo • Beranda: http://localhost:8000/
echo • Data Mahasiswa: http://localhost:8000/students.php
echo • Test API: http://localhost:8000/test-api.php
echo.
echo Tekan Ctrl+C untuk menghentikan server
echo.

php -S localhost:8000
