<?php
session_start();

// Versi lokal saya
include 'functions.php';
echo "Login page dari versi lokal";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="form.css">
</head>
<body>
  <div class="back">
    <a href="index.php"><i class='bxr  bx-arrow-left-stroke'  ></i></a>
  </div>
    

    <div class="wrapper">
      <form action="auth.php" method="POST">
        <h1>Login</h1>

<?php if(isset($_GET['error'])): ?>
      <p class="error">Username atau Passwor salah</p>
      <?php endif; ?>

        <div class="input-box">
           <input type="text" id="username" name="username" placeholder="Username"
           required>
           <i class='bx  bx-user'  ></i> 
        </div>
                <div class="input-box">
           <input type="password" id="password" name="password" placeholder="Password"
           required>
           <i class='bx  bx-lock'  ></i> 
        </div>
        
        <div class="remember-forgot">
          <label for=""><input type="checkbox">Remember me</label>
          <a href="#">Forgot password?</a>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="register-link">
            <p>Don't have an account? <a
                 href="#">Register</a></p>
        </div>
      </form>
    </div>
</body>
</html>