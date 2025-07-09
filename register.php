<?php
require 'db.php';
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['submit']))
{
    $name=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password) 
            VALUES ('$name', '$email', '$password')";
    $result=mysqli_query($conn,$sql);
    if (!$result) {
        $_SESSION['messageBox'] = true;
        $_SESSION['messageType'] = 'error';
        $_SESSION['messageTitle'] = 'Error';
        $_SESSION['messageText'] = 'Registration failed: ' . mysqli_error($conn);
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['messageBox'] = true;
        $_SESSION['messageType'] = 'success';
        $_SESSION['messageTitle'] = 'Registration Complete';
        $_SESSION['messageText'] = 'Your account has been created. You can now log in.';
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Recipe Finder</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="register.css">
  <link rel="stylesheet" href="message.css">
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="logo"><span class="logo-icon"></span>Recipe Finder</div>
      <div class="welcome-title">Create Your Account</div>
      <div class="welcome-desc">Sign up to get started with your special place</div>
      <form class="register-form" action="register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
     
        <button class="register-btn" type="submit" name="submit">Register</button>
      </form>
      <div class="login-link">Already have an account? <a href="login.php">Login</a></div>
      <?php include 'message-box.php'; ?>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
</html>