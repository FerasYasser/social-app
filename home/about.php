<?php session_start();?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>

<body>
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

                                  <form  action="search.php" method="post" autocomplete="off">
                                    <br><Br><br><br>
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


                              <?php if(isset($_POST['search']))
                              {

                                  $search1=  $_POST['search1'];
                                  $_SESSION['search1']=$search1;
                                  $_SESSION['email']=$email;
                               header('Location: search.php');
                              }
                              if(isset($_POST['friendreq']))
                              {
                                $email=$_SESSION['email'];

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
                              <form action="edita.php" method="post">

                                  <br><br>
                                    <button class="button3" type="submit" name="edita" id='edita' >edit</button>

                                  </form>

<?php

if(isset($_POST['about']))
  {
 require 'dbhandler.php';
 echo "Welcome ".'<br><br>';
$email = $_SESSION['email'];
echo "<font size=6px>".$email;
 $query= "SELECT username,birthdate,gender,hometown,aboutme,mstatus,img From `users` WHERE email='$email';";

 $q = mysqli_query($connect,$query);
 $result=mysqli_num_rows($q);
 if($result=1)
  $row=mysqli_fetch_row($q);
echo '<br>'."username ";
  echo $row[0].'<br>';

  echo '<br>'."birhtdate ";
    echo $row[1].'<br>';
    echo '<br>'."gender ";
      echo $row[2].'<br>';
      echo '<br>'."hometown ";
        echo $row[3].'<br>';
        echo '<br>'."aboutme ";
          echo $row[4].'<br>';
          echo '<br>'."mstatsus ";
            echo $row[5].'<br>';


}



 ?>

 <tr>
<td> <?php echo'<img src="data:image;base64,'.base64_encode($row[6]).'"alt="Image" .height="100" width="100">' ; ?></td>
</tr>

    <?php
    if(isset($_POST['regbtn1']))
      {
        require 'dbhandler.php';
        $lastname =  $_POST['lname'];
         $password =  $_POST['pass'];
         $email=  $_SESSION['email'];
         $num=  $_POST['num'];
         $firstname=$_POST['fname'];
          $birthdate =  $_POST['birthdate'];
          $gender=$_POST['gender'];
          $mstatus=$_POST['mstatus'];
            $hometown=$_POST['hometown'];
              $aboutme=$_POST['aboutme'];
            $fullname= $firstname." ".$lastname;
echo $fullname;
echo $password;
echo $birthdate;
echo $num;
echo $aboutme;
echo $mstatus;
echo $email;
echo $hometown;
echo $gender;



    //if(empty($gender))
    //{

    //$_SESSION['gender']=$gender;
      // header('Location: registerpage.php');


    //}


         $query = "SELECT * From `users` WHERE email='$email'";
         $q = mysqli_query($connect,$query);
         $result=mysqli_num_rows($q);
        if($result == 0)
         {
           echo "Email not exists";
          // header('Location: registerpage.php');
         }

       else if($result==1)
         {
           if(!empty($firstname) || !empty($lastname))
           {
             echo "string";
           $query = " UPDATE `users` SET username='$fullname' WHERE (email='$email');";
           $q = mysqli_query($connect,$query);
         }

         if(!empty($gender))
         {
           echo "string";
         $query = " UPDATE `users` SET gender='$gender' WHERE (email='$email');";
         $q = mysqli_query($connect,$query);
       }
       if(!empty($password))
       {
         echo "string";
       $query = " UPDATE `users` SET password='$password' WHERE (email='$email');";
       $q = mysqli_query($connect,$query);

     }
     if(!empty($num))
     {
       echo "string";
     $query = " UPDATE `users` SET phone='$num' WHERE (email='$email');";
     $q = mysqli_query($connect,$query);

    }
    if(!empty($mstatus))
    {
      echo "he";
    $query = " UPDATE `users` SET mstatus='$mstatus' WHERE (email='$email');";
    $q = mysqli_query($connect,$query);

    }
    if(!empty($hometown))
    {
      echo "he2";
    $query = " UPDATE `users` SET hometown='$hometown' WHERE (email='$email');";
    $q = mysqli_query($connect,$query);

    }
    if(!empty($aboutme))
    {
      echo "lkk";
    $query = " UPDATE `users` SET aboutme='$aboutme' WHERE (email='$email');";
    $q = mysqli_query($connect,$query);

    }
    if(!empty($birthdate))

    {
      echo "string";
    $query = " UPDATE `users` SET birthdate='$birthdate' WHERE (email='$email');";
    $q = mysqli_query($connect,$query);

    }
         //  echo "Added the new user";
         if($q)
         {
           echo "lqqq";
           header('Location: finalwelcome.php');

         }

         }
         $malep="C://xampp//htdocs//home//male.jpg";
         $query = " UPDATE `users` SET img=LOAD_FILE('$malep') WHERE (gender='male' AND img is null);";
         $q = mysqli_query($connect,$query);
         $malep="C://xampp//htdocs//home//female.jpg";
         $query = " UPDATE `users` SET img=LOAD_FILE('$malep') WHERE (gender='female' AND img is null);";
         $q = mysqli_query($connect,$query);

    }




     ?>


</body>
</html>
