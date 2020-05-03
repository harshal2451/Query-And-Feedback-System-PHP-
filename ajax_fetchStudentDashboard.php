<?php
	include("connect.php");
	
	//fetch total questions asked by student
	$fetch_total_questions = mysqli_query($con,"select count(que_id) as submit_question from question where user_id = $_REQUEST[student_id]");
	$result_total_questions = mysqli_fetch_assoc($fetch_total_questions);
	
	
	//fetch total faculty answers for student questions
	$fetch_total_answers = mysqli_query($con,"select count(ans_id) as faculty_answer from answer where que_id in (select que_id from question where user_id = $_REQUEST[student_id])");
	$result_total_answers = mysqli_fetch_assoc($fetch_total_answers);
	
	
	//fetch total feedbacks submited by students
	$fetch_total_feedback = mysqli_query($con,"select count(que_id) as submit_feedback from feedback where que_id in (select que_id from question where user_id = $_REQUEST[student_id])");
	$result_total_feedback = mysqli_fetch_assoc($fetch_total_feedback);
	
	$dashboard_detail = "$result_total_questions[submit_question],$result_total_answers[faculty_answer],$result_total_feedback[submit_feedback]";
	
	echo $dashboard_detail;
	
	
	
?>