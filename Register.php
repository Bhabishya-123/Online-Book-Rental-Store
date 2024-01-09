<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/login.css">
<script src="https://use.fontawesome.com/be1ba39dfe.js"></script>
    <link rel="stylesheet" href="./css/style.css">
<title> Register </title>
<style>
       *{
        margin:0;padding:0;
      }
</style>
</head>
<body>
  <body>
  <?php include_once './includes/navbar.php'?>

    <div class="login-page">
      <div class="form">
        <div class="login">
          <div class="login-header">
            <h3>REGISTER</h3>
            <p>Please enter your credentials to login.</p>
          </div>
        </div>
      
        <form action="./includes/register.inc.php" method="POST">
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="name" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br><br>
    
    <label for="mobile">Mobile Number:</label>
    <input type="tel" id="mobile" name="number" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="pwd" required><br><br>
    
    <button type='submit' name='submit'>Register</button>
  </form>
  <p class="message">Registered? <a href="./login.php">Login</a></p>

      </div>
    </div>
</body>
</body>
</html>