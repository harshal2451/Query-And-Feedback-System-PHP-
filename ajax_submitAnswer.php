<?php
	include("connect.php");
	// Set your timezone
	date_default_timezone_set('Asia/Kolkata');
	
	$date = date('d-m-Y', time());
	
	$time = date("h:i:s a");
	
	$submit_answer = mysqli_query($con,"insert into answer values(null,'$_REQUEST[answer]','$date','$time',$_REQUEST[que_id],$_REQUEST[admin_id])");
	
	
	//update question status
	$update_status = mysqli_query($con,"update question set que_status ='Answered' where que_id=".$_REQUEST['que_id']);
	
	if($update_status)
		echo "<h6 style = color:green; >Answer Submited Successfully</h6>";
?>