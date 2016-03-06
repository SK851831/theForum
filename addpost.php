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
	      			<p class="flow-text"><h3>Add Topic</h3></p>
	      		</div>
	      		<form method="post" action="postadd.php">
			      <div class="row">
			        <div class="input-field col s8">
			          <input  id="tname" name="tname" type="text" class="validate">
			          <label for="tname">Topic Name</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s8">
			        	<textarea id="content" name="pc" class="materialize-textarea"></textarea>
          				<label for="textarea1">Content</label>
			        </div>
			      </div>
			     <button class="btn waves-effect waves-light" type="submit" name="submit">Post
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