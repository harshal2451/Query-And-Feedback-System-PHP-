<?php
    session_start();
    include('connect.php');
    $fetch_login_data = "select * from user where user_name='".$_REQUEST['user_name']."' and user_pwd='".$_REQUEST['user_pwd']."'";
	//echo $fetch_login_data;
    $query = mysqli_query($con,$fetch_login_data);
    $result = mysqli_fetch_assoc($query);
    $flag_blocked = 0;
	
	if(mysqli_num_rows($query) > 0){
		
		if($result['user_name'] && $result['user_pwd']){
			$_SESSION['user_student'] = $result['user_name'];	
			$_SESSION['user_id'] = $result['user_id'];	
			$_SESSION['user_type'] = $result['user_type'];		
			echo "Success";
		}
		
	}else{
	
			$fetch_login_data = "select * from admin where admin_uname='".$_REQUEST['user_name']."' and admin_pwd='".$_REQUEST['user_pwd']."'";
			//echo $fetch_login_data;
			$query = mysqli_query($con,$fetch_login_data);
			$result = mysqli_fetch_assoc($query);
			
			if(mysqli_num_rows($query) > 0){
				if($result['admin_type'] == "FACULTY"){
					
					if($result['admin_uname'] && $result['admin_pwd']){
						$_SESSION['user_faculty'] = $result['admin_uname'];		
						$_SESSION['user_type'] = $result['admin_type'];		
						echo "Success";
					}else{
						echo "Invalid Username and Password";
						$flag_blocked = 1;
					}
					
				}else if($result['admin_type'] == "HOD"){
					
					if($result['admin_uname'] && $result['admin_pwd']){
						$_SESSION['user_hod'] = $result['admin_uname'];		
						$_SESSION['user_type'] = $result['admin_type'];		
						echo "Success";
					}else{
						echo "Invalid Username and Password";
						$flag_blocked = 1;
					}
					
				}
			}else{
				$flag_blocked = 1;
			}
	}
	
	if($flag_blocked == 1){
		
		//fetch username acording to password to show msg to student that u r blocked
			$fetch_login_data = "select user_name,user_pwd from user where user_pwd='".$_REQUEST['user_pwd']."'";
    		$query = mysqli_query($con,$fetch_login_data);
			
    		$result = mysqli_fetch_assoc($query);
			
			if(mysqli_num_rows($query) > 0){
				if($result['user_name'] == null)
					echo "You are blocked according to your misbehaviour";
			}
			else
				echo "Invalid Username and Password";
	}else
		echo "Invalid Username and Password";
?>