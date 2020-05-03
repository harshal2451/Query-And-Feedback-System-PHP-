<?php
	session_start();
	include('connect.php');
	//echo $_SESSION['user_id'];
	if(isset($_SESSION['user_type'])){
		// login for student	
		if($_SESSION['user_type'] == "STUDENT"){
		    if(isset($_SESSION['user_id'])){
		        if(!isset($_SESSION['user_student']))
				    header("location:index.php");
                else{
                    //for blocked student
                    $fetch_user_name = mysqli_query($con,"select user_id,user_name from user where user_id = $_SESSION[user_id]");
                    $result = mysqli_fetch_assoc($fetch_user_name);
                    
                    if($result['user_name'] == null){
                        if($_SESSION['user_id'] == $result['user_id'])
                            unset($_SESSION['user_id']);
                    }
                }
		    }else{
		          header("location:index.php");
		    }
			
		}
		
		// login for faculty	
		else if($_SESSION['user_type'] == "FACULTY"){
			if(!isset($_SESSION['user_faculty']))
				header("location:index.php");
		}
			
		// login for hod	
		else if($_SESSION['user_type'] == "HOD"){
			if(!isset($_SESSION['user_hod']))
				header("location:index.php");
		}
		
	}else{
		if(!isset($_SESSION['user_student']))
				header("location:index.php");
		else if(!isset($_SESSION['user_faculty']))
				header("location:index.php");
		else if(!isset($_SESSION['user_hod']))
				header("location:index.php");
	}
	//echo $_SESSION['user_id'];
?>


<!doctype html>
<html>

<!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 24 Jan 2014 12:45:42 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>Admin - Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	
	
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Flot -->
	<script src="js/plugins/flot/jquery.flot.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- FullCalendar -->
	<script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>

	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	
	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body>
	
	<div id="navigation" style="position:fixed;width:100%;">
		<?php
		if(isset($_SESSION['user_type'])){
		
			if($_SESSION['user_type'] == "STUDENT")
				include("student_header.php");
			else if($_SESSION['user_type'] == "FACULTY")
				include("faculty_header.php");
			else if($_SESSION['user_type'] == "HOD")
				include("hod_header.php");
		}
		?>
	</div> <?php include('scroll.php'); ?>
	<div class="container-fluid" id="content">
		
		<div id="main" style="margin:1px;margin-top:40px;">
			<div class="container-fluid">
				
						<div class="box box-bordered box-color" style="margin:30px 400px; width:550px;" >
                        	<div id="promptSuccess" style="margin-left:150px; "></div>
							<div class="box-title" >
								<h3><i class="icon-th-list"></i>Ask Question</h3>		
							</div>
							<div class="box-content nopadding" >
							
								<form method="POST" class='form-horizontal form-bordered'>
									
									<div class="control-group">
										<label for="textfield" class="control-label">Select Department</label>
										<div class="controls">
										<select id="selected_department" class="input-xlarge" onChange="fetchSubject()">
                                        	<option value="">Select</option>
										<?php
											include("connect.php");
											$fetch_bank = "select * from department";
											$fetch_data = mysqli_query($con,$fetch_bank);
											while($fetch_result = mysqli_fetch_assoc($fetch_data)){
												echo "<option value = $fetch_result[dept_id] >$fetch_result[dept_name]</option>";	
											}
										?>
                                        </select>
										</div>
									</div>
                                    
                               		<div class="control-group">
										<label for="textfield" class="control-label">Select Subject</label>
										<div class="controls">
                                            <div id="get_subject">
                                            <select id="selected_subject" class="input-xlarge" >
                                                <option>Select</option>
                                            </select>
                                            </div>
                                            <div id="promptSubject"></div>
										</div>
                                        
									</div>
                                    
                                    <div class="control-group">
										<label for="textfield" class="control-label">Enter Question</label>
										<div class="controls">
										<textarea id="question" rows="7" style="width:256px; background-color:white;" ></textarea>	
                                        <div id="promptQuestion"></div>
										</div>
									</div>
					
									<div class="form-actions">
                                    	<?php
											//fetch user id for student to submit question
											include("connect.php");
											$fetch_userid = "select * from user where user_name='".$_SESSION['user_student']."'";
											$execute_userid = mysqli_query($con,$fetch_userid);
											$result = mysqli_fetch_assoc($execute_userid);
										?>
										<button type="button" id="user_id" value="<?php echo $result['user_id']; ?>" class="btn btn-primary" onClick="submitQuestion()">Submit</button>
										<input type="reset" name="reset"  class="btn btn-primary" style="margin-left:30px;">
                                        <input type="hidden" id="user_dept_id" value="<?php echo $result['dept_id'];?>">
									</div>
								</form>
							</div>
						</div>
					</div>
			</div>
            
         </div>
          
    
				
									
									
		<script type="text/javascript">
			$("#link_question").addClass('active');
	
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-38620714-4']);
			_gaq.push(['_trackPageview']);
	
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
			
		</script>
        
        <script type="text/javascript">
		
			function fetchSubject(){
				
				var selected_department = document.getElementById("selected_department").value;
				
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("POST","ajax_fetchSubject.php?selected_department="+selected_department,false);
				xmlhttp.send(null);
				document.getElementById("get_subject").innerHTML = xmlhttp.responseText;			
				
			}
			
			function submitQuestion(){
				
				document.getElementById("promptSubject").innerHTML = "";	
				document.getElementById("promptQuestion").innerHTML = "";
					
				var selected_subject = document.getElementById("selected_subject").value;
				var question_text = document.getElementById("question").value;
				var question_length = question_text.trim().length;
				
				//alert(question_length);
				
				if(selected_subject == "Select"){
				  document.getElementById("promptSubject").innerHTML = "<h6 style='color:red;'>Please select the subject</h6>";	
				}else if(question_text == ""){
				  document.getElementById("promptQuestion").innerHTML = "<h6 style='color:red;'>Please Enter the Question</h6>";	
				}else if(question_length < 10 || question_length > 500){
				  document.getElementById("promptQuestion").innerHTML = "<h6 style='color:red;'>Question length must be 10 to 500 characters</h6>";	
				}else{
				
					if (confirm("Are You Sure?")) {
					
						var selected_subject = document.getElementById("selected_subject").value;
						var question_text = document.getElementById("question").value;
						
						var user_id = document.getElementById("user_id").value;
						var dept_id = document.getElementById("user_dept_id").value;
						//alert(user_id);
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.open("POST","ajax_submitQuestion.php?selected_subject="+selected_subject+"&question="+question_text+"&user_id="+user_id+"&dept_id="+dept_id,false);
						xmlhttp.send(null);
						
						document.getElementById("promptSuccess").innerHTML = xmlhttp.responseText;
						
					}
					
				}
			}
		</script>
	</body>

	
<!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 24 Jan 2014 12:47:08 GMT -->
</html>

