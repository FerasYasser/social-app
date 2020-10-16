<?php session_start();?>

<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<h1 class="h1"> Hamdela 3al Salama </h1>
<br><br><br>
<div class="h2">
<?php
 echo "Welcome ".'<br><br>';
$email = $_SESSION['email'];
echo $email;
 ?>
 <<?php
 require 'dbhandler.php';

 $email = $_SESSION['email'];
 $query = " SELECT  email1 From `friends` WHERE (email2='$email' AND relation is null);";
 $q = mysqli_query($connect,$query);
 $result=mysqli_num_rows($q);
 if($result==0) echo "<br>"."no friends requests";
 if($result>0)
 {
   $row=mysqli_fetch_row($q);
   echo "<br>"."you have ";
   echo $result;
   echo " frined requests";
 }
 ?>

</div>
<form action="about.php" method="post">
  <label class="label1">gggggggggggggggggggggggggggggggggfffffffffffffffffttt5 </label>

      <button class="about" type="submit" name="about" onclick="about.php">About</button>

    </form>
    <form  action="search.php" method="post" autocomplete="off">
        <input class="input" type="text" placeholder="search" name="search1" id="search1">
<br><br>

          <button class="button1" type="submit" name="search" onclick="search.php">search</button>
        </form>
        <form  method="post">


              <button class="friendreq" type="submit" name="friendreq">friend request</button>
            </form>

            <form  method="post" action="friends.php">


                  <button class="friends" type="submit" name="friends">friends</button>
                </form>
            <form action="profile.php" method="post">


                  <button class="profile" type="submit" name="profile">profile</button>
                </form>
                <form action="timeline.php" method="post">


                      <button class="timeline" type="submit" name="timeline">timeline</button>
                    </form>
                    <form action="editp.php" method="post">


                          <button class="editpp" type="submit" name="editp">edit profile pic</button>
                        </form>
                        <form action="logout.php" method="post">


                              <button class="button2" type="submit" name="logout">logout</button>
                            </form>


            <form action="pictureadd.php" method="POST">
    <input class="label" type="hidden" name="variable" value="50" />
    <input class="img" type="image" src="add.jpg" name="submit" />
</form>
<?php if(isset($_POST['search']))
{

    $search1=  $_POST['search1'];
    $_SESSION['search1']=$search1;
    $_SESSION['email']=$email;
 header('Location: search.php');
}
if(isset($_POST['friendreq']))
{

   require 'dbhandler.php';
  $query = "SELECT  email1 From `friends` WHERE ( email2='$email' AND relation IS NULL);";

  $q = mysqli_query($connect,$query);
  $result=mysqli_num_rows($q);
    if($result==0)

    {  echo "NO request sent"."<br>";}
    if($result>0)
{
  echo " request sent";

  $_SESSION['email']=$email;
 header('Location: friendreq.php');
}

}
if(isset($_POST['submitpic'])){
  require 'dbhandler.php';
$public=$_POST['public'];
  $email = $_SESSION['email'];
    $caption=$_POST['caption'];
  $target_path = "C://xampp//htdocs//home//";
  $target_path = $target_path.basename( $_FILES['img1']['name']);
  if(move_uploaded_file($_FILES['img1']['tmp_name'], $target_path)) {
      echo "File uploaded successfully!";
  } else{
      echo "Sorry, file not uploaded, please try again!";
  }

  $query= "INSERT INTO `pic`(`email`,`caption`, `pic`,`private`)
   VALUES('$email','$caption',LOAD_FILE('$target_path'),'$public');";
  $q = mysqli_query($connect,$query);
}
if(isset($_POST['submitpic1'])){
  require 'dbhandler.php';
  $email = $_SESSION['email'];
  $target_path = "C://xampp//htdocs//home//";
  $target_path = $target_path.basename( $_FILES['img2']['name']);
  if(empty($_FILES['img2']['name']))
  {
    $query= "SELECT gender From `users` WHERE email='$email';";

    $q = mysqli_query($connect,$query);
    $result=mysqli_num_rows($q);
    if($result=1)
     $row=mysqli_fetch_row($q);
     if($row[0]=="male")
    $target_path = "C://xampp//htdocs//home//male.jpg";
    if($row[0]=="female")
    $target_path = "C://xampp//htdocs//home//female.jpg";

  }
  if(move_uploaded_file($_FILES['img2']['tmp_name'], $target_path)) {
      echo "File uploaded successfully!";
  } else{
      echo "Sorry, file not uploaded, please try again!";
  }
  $query= "INSERT INTO `pic`(`email`,`caption`,`pic`)
   VALUES('$email','changed their profile picture',LOAD_FILE('$target_path'));";
  $q = mysqli_query($connect,$query);
  $query1 = " UPDATE `users` SET img=LOAD_FILE('$target_path') WHERE (email='$email');";
  $q1 = mysqli_query($connect,$query1);
}
?>
<?php

  require 'dbhandler.php';

  $email = $_SESSION['email'];

$query = " SELECT email1,email2 From `friends` WHERE ((email2='$email' OR email1='$email') AND relation='accepted');";
//$query2 = "SELECT  p.caption,p.pic,p.date From `pic` as p inner join friends as f on f.email1 = p.email WHERE   ((f.email2='$email' OR f.email1='$email')AND f.relation='accepted') ;";
$q = mysqli_query($connect,$query);
$result=mysqli_num_rows($q);

if($result>0)
{

  while( $row=mysqli_fetch_row($q)) {
    // code...

  if($email==$row[0]){
   $email1=$row[1];}
if($email==$row[1]){
$email1=$row[0];}

//$query1 = " SELECT  `caption`,`pic`,`date`,`email` From `pic` WHERE (email='$email1' AND (private is null or private=''));";
$query1 = "SELECT p.caption,p.pic,p.date,u.username From `pic` as p left join `users` as u on p.email = u.email WHERE u.email='$email1' AND (p.private is null or p.private='') ;";

$q1 = mysqli_query($connect,$query1);
$result1=mysqli_num_rows($q1);

if($result1>0)
{

while($row1=mysqli_fetch_row($q1)){

  echo "<p align=center><font size=11px>".$row1[3]."<br>";

echo $row1[0]."<br>";
echo "posted at"."<font color=black>$row1[2]
</font> "."<br>";
  //echo $row2[2]."<br>";
if($row1[1]!=NULL){
echo'<img src="data:image;base64,'.base64_encode($row1[1]).'"alt="Image" .height="300" width="300">';
echo "<br>";


}
echo " <font color=black>__________________________________
</font> "."<br>";
}
}
}
}
//  $query2 = "SELECT  p.caption,p.pic,p.date From `pic` as p inner join friends as f on f.email1 = p.email WHERE  NOT  IS NULL AND p.private='public';";

$query2 = "SELECT p.caption,p.pic,p.date,u.username From `pic` as p left join `users` as u on p.email = u.email  WHERE (private='public') ;";

    $q2 = mysqli_query($connect,$query2);
    $result2=mysqli_num_rows($q2);
    if($result2>0)
    {
      echo " <p align=center> <font size=11px> <font color=black>public posts
      </font> "."<br>";

      while( $row2=mysqli_fetch_row($q2)) {


          echo $row2[3]."<br>";

        echo $row2[0]."<br>";
        echo "posted at "." <font color=black>$row2[2]
        </font> "."<br>";
          //echo $row2[2]."<br>";
        if($row2[1]!=NULL){
        echo'<img src="data:image;base64,'.base64_encode($row2[1]).'"alt="Image" .height="300" width="300">';
        echo "<br>";

        }
        echo "______________________________________"."<br>";
      }
    }



 ?>
</body>

</html>
