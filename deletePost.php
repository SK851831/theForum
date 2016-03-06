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
  if($admin==1 || $usercurrent == $byuser){
  $query="Delete from `test`.`post` WHERE `post`.`id` = '$id'";
        $data = mysqli_query($sql,$query);
         mysqli_close($sql);
           $home_url = 'forum.php';
           header('Location:' . $home_url);
         } }
         ?>
