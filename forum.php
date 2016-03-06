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
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forum Feed - Basic Forum</title>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="css/materialize.min.css">
	</head>
	<body>
		<div class="container">
        <!-- Page Content goes here -->
	        <div class="row">
	      		<div class="col s12"> 
	      			<p class="flow-text"><h1>Welcome to Forum</h1><a class="waves-effect waves-light btn" href="logout.php">Logout</a> 
						<?php if($admin==1){ ?>
	      				<a class="waves-effect waves-light btn" href="admin.php">Admin</a>
						<?php } ?>
	      			</p>
	      		</div>
	      		<hr>
	      	</div>
	      	<div class="container">
	      	<div class="row">
	      		<div class="col s12"> 
	      			<p class="flow-text"><h3>Forum Feed </h3><a class="waves-effect waves-light btn" href="addpost.php">Add Post</a></p>
	      		</div>
	      		<hr>

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
            	  if($moderate == 1){
            	  	$name_query = mysqli_query($sql,"SELECT * FROM forumlogin WHERE id='$byuser' ");
			          $name_query = mysqli_fetch_array($name_query);
			          $name = $name_query['username'];
			?>


	      		<div class="col s12">
        <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
            <div class="col s2">
              <img src="blank.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="black-text">
                <h5><a href="post.php?id=<?php echo $post_id;?>"><?php echo $topic_name; ?></a></h5>
                <h6>By <?php echo $name; ?></h6>
                <p class="truncate"><?php echo $content; ?></p>
              </span>
            </div>
          </div>
        </div>
      </div>

<?php 
} } }
?>



        	</div>
			</div>
      	</div>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="js/materialize.min.js"></script>
	</body>
</html>