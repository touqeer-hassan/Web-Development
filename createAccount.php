<?php
  session_start();
  include "connection.php";
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

  <title>Create an Account</title>

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
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
        <!-- changed the logo image to logo.jpg-->
  <header class="masthead" style="background-image: url('img/createaccount.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
              <!-- changed the headers to the specified words in the assignment-->
            <h1>picturegram</h1>
            <h2>Create a New Account</h2>
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
              <label>Name</label>
              <input name="user" type="text" value="" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
            <div class="form-group floating-label-form-group controls">
              <label>User Name</label>
              <input name="username" type="text" value="" class="form-control" placeholder="username" id="username" required data-validation-required-message="Please enter username.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>E-Mail ID</label>
              <input name="email" type="text" value="" class="form-control" placeholder="E-Mail" id="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>
             <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input name="pass" type="Password" value="" class="form-control" placeholder="Password" input required data-validation-required-message="Please enter your Password.">
              <p class="help-block text-danger"></p>
            </div>
             <div class="form-group floating-label-form-group controls">
              <label>Confirm Password</label>
              <input name="confirmpass" type="Password" value="" class="form-control" placeholder="Confirm Password" id="Password" required data-validation-required-message="Please confrim your Password.">
              <p class="help-block text-danger"></p>
            </div>
             <div class="form-group floating-label-form-group controls">
              <label>Image File Name with Extension</label>
                     <br>
                     <input name="image" type="text" value="" class="form-control" placeholder="Image Name" id="image" required data-validation-required-message="Please enter Name with extension">
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button name = "submit" type="submit" value="Submit" class="btn btn-primary" id="sendMessageButton">Submit</button>
          
        </form>


        <?php

	        if(isset($_POST['submit']))
	        {
	          	$user = $_POST['user'];
	          	$username = $_POST['username'];

	          	$chquery = "SELECT * FROM `login` WHERE username = '$username'";
	          	$isDup = mysqli_query($conn, $chquery);
	          	$isDuplicate = mysqli_num_rows($isDup);
	          	if($isDuplicate == 0)
	          	{
		          	$pwd = $_POST['pass'];

		          	$length = strlen($pwd);
		          	$uppercase = preg_match('@[A-Z]@', $pwd);
					$lowercase = preg_match('@[a-z]@', $pwd);
					$number    = preg_match('@[0-9]@', $pwd);
					$specialChars = preg_match('@[^\w]@', $pwd);
					$Error = 0;

					if($length<7)
		          	{
		          		$Error = 1;
		          		echo "* Please Enter Minimum 7 Characters in Password"; ?><br><?php
		          	}
			        if(!$uppercase)
			        {
			        	$Error = 1;
			        	echo "* Please Enter 1 Capital Character in Password"; ?><br><?php
			        }
			        if(!$lowercase)
			        {
			        	$Error = 1;
			        	echo "* Please Enter 1 Character in Password"; ?><br><?php
			        }
			        if(!$number)
			        {
			        	$Error = 1;
			        	echo "* Please Enter 1 Number in Password"; ?><br><?php
			        }
			        if(!$specialChars)
			        {
			        	$Error = 1;
			        	echo "* Please Enter 1 Special Character in Password"; ?><br><?php
			        }

			        if($Error == 0)
			        {

			        	$pwdcnfrm = $_POST['confirmpass'];
			           	if ($pwd == $pwdcnfrm)
			            {
				            $pwd = md5($pwd);
							$email = $_POST['email'];
							$description = $_POST['description'];
							$image = $_POST['image'];
				           	$query = "INSERT INTO `users`(`Name`, `Email`, `About`, `AboutImage`) VALUES ('$user','$email','$description','$image')";
				        	$result = mysqli_query($conn, $query);

				        	$sQuery = "SELECT * FROM `users` WHERE email='$email'";
				        	$sResult = mysqli_query($conn, $sQuery);
				        	$sRow = mysqli_fetch_array($sResult);
				        	$sID = $sRow['UserID'];

				        	$lQuery = "INSERT INTO `login`(`UserID`, `Username`, `Password`) VALUES ('$sID','$username','$pwd')";
				        	$lResult = mysqli_query($conn, $lQuery);

				           	if ($result && $lResult)
				           	{
				           	 	echo "Your Account created successfully";
					           	$_SESSION['user_id']=$sID;
				           	}
				           	else if (!$result || !$lResult)
				           	{
				           	 	echo '<script>alert("Something went worng with database")</script>';
				           	}
			       		}
			        }

			        else
			        {
			        	?><h5 style="color:red"><?php echo "Error"; ?></h5><?php
			        }


	            }
	            else if($isDuplicate != 0)
				{
					echo '<script>alert("User Already Exist")</script>';
				}
				else if ($pwd != $pwdcnfrm)
				{
					echo '<script>alert("Password did not Match")</script>';
				}

				else
				{
					echo '<script>alert("Sorry Invalid Operation")</script>';
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