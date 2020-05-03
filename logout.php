<?php
	session_start();
	
	if(isset($_SESSION['user_type'])){
		// logout for student	
		if($_SESSION['user_type'] == "STUDENT")
			unset($_SESSION['user_student']);
		
		// logout for faculty	
		else if($_SESSION['user_type'] == "FACULTY")
			unset($_SESSION['user_faculty']);
			
		// logout for hod	
		else if($_SESSION['user_type'] == "HOD")
			unset($_SESSION['user_hod']);
			
		unset($_SESSION['user_type']);
		header("location:index.php");
	}
	
	
	
?>