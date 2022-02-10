<?php
  session_start();
  include "connection.php";
  error_reporting(0);
?>


<!DOCTYPE html>
<html lang="en">
<!--Purpose of assignment:
Course:CSCI2170
Date: October 14th 2020
Author: Shawn Shahin B00632190
Description of page:This is the page that allows the user in the future to login and be able to post items and comment within the website
Additional Info:
-->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <!-- changed the  title of page in nav menu to picturegram -->
      <a class="navbar-brand" href="aboutUs.php">picturegram</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <!-- changed the navigation menu items and added links so it can lead to the correct page -->
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutUs.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="createAccount.php">Create Account</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
        <!-- changed the logo image to logo.jpg-->
  <header class="masthead" style="background-image: url('img/login.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
              <!-- changed the headers to the specified words in the assignment-->
            <h1>picturegram</h1>
            <h2>LOGIN TO YOUR ACCOUNT</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
       
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
       
        <form action="" method="post">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>username</label>
              <input name="username" type="text" value="" class="form-control" placeholder="username" id="username" required data-validation-required-message="Please enter username.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input name="pass" type="Password" value="" class="form-control" placeholder="Password" id="Password" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button name = "submit" type="submit" value="Login" class="btn btn-primary" id="sendMessageButton">Submit</button>
        </form>


        <!-- Here Putting PHP code to verify login Information with database -->
        <?php

          if(isset($_POST['submit']))
          {
            $username = $_POST['username'];
            $pwd = $_POST['pass'];
            $pwd = md5($pwd);
            $query = "SELECT UserID,Username,PASSWORD from `login` where Username='$username' and PASSWORD='$pwd'";
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $check = mysqli_query($conn, $query);
            $result = mysqli_num_rows($check);
            if ($result)
             {
              $userRow = mysqli_fetch_array($check);
              $userID = $userRow['UserID'];

              $_SESSION['user_id']=$userID;
              header('location:index.php');
              }
            else if (!$result)
            {
              echo '<script>alert("Invalid Credentials. Click on Create an Account")</script>';
            }
          }

        ?>

      </div>
    </div>

  </div>

  <hr>

  <!-- Footer -->
  <footer>
   
          
          <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
        
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
