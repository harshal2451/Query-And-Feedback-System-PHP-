<?php
	//fetch student id for dashboard details
	include("connect.php");
	$fetch_adminid = "select * from user where user_name='".$_SESSION['user_student']."'";
	$execute_adminid = mysqli_query($con,$fetch_adminid);
	$result = mysqli_fetch_assoc($execute_adminid);
?>  
<style>
    body{
        background: #f8f8f8;
    }
    #background,#background1,#background2{
        opacity: 0;
    }
</style>
                <!---------- send faculty id  to javascript-->
                <input type="hidden" id="student_id" value="<?php echo $result['user_id']; ?>"/>
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
                	<img id="third" src="img/customer-feedback.png">
                    <div id="feedback"></div>
                    </center>
                </div>
                <script type="text/javascript">
					
					//fetch dashboard detail
					function fetchDashboardDetail(){
						
						var student_id = document.getElementById("student_id").value;
						
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.open("POST","ajax_fetchStudentDashboard.php?student_id="+student_id,false);
						xmlhttp.send(null);
						
						
						var dashboard_detail = xmlhttp.responseText.split(",");
						//alert(xmlhttp.responseText);
						
						document.getElementById("question").innerHTML = "<h3>Submit Questions</h3><h2>"+dashboard_detail[0]+"</h2>";
						document.getElementById("answer").innerHTML = "<h3 style='margin-top:-9px;'>Faculty Answers</h3><h2>"+dashboard_detail[1]+"</h2>";
						document.getElementById("feedback").innerHTML = "<h3 style='margin-top:-9px;'>Submited Feedback</h3><h2>"+dashboard_detail[2]+"</h2>";
						document.getElementById("background").style.opacity="1";
                        document.getElementById("background1").style.opacity="1";
                        document.getElementById("background2").style.opacity="1";
					}
					
				</script>