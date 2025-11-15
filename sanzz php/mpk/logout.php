<?php
// mpk/logout.php
// Hentikan session dan redirect ke halaman login
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Hapus semua data session
$_SESSION = array();
// Hapus cookie session jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'], $params['httponly']
    );
}
// Hancurkan session di server
session_destroy();

// Redirect ke halaman login MPK
header('Location: login.php');
exit;
