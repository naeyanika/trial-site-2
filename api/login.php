<?php
// api/login.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';
use Supabase\SupabaseClient;

$url = 'https://jesutzypuucxagotaqxi.supabase.co';
$key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Implc3V0enlwdXVjeGFnb3RhcXhpIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzQ2NzU5ODMsImV4cCI6MjA1MDI1MTk4M30.Uvb6DpL-4KfwRCsUqhL3PbgGdUAuKzFy_uE54AtKZy4';
$supabase = new SupabaseClient($url, $key);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $error = "Nama pengguna dan kata sandi tidak boleh kosong.";
    } else {
        try {
            $response = $supabase->from('users')
                                ->select('*')
                                ->eq('username', $username)
                                ->execute();

            if ($response && isset($response['data'][0])) {
                $user = $response['data'][0];
                
                if ($password === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['logged_in'] = true;
                    
                    // Redirect ke root index.php
                    header('Location: ../index.php');
                    exit();
                } else {
                    $error = "Password salah!";
                }
            } else {
                $error = "Username tidak ditemukan!";
            }
        } catch (Exception $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
            error_log("Login error: " . $e->getMessage());
        }
    }
    
    // Jika ada error, kirim response JSON
    if (isset($error)) {
        http_response_code(401);
        echo json_encode(['error' => $error]);
        exit();
    }
}
?>