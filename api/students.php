<?php
require_once '../config/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

try {
    $supabase = getSupabaseClient();
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                // Get single student
                $students = $supabase->select('students', '*', ['id' => $_GET['id']]);
                if (empty($students)) {
                    jsonResponse(['error' => 'Mahasiswa tidak ditemukan'], 404);
                }
                jsonResponse($students[0]);
            } else {
                // Get all students
                $students = $supabase->select('students', '*');
                jsonResponse($students);
            }
            break;
            
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                jsonResponse(['error' => 'Data tidak valid'], 400);
            }
            
            $sanitized = sanitizeInput($input);
            $errors = validateStudentData($sanitized);
            
            if (!empty($errors)) {
                jsonResponse(['errors' => $errors], 400);
            }
            
            // Check if NIM already exists
            $existing = $supabase->select('students', 'id', ['nim' => $sanitized['nim']]);
            if (!empty($existing)) {
                jsonResponse(['error' => 'NIM sudah terdaftar'], 409);
            }
            
            $result = $supabase->insert('students', $sanitized);
            jsonResponse(['message' => 'Mahasiswa berhasil ditambahkan', 'data' => $result[0]], 201);
            break;
            
        case 'PUT':
            if (!isset($_GET['id'])) {
                jsonResponse(['error' => 'ID tidak ditemukan'], 400);
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                jsonResponse(['error' => 'Data tidak valid'], 400);
            }
            
            $sanitized = sanitizeInput($input);
            $errors = validateStudentData($sanitized);
            
            if (!empty($errors)) {
                jsonResponse(['errors' => $errors], 400);
            }
            
            // Check if NIM already exists for other students
            $existing = $supabase->select('students', 'id', ['nim' => $sanitized['nim']]);
            if (!empty($existing) && $existing[0]['id'] != $_GET['id']) {
                jsonResponse(['error' => 'NIM sudah terdaftar'], 409);
            }
            
            $result = $supabase->update('students', $sanitized, ['id' => $_GET['id']]);
            
            if (empty($result)) {
                jsonResponse(['error' => 'Mahasiswa tidak ditemukan'], 404);
            }
            
            jsonResponse(['message' => 'Mahasiswa berhasil diperbarui', 'data' => $result[0]]);
            break;
            
        case 'DELETE':
            if (!isset($_GET['id'])) {
                jsonResponse(['error' => 'ID tidak ditemukan'], 400);
            }
            
            // Check if student exists
            $existing = $supabase->select('students', 'id', ['id' => $_GET['id']]);
            if (empty($existing)) {
                jsonResponse(['error' => 'Mahasiswa tidak ditemukan'], 404);
            }
            
            $supabase->delete('students', ['id' => $_GET['id']]);
            jsonResponse(['message' => 'Mahasiswa berhasil dihapus']);
            break;
            
        default:
            jsonResponse(['error' => 'Method tidak didukung'], 405);
            break;
    }
    
} catch (Exception $e) {
    jsonResponse(['error' => $e->getMessage()], 500);
}
?>
