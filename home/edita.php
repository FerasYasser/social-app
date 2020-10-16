<?php session_start();?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="validation.js"></script>
</head>
<?php
//$gneder=$_SESSION['gender'] ;
//if(empty($gender)){
//$msg='gender missing';
// echo "<script type='text/javascript'>alert('$msg');</script>";
//}
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
                             <form action="about.php" method="post">
                                   <button class="about" type="submit" name="about" onclick="about.php">About</button>

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


                                    \
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

<form action="about.php" method="post">
  <br> <br> <br>
 <h1 class="h1">EDIT</h1>
  <br> <br> <br>
    <div>

      <input class="input" type="text" placeholder="First name" name="fname" id="fname">
        <br><br>
        <input class="input" type="text" placeholder="last name" name="lname" id="lname">
          <br><br>
      <input class="input" type="password" placeholder="Enter Password" name="pass" id="pass">
      <br><br>
      <input class="input" type="text" placeholder="phone number" name="num" id="num">
      <br><br>
        <label class="label"for="female">female:</label>
      <input class="input" type="radio" name="gender" value="female"  id="gender" />
      <br><br>
        <label class="label"for="male">male:</label>
      <input class="input" type="radio" name="gender" value="male"  id="gend"/>
      <br><br>
<label class="label"for="male">birthdate:</label>
      <input class="input" type="date" placeholder="birthdate" name="birthdate" id="birthdate">
        <br><br>
        <label class="label"for="male">single:</label>
        <input class="input" type="radio" name="mstatus" value="single" />
        <br><br>
        <label class="label"for="male">engaged:</label>
<input class="input" type="radio" name="mstatus" value="engaged" />
<br><br>
<label class="label"for="male">married:</label>
  <input class="input" type="radio" name="mstatus" value="married" />
  <br><br>
  <input class="input" type="text" placeholder="Enter hometown" name="hometown" id="hometown" >
  <br><br>
  <input class="input" type="text" placeholder="Enter aboutme" name="aboutme" id="aboutme" >
  <br><br>

<br>
      <button class="button" type="submit" name="regbtn1" onclick="processing.php">edit</button>
      <br>
      <br>
    </div>
</form>
</html>
