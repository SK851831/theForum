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

if (isset($_POST['submit'])) {
  $id=$_SESSION['id'];
      // Grab the user-entered log-in data
      $tname = $_POST['tname'];
      $pc = $_POST['pc'];
      if (!empty($tname) && !empty($pc)) {
        // Look up the username and password in the database

        $query = "INSERT into post(topicname,postcontent,byuser,time) Values ('$tname','$pc','$id',NOW())";
        $data = mysqli_query($sql,$query);
         mysqli_close($sql);
           $home_url = 'forum.php';
           header('Location:' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
         	echo 'Sorry, pls try again.';
        }
      
    }else{
          $home_url = 'index.php';
          header('Location: ' . $home_url);
      }
    
  
?>