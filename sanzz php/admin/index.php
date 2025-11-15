<?php
session_start();
$error = "";

if (!empty($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<!-- FIX PENTING: class="login-page" -->
<body class="login-page">

<div class="login-box">
    <h2>Login Admin</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form action="../proses_login.php" method="post">
        <input type="hidden" name="role" value="admin">

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
