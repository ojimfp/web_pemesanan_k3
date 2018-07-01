<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <hgroup>
    <h1></h1>
  </hgroup>
  <form style="border-radius: 20px;" action="login.php" method="POST">
    <span class="login100-form-logo">
      <i><img style="border-radius: 40px;" src="bg.jpg"></i>
    </span><br><br>
    <div class="group">
      <input name="nip" type="text" required=""><span class="highlight"></span><span class="bar"></span>
      <label>Kode User</label>
    </div>
    <div class="group"> 
      <input name="password" type="password" required=""><span class="highlight"></span><span class="bar"></span>
      <label>Password</label>
    </div>
    <input type="submit" name="" class="button buttonBlue" value="Login">
  </form>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>
</body>

</html>