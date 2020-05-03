<?php
	include("connect.php");
	//echo "$_REQUEST[user_name].suer_id";
	//fetch user id;
	$fetch_user_id = mysqli_query($con,"select * from user where user_name='$_REQUEST[user_name]'") or die(mysqli_error($con));
    $result_user_id = mysqli_fetch_assoc($fetch_user_id);
	
	//delete all questions of blocked user
	
	//but first we have to delete answer of question those are asked by blocked student
	$delete_answer = mysqli_query($con,"delete from answer where que_id in (select que_id from question where user_id = $result_user_id[user_id])");
	
	$delet_feedback = mysqli_query($con,"delete from feedback where que_id in (select que_id from question where user_id = $result_user_id[user_id])");
	
	
	//Now we can delete question
	$delete_question = mysqli_query($con,"delete from question where user_id = $result_user_id[user_id]");
	
   /* $q ="insert into block_user values(null,$result_user_id[user_id],'$result_user_id[user_fname]','$result_user_id[user_name]',$result_user_id[dept_id])";
    echo $q;*/
	$insert_block_user = mysqli_query($con,"insert into block_user values(null,$result_user_id[user_id],'$result_user_id[user_fname]','$result_user_id[user_name]',$result_user_id[dept_id])");
	
	//update username as null to block student
    $q = "update user set user_name='' where user_id = $result_user_id[user_id]";
   // echo $q;
	$block_user = mysqli_query($con,"update user set user_name=null where user_id = $result_user_id[user_id]");
	
	
	
	if($block_user){
		echo "$_REQUEST[user_name] blocked Successfully";	
	}
	
	
?>