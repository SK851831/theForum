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
$usercurrent = $_SESSION['id'];
if(isset($_GET['id'])){
  $id=$_GET['id'];
$output = 1;
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
        else {

          // The username/password are incorrect so set an error message
          $output = 0;
        header("Refresh:5; Location: index.php", true, 303);

        }



}
if($output==0){
  header("Location: index.php", true, 303);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $tname;?> - Basic Forum</title>
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
	      			<p class="flow-text"><h1>Welcome to Forum</h1> <a class="waves-effect waves-light btn" href="index.php">Forum</a></p>
	      		</div>
	      		<hr>
	      	</div>
	      	<div class="container">
	      	<div class="row">
	      		<div class="col s12"> 


            

	      			<p class="flow-text"><h3><?php echo $tname; ?></h3></p>
	      		</div>
	      		<hr>
	      		<div class="col s12">
        <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
            <div class="col s2">
              <img src="blank.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="black-text">
                <h6>By <?php echo $name; ?></h6>
                <p><?php echo $content;?><br>
<?php            if($admin==1 || $usercurrent == $byuser){
?>
              <a class="waves-effect waves-light btn" href="editPost.php?id=<?php echo $id; ?>&userid=<?php echo $byuser; ?>">Edit</a>
              <?php  } ?>
   <?php            if($admin==1){
 ?>
              <a class="waves-effect waves-light btn" href="deletePost.php?id=<?php echo $id; ?>&userid=<?php echo $byuser; ?>">Delete</a></p> 
          <?php  } ?>
              </span>
            </div>
          </div>
        </div>
      </div>
      <h5>Comments (<?php echo $commenttotal; ?>)</h5>
      <div class="col s8 offset-s2">
        <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
            <div class="col s2">
              <img src="blank.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="black-text">
              <form method="post" action="addcmt.php">
                <div class="row">
                  <input type="hidden" name="postid" value="<?php echo $id;?>">
              <div class="input-field col s8">
                <textarea id="content" name="cc" class="materialize-textarea"></textarea>
                  <label for="textarea1">Comment</label>
              </div>
            </div>
           <button class="btn waves-effect waves-light" type="submit" name="submit">Reply
    <i class="material-icons right">send</i>
        </button>
          </form>

              </span>
            </div>
          </div>
        </div>
      </div>
      <?php 
        $query1= mysqli_query($sql,"SELECT * FROM comment WHERE postid = '$id' ORDER BY time DESC");
       if($query1){
        while($row1 = mysqli_fetch_assoc($query1)){
          $cmtid = $row1['id'];
          $content1 = $row1['commcont'];
          $byuser1 = $row1['userid'];
          $name_query1 = mysqli_query($sql,"SELECT * FROM forumlogin WHERE id='$byuser1' ");
          $name_query1 = mysqli_fetch_array($name_query1);
          $name1 = $name_query1['username'];
        ?>
      <div class="col s8 offset-s2">
        <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
            <div class="col s2">
              <img src="blank.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="black-text">
                <h6>By <?php echo $name1; ?></h6>
                <p><?php echo $content1; ?><br>
              
   <?php            if($admin==1){
 ?>
              <a class="waves-effect waves-light btn" href="deleteCmt.php?id=<?php echo $cmtid; ?>&userid=<?php echo $byuser1; ?>&pid=<?php echo $id; ?>">Delete</a></p> 
          <?php  } ?>
              </span>
            </div>
          </div>
        </div>
      </div>
      <?php } } ?>
        	</div>
			</div>
      	</div>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="js/materialize.min.js"></script>
	</body>
</html>