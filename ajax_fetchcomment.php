<?php
    include('connect.php');
//echo $_REQUEST['select'];
    if($_REQUEST['select'] == "ans"){
        $name = mysqli_query($con,"select admin_name from admin where admin_id=".$_REQUEST['admin_id']);
        $adminName = mysqli_fetch_assoc($name);
        $q = "select * from feedback where admin_id=".$_REQUEST['admin_id'];    
        $result = mysqli_query($con,$q);
        $c = 1;
        $cmt = "<div id='cmtd'>
                    <h4 id='gotocomment'>Comments for:&nbsp;".$adminName['admin_name']."</h4>";
        while($row = mysqli_fetch_assoc($result)){
            $cmt .= "
                    <div id='commentText'>$c: ".$row['f_comment']."</div>";
            $c++;
        }$cmt .= "</div>";
        echo $cmt;
    }else{
        $name = mysqli_query($con,"select admin_name from admin where admin_id=".$_REQUEST['admin_id']);
        $adminName = mysqli_fetch_assoc($name);
        $q = "select * from faculty_feedback where admin_id=".$_REQUEST['admin_id'];    
        $result = mysqli_query($con,$q);
        $c = 1;
        $cmt = "<div id='cmtd'>
                    <h4 id='gotocomment'>Comments for:&nbsp;".$adminName['admin_name']."</h4>";
        while($row = mysqli_fetch_assoc($result)){
            $cmt .= "
                    <div id='commentText'>$c: ".$row['comment']."</div>";
            $c++;
        }$cmt .= "</div>";
        echo $cmt;
    }
    
?>