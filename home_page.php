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
	
    <style>
        #content{
            top:10%;
            left:10%;
        }
        body{
            background: #F8F8F8;
        }
    
		#background{
            background: white;
            text-align: center;
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
            z-index: 18;
            width: 300px;
            height: 170px;
            margin-top: 200px;
            margin-left: 70px;
            display: inline-table;
            position: relative;
		}
		
		#background1, #background2{
			background: white;
            text-align: center;
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
            z-index: 18;
            display: inline-table;
            width: 300px;
            margin-left: 30px;
            position: relative;
		}
		
		#first, #second, #third{
			height:140px;
			width:120px;
            margin-top: -60px;
		}
		
        #question{
            margin-top: -18px;
        }
	</style>
</head>

<body onLoad="fetchDashboardDetail()">
	
	<div id="navigation" style="position:fixed;width:100%;margin-top:-20px;">
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
	</div>
     <?php include('scroll.php'); ?>
	
                <div class="page-header">
                        <div class="pull-left"  style="margin-top:20px;">
                            <h1>Dashboard</h1>
                        </div>
                </div>
				<?php
					if(isset($_SESSION['user_type'])){
						if($_SESSION['user_type'] == "STUDENT")
							include("student_dashboard.php");
						else if($_SESSION['user_type'] == "FACULTY")
							include("faculty_dashboard.php");
						else if($_SESSION['user_type'] == "HOD")
							include("hod_dashboard.php");             
					}
					
				?>

									
									
		<script type="text/javascript">
			$("#link_dashboard").addClass('active');
	
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-38620714-4']);
			_gaq.push(['_trackPageview']);
	
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
			
			
			
		</script>
	</body>

	
<!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 24 Jan 2014 12:47:08 GMT -->
</html>

