<?php
    include('connect.php');
    session_start();
    $rank = 1;
    $avg1 = 0;
    $avg2 = 0;
    $count = 0;
    //echo "select dept_name from department where dept_id = ".$_REQUEST['dept_id'];
    $fetch_dept_name = mysqli_query($con,"select dept_name from department where dept_id = ".$_REQUEST['dept_id']);
    $dept_name = mysqli_fetch_assoc($fetch_dept_name);
    //feedback data fetching.
    $result = mysqli_query($con,"select * from feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
    if(mysqli_num_rows($result) == 0){
        $result = mysqli_query($con,"select * from faculty_feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
        if(mysqli_num_rows($result) == 0)
            echo "<h4>No data Available for you right now!</h4>";
        else{
            echo "<table class='tbl' border='0' style='text-align:center;' cellpadding='30'><h4 style= margin-top:20px;><b>Department Of $dept_name[dept_name]</b></h4><hr>";
            echo "<th>Sr.Number</th><th>Score</th><th>Comment</th>";
            //data from faculty_feedback table.
            $result = mysqli_query($con,"select * from faculty_feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
            while($res = mysqli_fetch_assoc($result)){
            echo "<tr><td>$rank</td><td>$res[rating]</td><td>$res[comment]</td></tr>";
            $rank++;
        }
        echo "</table>";
        $result = mysqli_query($con,"select avg(rating) as avg from faculty_feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
        $row = mysqli_fetch_assoc($result);
        $s = round($row['avg'], 2);
        echo "Your overall score is $s";
        }
    }
    else{
        $result = mysqli_query($con,"select * from feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
        echo "<table class='tbl' border='0' style='text-align:center;' cellpadding='30'><h4 style= margin-top:20px;><b>Department Of $dept_name[dept_name]</b></h4><hr>";
        echo "<th>Sr.Number</th><th>Score</th><th>Comment</th>";
        while($res = mysqli_fetch_assoc($result)){
            if($rank == 1)
                echo "<tr style='border-bottom: 1px solid grey;border-top: 1px solid grey;'><td>$rank</td><td>$res[f_score]</td><td>$res[f_comment]</td></tr>";
            else
                echo "<tr style='border-bottom: 1px solid grey;'><td>$rank</td><td>$res[f_score]</td><td>$res[f_comment]</td></tr>";
            $rank++;
        }
        $result = mysqli_query($con,"select sum(f_score) as avg,count(f_score) as count from feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
        if(mysqli_num_rows($result) != 0){
            $row = mysqli_fetch_assoc($result);
            $avg1 = $row['avg'];
            $count += $row['count'];
        }
        //data from faculty_feedback table.
        $result = mysqli_query($con,"select * from faculty_feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
        while($res = mysqli_fetch_assoc($result)){
            echo "<tr><td>$rank</td><td>$res[rating]</td><td>$res[comment]</td></tr>";
            $rank++;
        }
        echo "</table>";
        $result = mysqli_query($con,"select sum(rating) as avg,count(rating) as count from faculty_feedback where admin_id in (select admin_id from admin where admin_uname='".$_SESSION['user_faculty']."')");
        if(mysqli_num_rows($result) != 0){
            $row = mysqli_fetch_assoc($result);
            $avg2 = $row['avg'];
            $count += $row['count'];
        }
        $avg = ($avg1+$avg2)/$count;
        $s = round($avg, 2);
        echo "Your overall score is $s";
    }
/*select F.f_id,Q.que_id,Q.que_text,A.ans_id,A.ans_text from feedback F NATURAL JOIN question Q NATURAL JOIN answer A where admin_id=1 GROUP by que_id*/
?>