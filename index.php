<!--Purpose of assignment:
Course: CSCI2170
Date: October 14th 2020
Author: Shawn Shahin B00632190
Description of page:This is the home page that will show the relevant posts on the website , the post includes the time of post and the author of the mentioned post.
Additional Info: This page is now converted to php in order to display all the posts for the website.
-->


<?php
session_start();
include "connection.php";
error_reporting(0);
$userID = $_SESSION['user_id'];
$userQuery = "SELECT Name FROM users where UserID='$userID'";
$userResult = mysqli_query($conn,$userQuery);
$userRow = mysqli_fetch_array($userResult);
$userprofile = $userRow['Name'];

$query = "SELECT Users.Name as UserName, Posts.PostId,Posts.PostImage,Post,`Date`
FROM Posts
LEFT JOIN Users
ON Posts.UserID = Users.UserID ORDER BY PostID DESC;";
$result = $conn->query($query);
//get URL segments of current URL
$uri = explode('/', $_SERVER['REQUEST_URI']);
$baseURL = "http://" . $_SERVER['SERVER_NAME'] . '/' . $uri[1] . '/'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- changed the title to picturegram-->
    <title>picturegram - HOME</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand"
         <?php
         if($userprofile==false)
         {  ?>
          href="login.php" 
         <?php
            }
         else if ($userprofile == true)
            {  ?>
            href="about.php"
          <?php } ?>
          >
            <?php
                echo "Welcome ".$userprofile;
            ?>
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <!-- changed the navigation menu items and added links so it can lead to the correct page -->
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php
                    if($userprofile == false)
                    {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About Us</a>
                </li>
                <?php
                    }
                    else if($userprofile == true)
                    {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="post.php">Posts</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="addPost.php">Add Post</a>
                </li>
                 <?php
                }
                 ?>
                <?php
                    if($userprofile == false)
                    {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="createAccount.php">Create Account</a>
                </li>
                <?php
                    }
                    else if($userprofile == true)
                    {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<!-- changed the logo image to logo.jpg-->
<header class="masthead" style="background-image: url('img/home.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <!-- changed title of the page to picturegrame and the subheading to your life in pictures-->
                    <h1>picturegram</h1>
                    <span class="subheading">your life in pictures</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $formatDate = date("F jS, Y - g:ia", strtotime($row['Date'])) . "\n";
                        ?>
                        <a href="<?php echo $baseURL . 'post.php?id=' . $row['PostId'];  $_SESSION['post_id']=$row['PostId']; ?>"><img
                                    src=files/<?php echo($row['PostImage']);  ?> style ="
                         width: 720px; height:380px" > </a>
                        <h2>
                            <a href="<?php echo $baseURL . 'post.php?id=' . $row['PostId'];$_SESSION['post_id']=$row['PostId']; ?>"><?php echo substr($row['Post'], 0, 40); ?>
                        </h2></a>
                        <i>Posted by <a
                                    href='<?php echo $baseURL . 'post.php?id=' . $row['PostId'] . $_SESSION['post_id']=$row['PostId'] ?>'><?php echo $row['UserName'] ?>
                        </i></a>
                        <?php
                        echo "\n";
                        echo " on $formatDate";
                        echo "<br><br>";
                    }
                }
                ?>
            </div>
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
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

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>
</body>

</html>
