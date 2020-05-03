<?php
    include('connect.php');
    $q = "insert into feedback values(null,'".$_REQUEST['f_rate']."','".$_REQUEST['f_comment']."',".$_REQUEST['admin_id'].",".$_REQUEST['que_id'].")";
    $query = mysqli_query($con,$q);
    if($query){
        echo "Success";
    }
    else{
        echo "Failed";
    }
?>