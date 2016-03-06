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
  if (isset($_SESSION['email'])) {
  $home_url = 'forum.php';
          header('Location: ' . $home_url);
}

if (isset($_POST['submit'])) {
      // Grab the user-entered log-in data

      $user_email = $_POST['email'];
      $user_password = $_POST['pass'];
      $user_username = $_POST['name'];
      $user_cpassword = $_POST['cpass'];
      if (!empty($user_username) && !empty($user_password) && !empty($user_cpassword) && !empty($user_email)) {
        // Look up the username and password in the database
        if(strcmp($user_password,$user_cpassword)!=0){
        	echo 'Password AND Confirm password not same';
        	header("Refresh:2; url=index.php", true, 303);
        }
		$query="SELECT * FROM forumlogin where emailid='$user_email'";
	    $result=mysqli_query($sql,$query)
	    or die("error query: ".mysqli_error());
	    if(!($row=mysqli_fetch_array($result))){
	    $query="INSERT INTO forumlogin(emailid,password,username,rights) values('$user_email','$user_password','$user_username',0)";
	    $result=mysqli_query($sql,$query);
	    mysqli_close($sql);
	    echo 'Registered!!!';
        	header("Refresh:2; url=index.php", true, 303);
    		
	    }
	        else{
	            echo 'User Already exists';
        	header("Refresh:2; url=index.php", true, 303);
    		
	        }






     }  	
    }
  
  ?>