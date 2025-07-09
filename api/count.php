<?php
require_once '../config/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    $supabase = getSupabaseClient();
    $count = $supabase->count('students');
    
    jsonResponse(['count' => $count]);
    
} catch (Exception $e) {
    jsonResponse(['error' => $e->getMessage(), 'count' => 0], 500);
}
?>
