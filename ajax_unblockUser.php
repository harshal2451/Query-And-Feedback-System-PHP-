<?php
	include("connect.php");
	
    //$q="select user_name from blocked_user where user_id= $_REQUEST[user_id]";
    //echo $q;
    $fetch_user_name = mysqli_query($con,"select user_name from block_user where user_id= $_REQUEST[user_id]");
    $user_name = mysqli_fetch_assoc($fetch_user_name);
    
    //set user_name to user table
    $update_user_name = mysqli_query($con,"update user set user_name ='$user_name[user_name]' where user_id = $_REQUEST[user_id]");

    //now delete entry of blocked student
    $delete_blocked_user = mysqli_query($con,"delete from block_user where user_id = $_REQUEST[user_id]");
	
    if($delete_blocked_user){
		echo "$user_name[user_name] unblocked Successfully";	
    }
?>