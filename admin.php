<?php
//Database Connection Code
require_once('dbConnect.php');
$sql = dbConnect();
session_start();
if (!isset($_SESSION['email'])) {
    if (isset($_COOKIE['email']) && isset($_COOKIE['auth'])&& isset($_COOKIE['id'])) {
      $_SESSION['email'] = $_COOKIE['email'];
      $_SESSION['auth'] = $_COOKIE['auth'];
       $_SESSION['id'] = $_COOKIE['id'];
    }
  }
  if (!isset($_SESSION['email'])) {
  $home_url = 'index.php';
          header('Location: ' . $home_url);
}
$admin = $_SESSION['auth'];
if($admin!=1){
  $home_url = 'index.php';
          header('Location: ' . $home_url);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin - Basic Forum</title>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="css/materialize.min.css">
	</head>
	<body>
		<div class="container">
        <!-- Page Content goes here -->
        <div class="row">
      <div class="col s12"> <p class="flow-text"><h1>Welcome, Admin!</h1><a class="waves-effect waves-light btn" href="index.php">Forum</a></p></div>
      <hr>
	</div>
	<div class="row">
	      		
	      		<h4>Notification Panel</h4>

<?php


$query = mysqli_query($sql,"SELECT * FROM post ORDER BY time DESC");
                                                  if($query){
                                                  while($row = mysqli_fetch_assoc($query))
                                                  {
                                                      $post_id = $row['id'];
                                                      $topic_name = $row['topicname'];
                                                      $content = $row['postcontent'];
                                                      $byuser = $row['byuser'];
                                                      $moderate = $row['moderate'];
                                                      if($moderate == 0){
                                                        $name_query = mysqli_query($sql,"SELECT * FROM forumlogin WHERE id='$byuser' ");
                                                        $name_query = mysqli_fetch_array($name_query);
                                                        $name = $name_query['username'];
  
 ?>

	      		<div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
            <div class="col s2">
              <img src="blank.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="black-text">
                <h4>Post Validation - By <?php echo $name; ?></h4>
                <h6><?php echo $topic_name; ?></h6>
                <p class="truncate"><?php echo $content; ?></p>
              	<a class="waves-effect waves-light btn" href="validate1.php?id=<?php echo $post_id;?>">Accept</a>
                <a class="waves-effect waves-light btn" href="validate.php?id=<?php echo $post_id;?>">Reject</a>
              </span>
            </div>
          </div>
        </div>
      </div>
  <?php } } } ?>
	      	</div>
		</div>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="js/materialize.min.js"></script>
	</body>
</html>