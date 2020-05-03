<?php
        include('connect.php');
      $register_data = "insert into user values(null,'".$_REQUEST['user_fname']."','".$_REQUEST['user_name']."','".$_REQUEST['user_pwd']."','STUDENT','".$_REQUEST['user_email']."',".$_REQUEST['dept_id'].")"; 
        $res = mysqli_query($con,$register_data) or die(mysqli_error($con));
        if($res){
            echo "Success";
        }
        else{
            echo "Registration Falied";
        }

?>