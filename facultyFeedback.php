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
	
	<title>Student - Dashboard</title>
	<!-- Bootstrap --> 
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	
    <!-- feedback css -->
    <link rel="stylesheet" type="text/css" href="css/feedback.css">

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
	
    
    <style>
        body{
            background-color: #F8F8F8;
        }
        .select-faculty{
            background: #fff;
          box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -moz-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -webkit-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -o-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -ms-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
            border-radius: 20px;
          -moz-border-radius: 20px;
            -webkit-border-radius: 20px;
          -o-border-radius: 20px;
          -ms-border-radius: 20px;
            top: 50%;
            left: 50%;
            position: fixed;
            max-width: 700px;
            border-radius: 20px;
            margin: 0 auto; 
            transform: translate(-50%, -50%);
            width: 700px;
            z-index: 20;
            margin-top: -225px;
        }
        .labelSelect1{
            margin-left: 10px;
        }
        .feed-back{
            pointer-events: none;
            background: #f8f8f8;
          box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -moz-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -webkit-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -o-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
          -ms-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
            border-radius: 20px;
          -moz-border-radius: 20px;
            -webkit-border-radius: 20px;
          -o-border-radius: 20px;
          -ms-border-radius: 20px;
            top: 50%;
            left: 50%;
            position: fixed;
            max-width: 700px;
            border-radius: 20px;
            transform: translate(-50%, -50%);
            width: 700px;
            height: 500px;
            z-index: 20;
            margin-top: 80px;
        }
        .feedback-header{
            border-bottom: 1px solid #c9c3c3;
            padding: 7px 10px;
            z-index: 20;
        }
        .feedback-body{
            padding: 7px 10px;
            z-index: 19;
        }
        .row{
            border-bottom: 1px solid #C9C3C3;
        }
        .ratingDIV, .commentDIV{
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #select_err{
            color: red;
        }
    </style>
    
	<script>
        function facultySelected(){
            var admin_id = document.getElementById("admin_id").value;
            if(admin_id == "select faculty"){
               document.getElementById("select_err").innerHTML = "<h6>Please select faculty!</h6>";
                document.getElementById("feed-back").style.pointerEvents = "none";
                document.getElementById("feed-back").style.background = "#F8F8F8";
            }
            else{
                document.getElementById("select_err").innerHTML = "";
                document.getElementById("feed-back").style.pointerEvents = "auto";
                document.getElementById("feed-back").style.background = "#FFF";
            }
        }
        function clicked(){
            document.getElementById("rating_err").innerHTML = "";
        }
        function textin(){
            document.getElementById("comment_err").innerHTML = "";
        }
        function submitFeedback1(){
            var admin_id = document.getElementById("admin_id").value;
            if(admin_id == "select faculty"){
                document.getElementById("select_err").innerHTML = "<h6>Please select faculty!</h6>"; 
            }
            else{
                var admin_id = document.getElementById("admin_id").value;
                var r1 = document.getElementById("r1");
                var r2 = document.getElementById("r2");
                var r3 = document.getElementById("r3");
                var r4 = document.getElementById("r4");
                var score = 0.0;
                var cmt = document.getElementById("comments");
                if(r1.checked == true){
                    document.getElementById("rating_err").innerHTML = "";
                    score = 2.5;
                }
                else if(r2.checked == true){
                    document.getElementById("rating_err").innerHTML = "";
                    score = 5.0;
                }
                else if(r3.checked == true){
                    document.getElementById("rating_err").innerHTML = "";
                    score = 7.5;
                }
                else if(r4.checked == true){
                    document.getElementById("rating_err").innerHTML = "";
                    score = 10.0;
                }
                else{
                    var rating = document.getElementById("rating_err");
                    rating.innerHTML = "<h6>Please select experience</h6>";
                    rating.style.marginTop = ""; 
                    rating.style.marginleft = "400px"; 
                }
                if(cmt.value.length == 0){
                     document.getElementById("comment_err").innerHTML= "<h6>Please write comment so faculty can improve themself!</h6>";
                }
                else if(cmt.value.length < 5){
                    document.getElementById("comment_err").innerHTML= "<h6>Please write comment with at least 5 length!</h6>";
                }
                else{
                     if(score != 0){
                        var comment = document.getElementById("comments").value;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST","submitFeedbackFaculty.php?admin_id="+admin_id+"&rating="+score+"&comment="+cmt.value,false);
                        xmlhttp.send(null);
                        var textres = xmlhttp.responseText;
                        if(textres != "Failed"){
                            //alert(xmlhttp.responseText);
                            alert("Feedback submitted successfully");
                            window.location.replace("facultyFeedback.php");
                        }
                        else{
                            alert(textres);
                        }
                    }
                }
            }   
        }
        function resetClick(){
            document.getElementById("comment_err").innerHTML="";
            document.getElementById("rating_err").innerHTML="";
        }
    </script>
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
	   </div><?php include('scroll.php'); ?>
        <!-- SELECT FACULTY -->
        <div class="select-faculty" id="select-faculty">
            <div class="labelSelect1" id="labelSelect1" style="margin-left:15px;"><h4>Select Faculty:</h4>
                <div id="select_err"></div>
            <select name="dept" class="select-css" id="admin_id" style="margin-top: -10px;margin-left:15px;width: 645px;" onchange="facultySelected()">
                <option value="select faculty">Select Faculty</option>
                <?php 
                    include('connect.php');
                    $result = mysqli_query($con,"select * from admin where admin_type='FACULTY' and dept_id in (select dept_id from user where user_name='".$_SESSION[user_student]."')");
                    while($r = mysqli_fetch_assoc($result)){
                        $d = $r['admin_id'];
                        $n = $r['admin_name'];
                        echo "<option value='$d'>$d-$n</option>";   
                    }
                ?>
            </select>  
            </div>
        </div>
        
        <!-- SUBMIT FACULTY FEEDBACK -->
        <div class="feed-back" id="feed-back">
            <div class="feedback-header" id="feedback-header">
                <div class="labelSelect1" id="labelSelect1" style="margin-left:15px;"><h4>Faculty Feedback:</h4></div>
            </div>
            <div class="feedback-body" id="feedback-body">
                <div >Please provide your feedback below: </div>
                <form role="form" method="post" id="reused_form">
                    <div class="row" style="margin-left:10px;">
                        <div class="ratingDIV">
                            <label style="font-weight: bold;">How do you rate your overall experience?</label>               
                                <label class="radio-inline">
                                    <input type="radio" name="experience" id="r1" value="bad" onclick="clicked()" style="margin-top: -2px;">
                                    Bad 
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="experience" id="r2" value="average" onclick="clicked()" style="margin-top: -2px;">
                                    Average 
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="experience" id="r3" value="good" onclick="clicked()" style="margin-top: -2px;">
                                    Good 
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="experience" id="r4" value="excellent" onclick="clicked()" style="margin-top: -2px;">
                                    Excellent 
                                </label>
                            <div id="rating_err"></div>
                        </div>
                    </div>
                    <div class="row" style="margin-left:10px;">
                        <div id="comment_err" style="color:red;"></div>
                        <div class="commentDIV">
                            <label for="comments"> Comments:</label>
                        <textarea oninput="textin()" class="form-control" type="textarea" name="comments" id="comments" maxlength="6000" rows="7" draggable="false" style="width: 570px; margin-top:10px; border: 1px solid;"></textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-left:7px;padding:10px 15px;">
                        <div style="margin-top: 5px; margin-left:200px">
                            <input type="button" class="btn1" value="Submit" onclick="submitFeedback1()">
                            <input type="reset" class="btn1" id="reset" onclick="resetClick()"/>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </body>

	<script type="text/javascript">
			$("#link_give_feedback").addClass('active');
	
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-38620714-4']);
			_gaq.push(['_trackPageview']);
	
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>  
<!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 24 Jan 2014 12:47:08 GMT -->
</html>

