<?php session_start();?>
<html>

<head>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<div>
  <br> <br> <br> <br> <br>
<h1 class="h1"> Welcome to My Website</h1>

<script>
var message = "<?php echo("{$_SESSION['message']}")?>";

if(!empty(message))
alert(message);
</script>
</div>
<br> <br> <br> <br> <br>
<br> <br> <br> <br> <br>
<br> <br>
<div>
<button class="button" onClick="window.location='registerpage.php'">
 Register </button>
</div>
<br><br><br>
<div>
<h4 class="h4"> Already have an account?</h4>
<button class="button" onClick="window.location='loginpage.php'">
Sign in</button>
</div>

</body>
</html>
