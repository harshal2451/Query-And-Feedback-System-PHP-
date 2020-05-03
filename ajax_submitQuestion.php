<?php
	include("connect.php");
	// Set your timezone
	date_default_timezone_set('Asia/Kolkata');
	
	$date = date('d-m-Y', time());
	
	$time = date("h:i:s a");
	
	$query = "insert into question values(null,'$_REQUEST[question]','$date','$time','Unanswered',$_REQUEST[selected_subject],$_REQUEST[user_id])";
	$submit_question = mysqli_query($con,"insert into question values(null,'$_REQUEST[question]','$date','$time','Unanswered',$_REQUEST[dept_id],$_REQUEST[selected_subject],$_REQUEST[user_id])");
	
	if($submit_question){
		echo "<h4 style = color:green; >Question Submitted Successfully</h4>";
	}else{
		echo "<h4 style = color:green; >$query</h4>";
	}
?>