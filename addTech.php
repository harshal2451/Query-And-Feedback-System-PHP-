<?php
	include("connect.php");
	// Set your timezone
	date_default_timezone_set('Asia/Kolkata');
	
	$date = date('d-m-Y', time());
	
	$time = date("h:i:s");
	
	$submit_question = mysqli_query($con,"insert into student values(null,$_REQUEST[question],$date,$time,$_REQUEST[user_id])");
	echo "<script>alert(question submitted successfully)</script>";
?>