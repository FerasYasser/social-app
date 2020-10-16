<?php session_start();?>
<html>

<head>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="validation.js"></script>
</head>

<body>
<form action="processing.php" method="post" onsubmit="return validateLogin();">
<div class="centerAlign">
<br> <br> <br> <br> <br>
<h1 class="h1">Login</h1>
<br> <br> <br> <br> <br>
<br> <br> <br> <br>

  <input class="input" type="text" placeholder="Enter email" id="email" name="email">
  <br><br><br>
  <input class="input" type="password" placeholder="Enter Password" id="pass" name="pass">
  <br><br><br><br>
  <button class="button" type="submit" name="loginbtn" onclick="validateLogin();">
    Login</button>
  <br><br><br><br>
</div>
</form>

</body>

</html>
