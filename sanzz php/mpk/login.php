<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container login-container">
    <h2 class="title">Login MPK</h2>

    <?php
      if (session_status() === PHP_SESSION_NONE) session_start();
      $error = "";

      if (!empty($_SESSION['login_error'])) {
          $error = $_SESSION['login_error'];
          unset($_SESSION['login_error']);
      } elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') {
          $error = "Username atau Password salah!";
      }

      // tampilkan pesan error
      if (!empty($error)) {
          echo "<div class='alert'>$error</div>";
      }
    ?>
<form action="../proses_login.php" method="post">
    <input type="hidden" name="role" value="mpk">
    <input type="text" id="username" name="username" placeholder="Masukkan username..." required>
    <input type="password" id="password" name="password" placeholder="Masukkan password..." required>

    <button type="submit">Login</button>
</form>



    <a href="loby.php" class="back-link">&larr; <b>Kembali</b></a>
  </div>

</body>
</html>
