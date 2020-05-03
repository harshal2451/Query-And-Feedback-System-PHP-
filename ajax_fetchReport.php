<?php
	session_start();
	include("connect.php");
    if(isset($_REQUEST['select'])){
        //select * from admin where admin_type='faculty' and dept_id in (select dept_id from admin where admin_name);
        //fetch dept_id of hod
        if($_REQUEST['select'] == "ans"){
        $fetch_dept_id = mysqli_query($con,"select * from admin where admin_uname = '$_SESSION[user_hod]'");
        $result = mysqli_fetch_assoc($fetch_dept_id);

        //fetch dept_name
        $fetch_dept_name = mysqli_query($con,"select dept_name from department where dept_id=$result[dept_id]");
        $dept_name = mysqli_fetch_assoc($fetch_dept_name);

        //fetch faculty with rank according to feedback score
        $fetch_rank = mysqli_query($con,"select avg(f_score) as score,count(admin_id) as no_of_question,admin_id as ID,admin.admin_name,admin.dept_id from feedback natural join admin group by admin_id having admin.dept_id = $result[dept_id] order by score desc");

        $rank = 1;
        echo "<table border='0' style='text-align:center;' cellpadding='30'><h4 style= margin-top:20px;><b>Department Of $dept_name[dept_name]</b></h4><button class='form-submit' onclick='downloadReport()'><i class='fa fa-download''></i> 
        <a href='downloaded_report/report-answer.txt' download>Download</a></button><hr>";
        echo "<th>Rank</th><th>Faculty Name</th><th>No Of Question</th><th>Score Out Of 10</th><th>See Comments</th>";
        while($res = mysqli_fetch_assoc($fetch_rank)){
            $s = round($res['score'], 2);
            echo "<tr><td>$rank</td><td>$res[admin_name]</td><td>$res[no_of_question]</td><td>$s</td><td><button id='commentget' value='$res[ID]' class='see'  onclick='getComments(this.value)'>Comment</button></td></tr>";
            $rank++;
        }

        //fetch faculty who has not given answer to any question.
        $fetch_remaining = mysqli_query($con,"SELECT * FROM admin WHERE admin_type = 'FACULTY' and NOT EXISTS ( SELECT admin_id FROM feedback WHERE admin_id = admin.admin_id)");
        while($res = mysqli_fetch_assoc($fetch_remaining)){
            echo "<tr><td> - </td><td>$res[admin_name]</td><td> 0 </td><td> 0 </td><td>No comments</td></tr>";
            $rank++;
        }
        echo "</table>";
        }
    
    else {
        //fetch dept_id of hod
        $fetch_dept_id = mysqli_query($con,"select * from admin where admin_uname = '$_SESSION[user_hod]'");
        $result = mysqli_fetch_assoc($fetch_dept_id);

        //fetch dept_name
        $fetch_dept_name = mysqli_query($con,"select dept_name from department where dept_id=$result[dept_id]");
        $dept_name = mysqli_fetch_assoc($fetch_dept_name);

        //fetch faculty with rank according to feedback score
        $fetch_rank = mysqli_query($con,"select avg(rating) as score,count(admin_id) as no_of_question,admin_id,admin.admin_name,admin.dept_id from faculty_feedback natural join admin group by admin_id having admin.dept_id = $result[dept_id] order by score desc");

        $rank = 1;
        echo "<table border='0' style='text-align:center;' cellpadding='30'><h4 style= margin-top:20px;><b>Department Of $dept_name[dept_name]</b></h4><button class='form-submit' onclick='downloadReport()'><i class='fa fa-download''></i> <a href='downloaded_report/report-feedback.txt' download>Download</a></button><hr>";
        echo "<th>Rank</th><th>Faculty Name</th><th>No Of feedback</th><th>Score Out Of 10</th><th>See Comments</th>";
        while($res = mysqli_fetch_assoc($fetch_rank)){
            $s = round($res['score'], 2);
            echo "<tr><td>$rank</td><td>$res[admin_name]</td><td>$res[no_of_question]</td><td>$s</td><td><button id='commentget' value='$res[admin_id]' class='see' onclick='getComments(this.value)'>Comment</button></td></tr>";
            $rank++;
        }echo "</table>";

        /*//fetch faculty who has not given answer to any question.
        $fetch_remaining = mysqli_query($con,"SELECT * FROM admin WHERE admin_type = 'FACULTY' and NOT EXISTS ( SELECT admin_id FROM feedback WHERE admin_id = admin.admin_id)");
        while($res = mysqli_fetch_assoc($fetch_remaining)){
            echo "<tr><td> $rank </td><td>$res[admin_name]</td><td> 0 </td><td> 0 </td><td>No comments</td></tr>";
            $rank++;
        }*/
        
    }
  }

    //download report
    if(isset($_REQUEST['download_select'])){
    if($_REQUEST['download_select'] == "ans"){
        //select * from admin where admin_type='faculty' and dept_id in (select dept_id from admin where admin_name);
        //fetch dept_id of hod
        $fetch_dept_id = mysqli_query($con,"select * from admin where admin_uname = '$_SESSION[user_hod]'");
        $result = mysqli_fetch_assoc($fetch_dept_id);

        //fetch dept_name
        $fetch_dept_name = mysqli_query($con,"select dept_name from department where dept_id=$result[dept_id]");
        $dept_name = mysqli_fetch_assoc($fetch_dept_name);

        //fetch faculty with rank according to feedback score
        $fetch_rank = mysqli_query($con,"select avg(f_score) as score,count(admin_id) as no_of_question,admin_id,admin.admin_name,admin.dept_id from feedback natural join admin group by admin_id having admin.dept_id = $result[dept_id] order by score desc");

        $rank = 1;
        
        // Set your timezone
        date_default_timezone_set('Asia/Kolkata');

        $date = date('d-m-Y', time());

        $time = date("h:i:s a");
        
        $file_text = "\t\t\t\tReport Of Faculty Performance\n\n\n\n";
        $file_text .= "Date:$date\t\t\t\t\t\tTime:$time\n\n\n\n";
        
        $file_text .= "Rank\t\tFaculty Name\t\tNo Of Question\t\tScore Out Of 10\n\n";
        
        while($res = mysqli_fetch_assoc($fetch_rank)){
            $s = round($res['score'], 2);
            $file_text .= "$rank\t\t$res[admin_name]\t\t\t$res[no_of_question]\t\t\t\t$s";
            $file_text .="\n\n------------------------------------------------------------------------\n\n";
            $rank++;
        }

        //fetch faculty who has not given answer to any question.
        $fetch_remaining = mysqli_query($con,"SELECT * FROM admin WHERE admin_type = 'FACULTY' and NOT EXISTS ( SELECT admin_id FROM feedback WHERE admin_id = admin.admin_id)");
        while($res = mysqli_fetch_assoc($fetch_remaining)){
            $file_text .=" - \t\t$res[admin_name]\t\t\t\t\t0\t\t\t\t0";
            $file_text .="\n\n------------------------------------------------------------------------\n\n";
            $rank++;
        }
        //create or open file 
        $myfile = fopen("downloaded_report/report-answer.txt", "w") or die("Unable to open file!");
    
        fwrite($myfile, $file_text);
    
        fclose($myfile);
        
        //echo $file_text;
    }
    
    else{
        //fetch dept_id of hod
        $fetch_dept_id = mysqli_query($con,"select * from admin where admin_uname = '$_SESSION[user_hod]'");
        $result = mysqli_fetch_assoc($fetch_dept_id);

        //fetch dept_name
        $fetch_dept_name = mysqli_query($con,"select dept_name from department where dept_id=$result[dept_id]");
        $dept_name = mysqli_fetch_assoc($fetch_dept_name);

        //fetch faculty with rank according to feedback score
        $fetch_rank = mysqli_query($con,"select avg(rating) as score,count(admin_id) as no_of_question,admin_id,admin.admin_name,admin.dept_id from faculty_feedback natural join admin group by admin_id having admin.dept_id = $result[dept_id] order by score desc");

        $rank = 1;
        
        // Set your timezone
        date_default_timezone_set('Asia/Kolkata');

        $date = date('d-m-Y', time());

        $time = date("h:i:s a");
        
        $file_text = "\t\t\t\tReport Of Faculty Performance\n\n\n\n";
        $file_text .= "Date:$date\t\t\t\t\t\tTime:$time\n\n\n\n";
        
        
        $file_text = "Rank\t\tFaculty Name\t\tNo Of Feedback\t\tScore Out Of 10\n\n";
        
        while($res = mysqli_fetch_assoc($fetch_rank)){
            $s = round($res['score'], 2);
            $file_text .= "$rank\t\t$res[admin_name]\t\t\t$res[no_of_question]\t\t\t\t$s";
            $file_text .="\n\n------------------------------------------------------------------------\n\n";
            $rank++;
        }

        //fetch faculty who has not given answer to any question.
        /*$fetch_remaining = mysqli_query($con,"SELECT * FROM admin WHERE admin_type = 'FACULTY' and NOT EXISTS ( SELECT admin_id FROM feedback WHERE admin_id = admin.admin_id)");
        while($res = mysqli_fetch_assoc($fetch_remaining)){
            $file_text .=" - \t\t$res[admin_name]\t\t\t\t\t0\t\t\t\t0";
            $file_text .="\n\n------------------------------------------------------------------------\n\n";
            $rank++;
        }*/
        
        //create or open file 
        $myfile = fopen("downloaded_report/report-feedback.txt", "w") or die("Unable to open file!");
    
        fwrite($myfile, $file_text);
    
        fclose($myfile);
    
    }
    
    }
?>