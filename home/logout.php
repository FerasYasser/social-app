<?php session_start();?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>

<body>

   <?php
if(isset($_POST['logout']))
{
  $_SESSION['email']='';
 header('Location: firstpage.php');
}

    ?>


</body>
</html>
