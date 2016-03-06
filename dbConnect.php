<?php
	function dbConnect()
	{
		$sql = mysqli_connect('localhost' ,'root','','test');
		return $sql;
	}
?>