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
      require 'dbhandler.php';

      $email = $_SESSION['email'];
      $query = " SELECT email1 From `friends` WHERE (email2='$email' AND relation is null);";
      $q = mysqli_query($connect,$query);
      $result=mysqli_num_rows($q);
      if($result==0) echo "no friends requests";
      if($result>0)
      {
        $row=mysqli_fetch_row($q);
        echo $row[0];
      }
  //    $query =  "INSERT INTO `friends` (`relation`) VALUES('accepted');";
    //    $q = mysqli_query($connect,$query);

   ?>
   <form  method="post">


         <button  type="submit" name="add">add</button>
         <br><br>
          <button  type="submit" name="reject">reject</button>
       </form>
       <?php
if(isset($_POST['add']))
{
  require 'dbhandler.php';
  $query = " SELECT email1 From `friends` WHERE (email2='$email' AND relation IS NULL);";
  $q = mysqli_query($connect,$query);
  $result=mysqli_num_rows($q);
  $query = " UPDATE `friends` SET relation='accepted' WHERE (email2='$email' AND email1='$row[0]');";
  $q = mysqli_query($connect,$query);
  echo "you are now friends";
}
if(isset($_POST['reject']))
{
  require 'dbhandler.php';
  $query = " SELECT email1 From `friends` WHERE (email2='$email' AND relation IS NULL);";
  $q = mysqli_query($connect,$query);
  $result=mysqli_num_rows($q);
  $query = " DELETE FROM `friends` WHERE (email2='$email' AND email1='$row[0]');";
  $q = mysqli_query($connect,$query);
  echo "REJECTED";
}
        ?>


</body>
</html>
