<?php
session_start();
require 'vendor/autoload.php'; // Load Composer autoload

use Supabase\SupabaseClient;

// Koneksi ke Supabase
$url = 'https://jesutzypuucxagotaqxi.supabase.co';
$key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Implc3V0enlwdXVjeGFnb3RhcXhpIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzQ2NzU5ODMsImV4cCI6MjA1MDI1MTk4M30.Uvb6DpL-4KfwRCsUqhL3PbgGdUAuKzFy_uE54AtKZy4';
$supabase = new SupabaseClient($url, $key);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (empty($username) || empty($password)) {
        $error = "Nama pengguna dan kata sandi tidak boleh kosong.";
    } else {
        // Query ke Supabase
        $response = $supabase->from('users')->select('*')->eq('username', $username)->execute();

        if ($response && isset($response['data'][0])) {
            $user = $response['data'][0];

            // Validasi password
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                header('Location: /Public/index.html');
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}

// Tambahkan logging error jika diperlukan
if (isset($error)) {
    error_log("Login error: $error");
}
