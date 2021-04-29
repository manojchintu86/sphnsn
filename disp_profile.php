<?php 
require 'functions/functions.php';
$conn = connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
          margin-top:20px;
          color: #1a202c;
          text-align: left;
          background-color: #e2e8f0;    
      }
      .main-body {
          padding: 15px;
      }
      .card {
          box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
      }

      .card {
          position: relative;
          display: flex;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: #fff;
          background-clip: border-box;
          border: 0 solid rgba(0,0,0,.125);
          border-radius: .25rem;
      }

      .card-body {
          flex: 1 1 auto;
          min-height: 1px;
          padding: 1rem;
      }

      .gutters-sm {
          margin-right: -8px;
          margin-left: -8px;
      }

      .gutters-sm>.col, .gutters-sm>[class*=col-] {
          padding-right: 8px;
          padding-left: 8px;
      }
      .mb-3, .my-3 {
          margin-bottom: 1rem!important;
      }

      .bg-gray-300 {
          background-color: #e2e8f0;
      }
      .h-100 {
          height: 100%!important;
      }
      .shadow-none {
          box-shadow: none!important;
      }
      #pic{
          height:230px;
          width:230px;
          border-radius:40px;
          border:2px solid black;
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
</head>
<body>
<?php
  $id=$_GET['id'];
  //echo $id;
  $que = "SELECT user_firstname, user_lastname, user_email, user_gender, user_birthdate, user_hometown, user_type FROM users WHERE user_id=$id";
  $q = mysqli_query($conn, $que);
  $row = mysqli_fetch_array($q);
  $im = "SELECT profile_id, profile_image FROM profile_pic WHERE profile_id=$id";
  $i = mysqli_query($conn, $im);
  $ima = mysqli_fetch_array($i);
  echo '<center><h3>Profile of '.$row['user_firstname'].' '.$row['user_lastname'].'</h3></center>';

?>
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <?php
                    echo '<img src="uploads/profiles/'.$ima['profile_image'].'" alt="Admin" class="rounded-circle" id="pic">
                    <div class="mt-3">
                      <h4>'.$row['user_firstname'].' '.$row['user_lastname'].'</h4>
                      <p class="text-secondary mb-1">'.$row['user_type'].'</p>
                    </div>';
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <?php
                echo '<div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    '.$row['user_firstname'].' '.$row['user_lastname'].'
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">';
                    if ($row['user_gender']=='M'){
                      echo 'Male';
                    }
                    else {
                      echo 'Female';
                    }
                    echo '
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    '.$row['user_email'].'
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    '.$row['user_birthdate'].'
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      (320) 380-4539
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">City</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    '.$row['user_hometown'].'
                    </div>
                  </div>
                </div>';
                ?>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="scrollspy-example container">
      <?php
        $sq="SELECT post_title, post_content, post_time, post_img_url, post_org_url, post_by FROM posts where post_by=$id ORDER BY post_time desc";
        $que=mysqli_query($conn,$sq);
            if ( mysqli_num_rows($que) > 0) {
              while($rowData = mysqli_fetch_array($que)){
                $val = $rowData["post_by"];
                $qu = "SELECT user_firstname, user_lastname, user_type FROM users WHERE user_id=$id";
                $q = mysqli_query($conn, $qu);
                $row = mysqli_fetch_array($q);
                $im = "SELECT profile_id, profile_image FROM profile_pic WHERE profile_id=$id";
                $i = mysqli_query($conn, $im);
                $ima = mysqli_fetch_array($i);
                echo '<div class="card card-body">';
                echo '<div>';
                echo '<span class="element1"><img src="uploads/profiles/'.$ima['profile_image'].'" height="30px" width="30px" id="disp"></span>';
                echo '<span class="element1"><b>&nbsp;'.$row["user_firstname"].' '.$row["user_lastname"].'&nbsp;</b></span>';
                echo '<span class="element1">('.$row['user_type'].')</span>';
                echo '<span class="element2">'.$rowData["post_time"].'</span>';
                echo '</div>';
                
                echo '<hr class="new1">';
                echo '<span align="left">Title :&nbsp;'.$rowData["post_title"].'</span>';
                echo '<span align="left">Content :&nbsp;'.$rowData["post_content"].'</span>';
              //echo '<img src="uploads/posts/'.$rowData["post_img_path"].'">';
                  if ($rowData["post_img_url"]!=""){
                    $imag = pathinfo($rowData["post_img_url"], PATHINFO_EXTENSION);
                    if ($imag == "png" || $imag == "jpg"||$imag == "jpeg"){
                      echo '<center><img src="uploads/posts/'.$rowData["post_img_url"].'"height="500px" width="500px"></center>';
                    }
                    //$imag = pathinfo($rowData["post_img_url"], PATHINFO_EXTENSION);
                    //echo $imag;
                    else{
                      echo '<a href="uploads/posts/'.$rowData["post_img_url"].'" target="_blank">'.$rowData["post_img_url"].'</a>';
                    }
                  }
                echo '</div>';
                echo '<br>';

              }
            }
            else {
              echo '<p>No posts yet</p>';
            }
            ?>
          </div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>