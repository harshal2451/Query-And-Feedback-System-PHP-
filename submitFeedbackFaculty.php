<?php
    include('connect.php');
    $adminQ = mysqli_query($con,"select admin_name from admin where admin_id=".$_REQUEST['admin_id']);
    $adminID = mysqli_fetch_assoc($adminQ);
    $q = "insert into faculty_feedback values (null,".$_REQUEST['admin_id'].",'".$adminID['admin_name']."','".$_REQUEST['rating']."','".$_REQUEST['comment']."')";
    $query = mysqli_query($con,$q);
    if($query){
        echo $adminID['admin_name'];
    }
    else{
        echo "Failed";
    }
?>