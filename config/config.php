<?php
// Konfigurasi Supabase
// Ganti dengan URL dan API Key Supabase Anda
define('SUPABASE_URL', 'https://your-project-id.supabase.co');
define('SUPABASE_ANON_KEY', 'your-anon-key-here');

// Include Supabase client
require_once __DIR__ . '/supabase.php';

// Inisialisasi Supabase client
function getSupabaseClient() {
    return new SupabaseClient(SUPABASE_URL, SUPABASE_ANON_KEY);
}

// Function untuk response JSON
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Function untuk validasi input
function validateStudentData($data) {
    $errors = [];
    
    if (empty($data['nama'])) {
        $errors[] = 'Nama tidak boleh kosong';
    }
    
    if (empty($data['nim'])) {
        $errors[] = 'NIM tidak boleh kosong';
    } elseif (!preg_match('/^[0-9]+$/', $data['nim'])) {
        $errors[] = 'NIM harus berupa angka';
    }
    
    if (empty($data['jurusan'])) {
        $errors[] = 'Jurusan tidak boleh kosong';
    }
    
    if (empty($data['email'])) {
        $errors[] = 'Email tidak boleh kosong';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid';
    }
    
    return $errors;
}

// Function untuk sanitasi input
function sanitizeInput($data) {
    return array_map(function($value) {
        return htmlspecialchars(strip_tags(trim($value)));
    }, $data);
}
?>
