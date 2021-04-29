<?php 
require 'functions/functions.php';
session_start();
// Check whether user is logged on or not
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
$temp = $_SESSION['user_id'];
session_destroy();
session_start();
$_SESSION['user_id'] = $temp;
ob_start(); 
// Establish Database Connection
$conn = connect();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="login.css">

    <link rel="stylesheet" type="text/css" href="hom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Social Network</title>

    <style type="text/css">

      @import url('https://fonts.googleapis.com/css?family=Ubuntu');

      button:hover{
        background-color: #6495ED;
        color:white;
      }
      
      .active {
        background-color: #4CAF50;
      }
      .element1{
        float: left;
      }
      .element2{
        float: right;
      }
      hr.new1 {
        border-top: 3px solid black;
      }
      #disp {
        border-radius:50%; 
      }
      

      
    </style>

    <script type="text/javascript">
	    function openTab(evt, choice) {
        // Hide All Content
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        } // Remove Active Class
        var tablink = document.getElementsByClassName("head button");
        for (i = 0; i < tablink.length; i++) {
          tablink[i].classList.remove("active");
        } // Show Appropriate Content + Add Active Class to appropriate tab
        document.getElementById(choice).style.display = "block";
        evt.currentTarget.classList.add("active");
        // Save
      }
    </script>

  </head>
  <body style="background-color: #F5F5F5;">
    <div class="topnav">
      <a class="active" href="home.php">Home</a>
      <a href="profile.php">Profile</a>
      <a href="event.php">Placements/Events</a>
      <a href="logout.php">Logout</a>
      <!--<div class="search-container">
        <form action="action_page.php">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>-->
      <a href="search.php"><i class="fa fa-search"></i></a>
    </div>
    </br>

    <div class="container shadow">
      <form method="post" enctype="multipart/form-data">
        <p>
          <!--Upload button in home-->
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            upload
          </button>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body" style="height:510px";>
            <div class="form-group col-md-6" >
              <!--Title of the post-->
              <label>Title</label>
              <input type="text" class="form-control" name="userfirstname" placeholder="title of your post">
              </br>
              <div class="about">
                <!--Content of the post-->
                <label>Content</label><br>
                <textarea rows="9" cols="70" name="userabout" id="userabout" class="form-control" placeholder="this post for final year students"></textarea>
              </div>
              </br>
              <label>
                  <img src="upicon.png" height="20px" width="20px">
                  <input type="file" name="fileupload" id="imagefile">
              </label>
              </br>
              </br>
              <button type="submit" class="btn btn-light" value="Login" name="login" >Post</button>
            </div>

          </div>
        </div>
      </form>
      </br>
      </br>    
      <div data-spy="scroll"  data-offset="0" class="scrollspy-example container">
        <!--<div class="card card-body" style="height:510px;width: 700px" align="center">-->
        <!--<div class="card card-body" align="center">-->
        <?php
              //$val = $_SESSION['user_id'];
              $sql = "SELECT post_id, post_title, post_content, post_time, post_img_url, post_org_url, post_by FROM posts ORDER BY post_time DESC";
              $query = mysqli_query($conn, $sql);
              //echo $sql;
              //$rowData = mysqli_fetch_array($query);
              if (mysqli_num_rows($query) > 0) {
                while($rowData = mysqli_fetch_array($query)){
                    $val = $rowData["post_by"];
                    $que = "SELECT user_firstname, user_lastname, user_type FROM users WHERE user_id=$val";
                    $q = mysqli_query($conn, $que);
                    $row = mysqli_fetch_array($q);
                    $im = "SELECT profile_id, profile_image FROM profile_pic WHERE profile_id=$val";
                    $i = mysqli_query($conn, $im);
                    $ima = mysqli_fetch_array($i);
                    echo '<div class="card card-body">';
                    echo '<div>';
                    echo '<span class="element1"><img src="uploads/profiles/'.$ima['profile_image'].'" height="30px" width="30px" id="disp"></span>';
                    echo '<span class="element1"><b><a href="disp_profile.php?id='.$ima['profile_id'].'" target="_blank" value="'.$ima['profile_id'].'">&nbsp;'.$row["user_firstname"].' '.$row["user_lastname"].'&nbsp;</a></b></span>';
                    echo '<span class="element1">('.$row['user_type'].')</span>';
                    echo '<span class="element2">'.$rowData["post_time"].'</span>';
                    echo '</div>';
                    
                    echo '<hr class="new1">';
                    echo '<span align="left">Title :&nbsp;'.$rowData["post_title"].'</span>';
                    echo '<span align="left">Content :&nbsp;'.$rowData["post_content"].'</span>';
                    if ($rowData["post_img_url"]!=""){
                      $imag = pathinfo($rowData["post_img_url"], PATHINFO_EXTENSION);
                      if ($imag == "png" || $imag == "jpg"||$imag == "jpeg"){
                        echo '<center><img src="uploads/posts/'.$rowData["post_img_url"].'"height="500px" width="500px"></center>';
                      }
                      //$imag = pathinfo($rowData["post_img_url"], PATHINFO_EXTENSION);
                      //echo $imag;
                      else{
                        echo '<a href="uploads/posts/'.$rowData["post_img_url"].'" target="_blank">'.$rowData["post_org_url"].'</a>';
                      }
                    }
                    //echo $rowData["post_content"].'<br>';
                    //echo $rowData["post_time"].'<br>';
                    //echo $rowData["post_img_url"].'<br>';
                    //echo $rowData["post_by"].'<br>';
                    echo '</div>';
                    echo '<br>';

                }
              }
              
            ?>
        <!--</div>-->
        </br>
        </br>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') { // Form is Posted
    // Assign Variables
    $title = $_POST['userfirstname'];
    $content = $_POST['userabout'];
    $poster = $_SESSION['user_id'];
    $img_name = $_FILES['fileupload']['name'];
    //$img_size = $_FILES['fileupload']['size'];
    $tmp_name = $_FILES['fileupload']['tmp_name'];
    $error = $_FILES['fileupload']['error'];
    $flag = 0;
    $len =strlen($title);
    $l =strlen($content);
    for ($x = 0; $x < $len; $x++){
      if($title[$x]=='<' || $title[$x]=='>'){
        $flag=1;
      }
    }
    for ($x = 0; $x < $l; $x++){
      if($content[$x]=='<' || $content[$x]=='>'){
        $flag=1;
      }
    }
    //echo $title[0];
    if($flag==1){
      echo '
      <script>
      alert("post not uploaded")
      </script>';
    }
    else{
    if ($error === 0) {
        /*if ($img_size > 12500000) {
          $em = "Sorry, your file is too large.";
          header("Location: home.php?error=$em");
        }
        else{*/
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            
            //$img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png"); 
            //if (in_array($img_ex_lc, $allowed_exs)) {
            if(TRUE){  
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex;
                $img_upload_path = 'uploads/posts/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);


            }
            
        }
      //}
    // Apply Insertion Query
    echo $new_img_name;
    $sql = "INSERT INTO posts (post_title, post_content, post_time, post_img_url, post_org_url, post_by)
            VALUES ('$title', '$content', NOW(), '$new_img_name', '$img_name',  $poster)";
    $query = mysqli_query($conn, $sql);
    // Action on Successful Query
    if($query){
      header("location: home.php");
    }
  }
}
?>