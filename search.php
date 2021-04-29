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
      <a href="home.php">Home</a>
      <a href="profile.php">Profile</a>
      <a href="event.php">Placements/Events</a>
      <a href="logout.php">Logout</a>
      <!--<div class="search-container">
        <form action="action_page.php">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>-->
      <a class="active" href="search.php"><i class="fa fa-search"></i></a>
    </div>
    </br>

    <div class="container shadow" align="center">
        <form method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>   
        <div data-spy="scroll"  data-offset="0" class="scrollspy-example container">
        <!--<div class="card card-body" style="height:510px;width: 700px" align="center">-->
        <!--<div class="card card-body" align="center">-->
        <?php

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
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //if(isset($_POST['go'])){
        $inp=$_POST['search'];
        $sql="SELECT user_id, user_firstname, user_lastname from users where user_firstname like '$inp%' or user_lastname like '$inp%' or user_firstname like '%$inp%' or user_lastname like '%$inp%' ";
        $query=mysqli_query($conn,$sql);
        echo  '<html>
        <head>
        </head>
        <body>
        ';
        if ( mysqli_num_rows($query) > 0) {
            while($rowData = mysqli_fetch_array($query)){
                $id = $rowData['user_id'];
                $im = "SELECT profile_image from profile_pic where profile_id=$id";
                $i = mysqli_query($conn, $im);
                $ima = mysqli_fetch_array($i);

                //echo $rowData['user_firstname'].' '.$rowData['user_lastname'];
                echo '<div style="margin-left:42%;">';
                echo '<span class="element1"><img src="uploads/profiles/'.$ima['profile_image'].'" height="30px" width="30px" id="disp"></span>';
                echo '<span class="element1"><b><a href="disp_profile.php?id='.$rowData['user_id'].'" target="_blank" value="'.$rowData['user_id'].'">&nbsp;'.$rowData["user_firstname"].' '.$rowData["user_lastname"].'&nbsp;</a></b></span>';
                echo '<br>
                </div>
                </br>';

            }
        }
        else{
            echo 'no such user found';
        }
        echo '</body>
        </html>' ;
    }
?>