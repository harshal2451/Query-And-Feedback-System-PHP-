<?php
	include("connect.php");
	// Set your timezone
	date_default_timezone_set('Asia/Kolkata');
	
	$date = date('d-m-Y', time());
	
	$time = date("h:i:s a");
	
	$submit_answer = mysqli_query($con,"update answer set ans_text ='$_REQUEST[answer]',ans_date = '$date',ans_time = '$time' where que_id = $_REQUEST[que_id] and admin_id = $_REQUEST[admin_id]");
	
	if($submit_answer)
		echo "<h6 style = color:green; >Answer Updated Successfully</h6>";
	
?>