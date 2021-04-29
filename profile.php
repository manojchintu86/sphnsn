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
  <?php
  


  //$profile="INSERT into profile(profile_user,profile_img_path) values ($id,)";

  echo '
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

          @import url("https://fonts.googleapis.com/css?family=Ubuntu");


          button:hover{
            background-color: #6495ED;
            color:white;
          }
          
          .active {
            background-color: #4CAF50;
          }

          .row:after{
            content: "";
            display: table;
            clear: both;
            box-sizing: border-box;
          }

          .column{
            float: left;
            padding: 5px;
            height: 200px; 
          }

          .left{
            width:17%;
            background-color:;
            height:500px;
            margin-left:30px;
          }

          .right{

            width:50%;
            margin-left:70px;
          }

          #pic{
            height:120px;
            width:120px;
            border-radius:40px;
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
          <a  href="home.php">Home</a>
          <a class="active" href="profile.php">Profile</a>
          <a href="event.php">Placements/Events</a>
          <a href="logout.php">Logout</a>
          <!--<div class="search-container">
            <form action="/action_page.php">
              <input type="text" placeholder="Search.." name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>-->
          <a href="search.php"><i class="fa fa-search"></i></a>
        </div>
        </br>';
        $id=$_SESSION['user_id'];
        $sql="SELECT user_firstname, user_lastname, user_gender, user_type FROM users where user_id=$id";
        $query=mysqli_query($conn,$sql);
        $rowdata=mysqli_fetch_array($query);
        $gender=$rowdata['user_gender'];
        $fname=$rowdata['user_firstname'];
        $lname=$rowdata['user_lastname'];

        $sq="SELECT post_title, post_content, post_time, post_img_url, post_org_url, post_by FROM posts where post_by=$id ORDER BY post_time desc";

        $que=mysqli_query($conn,$sq);
        echo '
        <div class="row">
          <div class="column left" align="center">
            <h4 style="margin-right:10px;"><b>'.$fname.' '.$lname.'</b></h4>
            </br>';
            $img="SELECT profile_id, profile_image from profile_pic where profile_id=$id";
            $exe=mysqli_query($conn,$img);
            $rowimg=mysqli_fetch_array($exe);
            //echo $rowimg['profile_image'];
            echo '<img src="uploads/profiles/'.$rowimg['profile_image'].'" id="pic"/>
            </br>
            </br>
            <div class="container shadow">
              <form method="POST" enctype="multipart/form-data">
                <p>
                  <!--Upload button in home-->
                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    upload profile
                  </button>
                </p>
                <div class="collapse" id="collapseExample" style="height:150px width: 200px;">
                  <div class="card card-body" style="height:150px width: 300px;";>
                    <div class="form-group col-md-6" >
                      <label>
                        <img src="upicon.png" height="20px" width="20px">
                        <input type="file" name="profilepic" id="imagefile">
                      </label>
                      </br>
                      </br>
                      <button type="submit" class="btn btn-light" value="Login" name="login" >upload</button>
                    </div>
                  </div>
                </div>
                  
              
              </from>
            </div>
            </br>
            </br>
            </br>
          </div>

          <div class="column right">
          ';
            if ( mysqli_num_rows($que) > 0) {
              while($rowData = mysqli_fetch_array($que)){
                    echo '<div class="card card-body">';
                    echo '<div>';
                    echo '<span class="element1"><img src="uploads/profiles/'.$rowimg['profile_image'].'" height="30px" width="30px" id="disp"></span>';
                    echo '<span class="element1"><b><a href="disp_profile.php?id='.$rowimg['profile_id'].'" target="_blank" value="'.$rowimg['profile_id'].'">&nbsp;'.$rowdata["user_firstname"].' '.$rowdata["user_lastname"].'&nbsp;</a></b></span>';
                    echo '<span class="element1">('.$rowdata['user_type'].')</span>';
                    echo '<span class="element2">'.$rowData["post_time"].'</span>';
                    echo '</div>';
                    
                    echo '<hr class="new1">';
                    echo '<span align="left">Title :&nbsp;'.$rowData["post_title"].'</span>';
                    echo '<span align="left">Content :&nbsp;'.$rowData["post_content"].'</span>';
                    
                  //echo '<img src="uploads/posts/'.$rowData["post_img_path"].'">';
                  if ($rowData["post_img_url"]!=""){
                    $imag = pathinfo($rowData["post_img_url"], PATHINFO_EXTENSION);
                    if ($imag == "png" || $imag == "jpg"||$imag == "jpeg"){
                      echo '<br>';
                      echo '<center><img src="uploads/posts/'.$rowData["post_img_url"].'"height="500px" width="500px"></center>';
                    }
                    //$imag = pathinfo($rowData["post_img_url"], PATHINFO_EXTENSION);
                    //echo $imag;
                    else{
                      echo '<br>';
                      echo '<a href="uploads/posts/'.$rowData["post_img_url"].'" target="_blank">'.$rowData["post_img_url"].'</a>';
                    }
                  }
                echo '</div>';
                echo '<br>';

              }
            }
            echo '
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
      </body>
    </html>
  ';


  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id=$_SESSION['user_id'];

    $img_name = $_FILES['profilepic']['name'];
      //$img_size = $_FILES['fileupload']['size'];
    $tmp_name = $_FILES['profilepic']['tmp_name'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
              
              //$img_ex_lc = strtolower($img_ex);

    $allowed_exs = array("jpg", "jpeg", "png"); 
    //echo $img_name;
    //echo $id;
              //if (in_array($img_ex_lc, $allowed_exs)) {
              if(TRUE){  
                  $new_img_name = $id.'.'.$img_ex;
                  $img_upload_path = 'uploads/profiles/'.$new_img_name;
                  move_uploaded_file($tmp_name, $img_upload_path);
                  

              }
              else{
                  $em = "You can't upload files of this type";
                  header("Location: home.php?error=$em");
              }
              //echo $new_img_name;
              $s = "UPDATE profile_pic SET profile_image = '$new_img_name' where profile_id=$id";
              $query = mysqli_query($conn, $s);
              //echo $query;
              if($query){
                header("location: profile.php");
              }
          //}
        //}
      // Apply Insertion Query
    

  }

?>