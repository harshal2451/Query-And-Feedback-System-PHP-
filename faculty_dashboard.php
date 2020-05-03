<?php
	//fetch admin id for dashboard details
	include("connect.php");
	$fetch_adminid = "select * from admin where admin_uname='".$_SESSION['user_faculty']."'";
	$execute_adminid = mysqli_query($con,$fetch_adminid);
	$result = mysqli_fetch_assoc($execute_adminid);
	//echo $result['admin_id'];
		
?> <style>
     #background,#background1,#background2{
        opacity: 0;
    }
</style>
				<!---------- send faculty id  to javascript-->
                <input type="hidden" id="faculty_id" value="<?php echo $result['admin_id']; ?>"/>
                
                <!---------- send dept id  to javascript-->
                <input type="hidden" id="dept_id" value="<?php echo $result['dept_id']; ?>"/>
                
				<div id="background"><center>
                	<img id="first" src="img/question.png">
                    <div id="question"></div>
                    </center>
                </div>
                
                <div id="background1"><center>
                	<img id="second" src="img/answer1.png">
                    <div id="answer"></div>
                    </center>
                </div>
                
                <div id="background2"><center>
                	<img id="third" src="img/blocked.png">
                    <div id="block_user"></div>
                    </center>
                </div>
                
                <script type="text/javascript">
					
					//fetch dashboard detail
					function fetchDashboardDetail(){
						
						var faculty_id = document.getElementById("faculty_id").value;
						var dept_id = document.getElementById("dept_id").value;
						
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.open("POST","ajax_fetchFacultyDashboard.php?faculty_id="+faculty_id+"&dept_id="+dept_id,false);
						xmlhttp.send(null);
						
						
						var dashboard_detail = xmlhttp.responseText.split(",");
						//alert(xmlhttp.responseText);
						
						document.getElementById("question").innerHTML = "<h3>Student Questions</h3><h2>"+dashboard_detail[0]+"</h2>";
						document.getElementById("answer").innerHTML = "<h3 style='margin-top:-9px;'>Submited Answers</h3><h2>"+dashboard_detail[1]+"</h2>";
						document.getElementById("block_user").innerHTML = "<h3 style='margin-top:-9px;'>Block Users</h3><h2>"+dashboard_detail[2]+"</h2>";
						document.getElementById("background").style.opacity="1";
                        document.getElementById("background1").style.opacity="1";
                        document.getElementById("background2").style.opacity="1";
					}
					
				</script>