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
           
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $uid=$_GET['userid'];
  
  $query = "SELECT * FROM post WHERE id = '$id'";
        $data = mysqli_query($sql,$query);
        if (mysqli_num_rows($data)== 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $content = $row['postcontent'];
          $tname = $row['topicname'];
          $likes = $row['likes'];
          $commenttotal = $row['commenttotal'];
          $byuser = $row['byuser'];
          $name_query = mysqli_query($sql,"SELECT * FROM forumlogin WHERE id='$byuser' ");
          $name_query = mysqli_fetch_array($name_query);
          $name = $name_query['username'];
        }
        if($admin==1 || $usercurrent == $byuser){
         ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Basic Forum</title>
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
      <div class="col s12"> <p class="flow-text"><h1>Welcome to Forum </h1><a class="waves-effect waves-light btn" href="forum.php">Forum</a></p></div>
      <hr>
	</div>
	<div class="row">
	      		<div class="col s12"> 
	      			<p class="flow-text"><h3>Edit Topic</h3></p>
	      		</div>
	      		<form method="post" action="postupdate.php">
			      <div class="row">
			        <div class="input-field col s8">
			          <input  id="tname" name="tname" value="<?php echo $tname; ?>" type="text" class="validate">
			          <label for="tname"></label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s8">
			        	<input type="hidden" name="postid" value="<?php echo $id;?>">
			        	<textarea id="content" name="pc"  class="materialize-textarea"><?php echo $content; ?></textarea>
          				<label for="textarea1"></label>
			        </div>
			      </div>
			     <button class="btn waves-effect waves-light" type="submit" name="submit">Update
    <i class="material-icons right">send</i>
  </button>
			    </form>
  
	      	</div>
		</div>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="js/materialize.min.js"></script>
	</body>
</html>
<?php } } ?>