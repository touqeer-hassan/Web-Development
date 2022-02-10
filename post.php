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
$postId = 0;
$userID = $_SESSION['user_id']; 

if(is_null($_GET['id']))
{

    $postId = $_SESSION['post_id'];
}
else
{

    $postId = $_GET['id'];
    
}
$userQuery = "SELECT Name FROM users where UserID='$userID'";
$userResult = mysqli_query($conn,$userQuery);
$userRow = mysqli_fetch_array($userResult);
$userprofile = $userRow['Name'];

$query = 'SELECT Users.Name as UserName,Posts.UserID, Posts.PostId,Posts.PostImage,Post,`Date`
FROM Posts
LEFT JOIN Users
ON Posts.UserID = Users.UserID where Posts.PostId = "'.$userID.'"';
$result = $conn->query($query)->fetch_assoc();

$uri = explode('/', $_SERVER['REQUEST_URI']);
$baseURL = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// made functio
function findkey($array, $val)
{
    foreach ($array as $key => $value) {
        $d = in_array($val, $value);
        if ($d) {
            return $key;
        }
    }
}

$comments = "SELECT Users.Name as UserName,Comments.Comment,Comments.Date
FROM Comments
LEFT JOIN Users
ON Comments.UserID = Users.UserID where Comments.PostID = '$postId'";
$resultcomments = $conn->query($comments);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Post</title>
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
<body style="margin-top: 0px; margin-left: 20px; margin-right: 20px;">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="about.php"><?php echo "$userprofile"; ?></a>
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

<!-- gets the title and opens file to be able to use
    The array_map returns an array containing the results by applying the callback
        !-->
<?php
/*
   $varName = $_GET['title'];
       $file = fopen("files/posts.csv", 'r') or die("Cannot open file. Sorry!");
           $csv = array_map('str_getcsv', file('files/posts.csv'));
       $key = findkey($csv, $varName);
       $data = fgetcsv($file);
   $data = fgetcsv($file);
   $num = count($data);
   $array = $csv[$key]; */
?>

<header class="masthead" style="background-image: url(img/post-sample-image.jpg) ">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">

                    
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content -->
<!-- Preview Image -->
<div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <div class="container">
    <div class="row">
<?php 
if ($postId > 0) 
{
    $pQuery = "SELECT * FROM `posts` WHERE PostID = '$postId'";
    $result = mysqli_query($conn, $pQuery);
                    while ($row = $result->fetch_assoc())
                     {
                        $formatDate = date("F jS, Y - g:ia", strtotime($row['Date'])) . "\n";
                        ?>
                        <div><img
                                    src=files/<?php echo($row['PostImage']);  ?> style ="
                         width: 720px; height:380px" ></div>
                        <h2>
                            <div href="<?php echo $baseURL . 'post.php?id=' . $row['PostId'] ?>"><?php echo substr($row['Post'], 0, 40); ?>
                        </h2> </div>
                        <?php
                        echo "\n";
                        echo " on $formatDate";
                        echo "<br><br>";
                    }
                }
                ?>
            </div>
        </div>
         </div>
        </div>
<img class="img-fluid rounded" src="farm.jpg" alt="">
<div style="margin-top: 0px; margin-left: 300px; margin-right: 300px;">
    <!-- Comments Form -->
    <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
            <form action="<?php $_PHP_SELF ?>" method="post">
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                </div>
                <div id="success"></div>
          <button name = "submit" type="submit" value="Submit" class="btn btn-primary" id="submitCommentBtn">Submit</button>
            </form>
        </div>
    </div>
    <!-- Single Comment -->
    <!-- this is the section that will open the comment file and is able to first print the ones that are within it -->
    <?php


    if(isset($_POST['submit']))
            {

                $comment = $_POST['message'];
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $query = "INSERT INTO `comments`(`UserID`, `PostID`, `Comment`) VALUES ('$userID','$postId','$comment')";

                $Result = mysqli_query($conn, $query);

                if($Result)
                {
                    echo "Comment Updated Successfully";
                }
                else
                {
                    echo "Something went wrong!!!";
                }

            }

    if ($resultcomments->num_rows > 0)
     {
    while($row = $resultcomments->fetch_assoc())
     {
        ?>
        <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0"><?php echo $row['UserName'] ?><br><?php echo 'Date: ' . date("F jS, Y - g:ia", strtotime($row['Date'])); ?></h5>
            <?php echo $row['Comment']; ?>
        </div>
        </div>
    <?php }
    }
    ?>
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
