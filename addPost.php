<?php
session_start();
include "connection.php";
$userID = $_SESSION['user_id'];
$userQuery = "SELECT Name FROM users where UserID='$userID'";
$userResult = mysqli_query($conn,$userQuery);
$userRow = mysqli_fetch_array($userResult);
$userprofile = $userRow['Name'];

$post3 = $userprofile;
$uri = explode('/',$_SERVER['REQUEST_URI']);
$baseURL = "http://" . $_SERVER['SERVER_NAME'] .$_SERVER['REQUEST_URI'];
if(isset($_POST['description'])){
    $date = new DateTime();
    $post = $_POST['description'];
    $post2 = $_POST['image'];
    if($post || $post2 || $post3):
    $sql = 'insert into Posts (UserID,PostImage,Post) VALUES ("'. $post3 . '","'. $post2 . '","'. $post . '")';
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    endif;
    $conn->close();
    $post = array();
}
?>


<!DOCTYPE html>
<html lang="en">
<!--Purpose of assignment:
Course:CSCI2170
Date: October 14th 2020
Author: Shawn Shahin B00632190
Description of page:This is the page that allows a user to post on the website. The user will be the author of the created post. Timestamps will also be taken.
Additional Info:
-->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clean Blog - Start Bootstrap Theme</title>

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
        <a class="navbar-brand" href="about.php"><?php echo $userprofile ?></a>
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
                <li class="nav-item">

                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="post.php">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addPost.php">Add Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/addapost.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>picturegram</h1>
                    <h2>ADD NEW POST</h2>

                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form name="comment" id="comment" action="<?php echo $baseURL; ?>" method="post">
                <div class="form-group">
                    <label>Image File Name with Extension</label>
                     <br>
                     <input name="image" type="text" value="" class="form-control" placeholder="Image Name" id="image" required data-validation-required-message="Please enter Name with extension">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                </div>
                <button name = "submit" type="submit" value="Submit" class="btn btn-primary" id="sendMessageButton">Submit</button>
            </form>

    

        </div>
    </div>
</div>


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
