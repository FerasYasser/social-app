<?php session_start();?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>

<body>

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
                                  if($result==0) {echo "NO request sent"."<br>";}
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
$r=0;
while($r<1000){
if(isset($_GET[$r]))
{
  require 'dbhandler.php';

  $email = $_SESSION['email'];
  $query = " SELECT email1,email2 From `friends` WHERE ((email2='$email' or email1='$email')AND relation = 'accepted');";
  $q = mysqli_query($connect,$query);
  $result=mysqli_num_rows($q);
  if($result==0) echo "no friends";
  if($result>0)
  {
    mysqli_data_seek($q,$r);

    $row=mysqli_fetch_row($q);
  if($email==$row[0])
  {
    $friend=$row[1];
  }
  else if($email==$row[1])
  {
    $friend=$row[0];
  }
$_SESSION['emailsearch']=$friend;
  }
}
$r++;
}

$isCreateDisabled=false;
 require 'dbhandler.php';
 echo "Welcome ".'<br><br>';
 $email = $_SESSION['emailsearch'];
 echo "<font size=6px>".$email;
 $email1=$_SESSION['email'];
  $query= "SELECT username,birthdate,gender,hometown,aboutme,mstatus,img From `users` WHERE email='$email';";

 $q = mysqli_query($connect,$query);
 $result=mysqli_num_rows($q);
 if($result=1)
  $row=mysqli_fetch_row($q);
echo '<br>'."username ";
  echo $row[0].'<br>';


    echo '<br>'."gender ";
      echo $row[2].'<br>';
      echo '<br>'."hometown ";
        echo $row[3].'<br>';

          echo '<br>'."mstatsus ";
            echo $row[5].'<br>';
            $query1 = " SELECT email1,email2 From `friends` WHERE (email2='$email' AND email1='$email1' AND relation='accepted') OR (email1='$email' AND email2='$email1' AND relation='accepted') ;";
            $q1 = mysqli_query($connect,$query1);
            $result1=mysqli_num_rows($q1);
            if($result1>0){
            echo '<br>'."birhtdate ";
              echo $row[1].'<br>';
              echo '<br>'."aboutme ";
                echo $row[4].'<br>';
}


 ?>

 <tr>
<td> <?php echo'<img src="data:image;base64,'.base64_encode($row[6]).'"alt="Image" .height="100" width="100">' ; ?></td>
</tr>
<<?php
if(!isset($_POST['about1'])){
$r=0;
while($r<1000){
if(isset($_GET[$r]))
{
  require 'dbhandler.php';

  $email = $_SESSION['email'];
  $query = " SELECT email1,email2 From `friends` WHERE ((email2='$email' or email1='$email')AND relation = 'accepted');";
  $q = mysqli_query($connect,$query);
  $result=mysqli_num_rows($q);
  if($result==0) echo "no friends";
  if($result>0)
  {
    mysqli_data_seek($q,$r);

    $row=mysqli_fetch_row($q);
  if($email==$row[0])
  {
    $friend=$row[1];
  }
  else if($email==$row[1])
  {
    $friend=$row[0];
  }
$_SESSION['emailsearch']=$friend;
  }
}
$r++;
}
$friend=$_SESSION['emailsearch'];
$query = " SELECT  `caption`,`pic`,`date` From `pic` WHERE (email='$friend');";
$q = mysqli_query($connect,$query);
$result=mysqli_num_rows($q);
if($result==0) echo "no pics";
if($result>0)
{
  while($row=mysqli_fetch_row($q)){
    echo "<br>"."<br>"." <font color=white>$row[2]
    </font> "."<br>";

echo $row[0]."<br>";
if($row[1]!=NULL){
echo'<img src="data:image;base64,'.base64_encode($row[1]).'"alt="Image" .height="300" width="300">';
echo "<br>";

echo " <font color=black>__________________________________
</font> "."<br>";
}
}
}
}
 ?>
 <form action="about.php" method="post">
   <label class="label1">gggggggggggggggggggggggggggggggggfffffffffffffffffttt5 </label>
       <button class="about" type="submit" name="about" onclick="about.php">About</button>

     </form>

         <form   action="friendreq.php" method="post">


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


</body>
</html>
