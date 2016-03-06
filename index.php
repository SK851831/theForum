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
      <div class="col s12"> <p class="flow-text"><h1>Welcome to Forum</h1></p></div>
      <hr>
      <div class="col s6" >
      	<h3 class="flow-text center-align"> Login </h3>
    <form action="login.php" name="login" id="login" method="post">
      <div class="row">
        <div class="input-field col s8">
          <input  name="email" id="email" type="email" class="validate">
          <label for="email">Email Address</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <input name="pass" id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light" type="submit" name="submit">Login
    <i class="material-icons right">send</i>
  </button>
     
    </form>
  
      </div>
      <div class="col s6">
      	<h3 class="flow-text center-align"> Register </h3>
    <form action="register.php" name="register" id="register" method="post">
      <div class="row">
        <div class="input-field col s8">
          <input  id="emailReg" name="email" type="email" class="validate">
          <label for="emailReg">Email Address</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <input id="passwordReg" name="pass" type="password" class="validate">
          <label for="passwordReg">Password</label>
        </div>
      </div>
     <div class="row">
        <div class="input-field col s8">
          <input id="CpasswordReg" name="cpass" type="password" class="validate">
          <label for="CpasswordReg">Confirm Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <input name="name" id="nameReg" type="text" class="validate">
          <label  for="nameReg">Name</label>
        </div>
      </div>

      <button class="btn waves-effect waves-light" type="submit" name="submit">Register
    <i class="material-icons right">send</i>
  </button>
    </form>
      </div>
    </div>
      	</div>		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="js/materialize.min.js"></script>
	</body>
</html>