<?php
//Database Connection Code
require_once('dbConnect.php');
$sql = dbConnect();
session_start();
if (isset($_POST['submit'])) {
      // Grab the user-entered log-in data
      $user_username = $_POST['email'];
      $user_password = $_POST['pass'];
      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
       	 $query = "SELECT id,username,emailid,rights FROM forumlogin WHERE emailid = '$user_username' AND password = '$user_password'";
        $data = mysqli_query($sql,$query);
        if (mysqli_num_rows($data)== 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['email'] = $row['emailid'];
          $_SESSION['auth'] = $row['rights'];
          $_SESSION['id']=$row['id'];
          setcookie('email', $row['email'], time() + (60 * 60 * 24 * 30), "/");  // expires in 30 days
          setcookie('auth', $row['rights'], time() + (60 * 60 * 24 * 30), "/");  // expires in 30 days
          setcookie('id', $row['id'], time() + (60 * 60 * 24 * 30), "/");  // expires in 30 days
          $home_url = 'forum.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
         	echo 'Sorry, you must enter a valid email and password to log in.';
          header("Refresh:2; url=index.php", true, 303);
        }
      }
      else {
        // The username/password weren't entered so set an error message
        echo 'Sorry, you must enter your email and password to log in.';
        header("Refresh:2; url=index.php", true, 303);
      }}
      else{
$home_url = 'forum.php';
          header('Location: ' . $home_url);
      }
    
  
?>