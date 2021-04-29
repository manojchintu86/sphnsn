<?php 
require 'functions/functions.php';
session_start();
session_destroy();
session_start();
ob_start(); 
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
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">

    <title>Social Network</title>
    <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Ubuntu');
      .sha{
        font-family: 'Ubuntu', sans-serif;
        font-size: 40px;
        font-weight: bold;
        color: #483D8B;
        letter-spacing: 1px;
        text-shadow: 0px 10px 10px rgba(81,67,21,0.8);
      }
      .container{
        margin: 60px auto;
        width: 500px;
      }
      button:hover{
        background-color: #6495ED;
        color:white;
      }
      .active{
        margin-right:15px;
        background-color:#4682B4 ;
        color:white;
      }
      .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
      }
      .btn-light {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
      }
      .btn-light:hover{
        background-color: #306cac;
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
  
    <h2 class="sha" align="center" style="padding:20px;">Social Network for College</h2>

    <div class="container" id="bt">

      <button class="head button active" style="outline:none;" onclick="openTab(event,'signin')" id="link1">Sign in</button>
      <button class="head button" style="outline: none;" onclick="openTab(event,'signup')" id="link2">Signup</button>
    </div>
    </br>
    <div class="tabcontent" id="signin">
      <form class="container" method="POST" onsubmit="return validateLogin()">
        <div class="form-group">
          <label>Email address</label>
          <input type="email" class="form-control" id="loginuseremail" name="loginuseremail" placeholder="Enter email" required>
          <div class="required"></div>
          </br>
          <label>Password</label>
          <input type="password" class="form-control" id="loginuserpass" name="loginuserpass" placeholder="Password" required>
          <div class="required"></div>
        </div>
        <button type="submit" class="btn btn-light" value="Login" name="login" >Submit</button>
      </form>
    </div>


      <!--<footer id="sticky-footer" class="foot">
        <div class="container text-center">
          <small>Copyright &copy; <a href="index.html">chotu</a></small>
        </div>
      </footer>-->


    <div class="tabcontent" id="signup">

      <form class="container" method="POST" onsubmit="return validateRegister()" action="">
      
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>First Name</label>
            <input type="text" class="form-control" name="userfirstname" placeholder="Name" required>
            <div class="required"></div>
          </div>
          <div class="form-group col-md-6">
            <label>Last Name</label>
            <input type="text" class="form-control" name="userlastname" placeholder="Last Name" required>
            <div class="required"></div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label >Password</label>
            <input type="password" class="form-control" name="userpass" placeholder="password" required>
            <div class="required"></div>
          </div>
          <div class="form-group col-md-6">
            <label >Confirm Password</label>
            <input type="password" class="form-control" name="userpassconfirm" placeholder="Re-enter Password" required>
            <div class="required"></div>
          </div>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="Email" class="form-control" name="useremail" placeholder="hello@gmail.com" required>
        </div>
        <div class="required"></div>
  
        <div class="form-group">
          <label>DOB</label>
          <input type="date" class="form-control" name="userdob" required>
        </div>
        <div>
          <label>User Type</label>
        </div>
        <div class="rad">
          <input type="radio" name="usergender" value="M" required>
          <label >Male</label>
        </div>
        <div class="rad">
          <input type="radio" name="usergender" value="F" required>
          <label class="">Female</label>
        </div>
        <div class="required"></div>
        </br>
        </br>
        <div>
          <label>User Type</label>
        </div>
        <div class="rad">
          <input type="radio" name="usertype" value="Faculty" required>
          <label >Faculty</label>
        </div>
        <div class="rad">
          <input type="radio" name="usertype" value="Student" required>
          <label class="">Student</label>
        </div>
        </br>
        </br>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" name="userhometown" placeholder="Your Current City">
          </div>
        </div>
        </br>
        <button type="submit" class="btn btn-primary" name="register">Submit</button>
      </form>
    </div>
    
  </body>
</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
    if (isset($_POST['login'])) { // Login process
        $useremail = $_POST['loginuseremail'];
        $userpass = ($_POST['loginuserpass']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$userpass'");
        if($query){
            if(mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
                header("location:home.php");
            }
            else {
                ?> <script>
                    document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[1].innerHTML = "Invalid Login Credentials.";
                </script> <?php
            }
        } else{
            echo mysqli_error($conn);
        }
    }
    if (isset($_POST['register'])) { // Register process
        // Retrieve Data
        $userfirstname = $_POST['userfirstname'];
        $userlastname = $_POST['userlastname'];
        $userpassword = ($_POST['userpass']);
        $userpasswordc = ($_POST['userpassconfirm']);
        $useremail = $_POST['useremail'];
        $userbirthdate = $_POST['userdob'];
        $usergender = $_POST['usergender'];
        $usertype = $_POST['usertype'];
        $userhometown = $_POST['userhometown'];

        // Check for Some Unique Constraints
        $query = mysqli_query($conn, "SELECT user_email FROM users WHERE user_email = '$useremail'");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
  
            if($useremail == $row['user_email']){
                ?> <script>
                document.getElementsByClassName("required")[6].innerHTML = "This Email already exists.";
                </script> <?php
            }
        }
        // Insert Data
        $sql = "INSERT INTO users(user_firstname, user_lastname,  user_password, user_email, user_gender, user_type, user_birthdate, user_hometown)
                VALUES ('$userfirstname', '$userlastname', '$userpassword', '$useremail', '$usergender', '$usertype', '$userbirthdate', '$userhometown')";
        $query = mysqli_query($conn, $sql);
        if($query){
            $query = mysqli_query($conn, "SELECT user_id FROM users WHERE user_email = '$useremail'");
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['user_id'];
            header("location:success.php");
        }
        $poster = $_SESSION['user_id'];
        if ($usergender == "M"){
          $s = "INSERT INTO profile_pic (profile_id, profile_image)
                  VALUES ('$poster', 'M.jpg')";
          $qu = mysqli_query($conn, $s);
        }
        else {
          $s = "INSERT INTO profile_pic (profile_id, profile_image)
                  VALUES ('$poster', 'F.jpg')";
          $qu = mysqli_query($conn, $s);
        }
    }
}
?>