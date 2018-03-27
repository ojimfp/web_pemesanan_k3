<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

  <hgroup>
  <h1>Login</h1>
  <!-- <h3>By Josh Adamous</h3> -->
</hgroup>
<form action="login.php" method="POST">
  <div class="group">
    <input name="nik" type="text" required=""><span class="highlight"></span><span class="bar"></span>
    <label>NIK</label>
  </div>
  <div class="group"> 
    <input name="password" type="password" required=""><span class="highlight"></span><span class="bar"></span>
    <label>Password</label>
  </div>
  <input type="submit" name="" class="button buttonBlue" value="Login">
  <!-- <button type="submit" class="button buttonBlue">Login
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button> -->
</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
