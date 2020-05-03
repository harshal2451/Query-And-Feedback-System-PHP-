<?php
	include("connect.php");
	
	//fetch total questions asked by student
	$fetch_total_questions = mysqli_query($con,"select count(que_id) as submit_question from question where dept_id = $_REQUEST[dept_id]");
	$result_total_questions = mysqli_fetch_assoc($fetch_total_questions);
	
	
	//fetch total faculty answers for student questions
	$fetch_total_answers = mysqli_query($con,"select count(ans_id) as faculty_answer from answer where admin_id = $_REQUEST[faculty_id]");
	$result_total_answers = mysqli_fetch_assoc($fetch_total_answers);
	
	
	//fetch total block student in department
	$fetch_total_block_user = mysqli_query($con,"select count(user_id) as block_user from block_user where dept_id = $_REQUEST[dept_id]");
	$result_total_block_user = mysqli_fetch_assoc($fetch_total_block_user);
	
	
	$dashboard_detail = "$result_total_questions[submit_question],$result_total_answers[faculty_answer],$result_total_block_user[block_user]";
	
	echo $dashboard_detail;
	
	
	
?>