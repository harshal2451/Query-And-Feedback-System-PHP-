<?php
	session_start();
	 if(isset($_SESSION['user_student']) && isset($_SESSION['user_id']))
	 	header("location:home_page.php");		
	 else if(isset($_SESSION['user_faculty']))
	 	header("location:home_page.php");
	 else if(isset($_SESSION['user_hod']))
	 	header("location:home_page.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style_login.css">
    <style>
        #myDIV, #uname_err, #pwd_err{
            color: red;
        }
    </style>
</head>
<body>
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container" style="margin-top:-100px;">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="img/signin-image.jpg" alt="sing up image"></figure>
                        <a href="registration.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form" action="index.php">
                            <div id="myDIV"></div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" id="your_name" placeholder="Your Name" oninput="unamein()"/>
                            </div>
                            <div id="uname_err"></div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password"  id="your_pass" placeholder="Password" oninput="pwdin()"/>
                            </div>
                            <div id="pwd_err"></div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="button" name="login" id="signin" class="form-submit" value="Log in" onClick="validate()"/>
                                <input type="reset" name="login" id="signin" class="form-submit" value="Reset" style="margin-left:40px;"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        function unamein(){
            document.getElementById("uname_err").innerHTML = "";
        }
        function pwdin(){
            document.getElementById("pwd_err").innerHTML = "";
        }
        function validate(){
            var textres = "";
			var uname = document.getElementById("your_name").value;
            var pwd = document.getElementById("your_pass").value;
            if(uname.length == 0){
                document.getElementById("uname_err").innerHTML = "<h6>Username Required!</h6>";
            }
            else if(pwd.length == 0){
                document.getElementById("pwd_err").innerHTML = "<h6>Password Required!</h6>";
            }
            else{
                //alert(uname);
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST","checkUser.php?user_name="+uname+"&user_pwd="+pwd,false);
                xmlhttp.send(null);
                textres = xmlhttp.responseText;
                if(textres.match("Success")){
                    window.location.replace("home_page.php");
                }else{
                    document.getElementById("myDIV").innerHTML = "<h5>"+xmlhttp.responseText+"</h5>";   
                }
            }
        }
    </script>
</body>
</html>