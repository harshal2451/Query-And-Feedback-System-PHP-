<?php
	include("connect.php");
	
	//fetch answer for faculty to update answer
	if(isset($_REQUEST['admin_id']) && isset($_REQUEST['que_id'])){
		
		$fetch_answer = mysqli_query($con,"select * from answer where que_id = $_REQUEST[que_id] and admin_id = $_REQUEST[admin_id]");
		$result = mysqli_fetch_assoc($fetch_answer);
		
		echo $result['ans_text'];
	}
	
	//fetch answer for student
	else if(isset($_REQUEST['que_id'])){
		
        $answer_detail = ""; 
        $q = "select A.ans_text,A.ans_date,A.ans_time,B.admin_name,B.admin_id from answer A NATURAL JOIN admin B where A.que_id = $_REQUEST[que_id]";
        $fetch_answer = mysqli_query($con,$q);
        while($result = mysqli_fetch_assoc($fetch_answer)){
            $answer_detail .= "<hr><div style='float: left;'>Faculty: $result[admin_name]</div><div style='margin-left:300px;'>Date:$result[ans_date]&nbsp;&nbsp;Time:$result[ans_time]</div><div>Answer:- $result[ans_text]<br><a onclick='giveFeedback($result[admin_id])'>Give Feedback</a></div>";
        }

        echo $answer_detail;
	}

    else if(isset($_REQUEST['all_que_id'])){
	
        $answer_detail = ""; 
        $q = "select A.ans_text,A.ans_date,A.ans_time,B.admin_name,B.admin_id from answer A NATURAL JOIN admin B where A.que_id = $_REQUEST[all_que_id]";
        $fetch_answer = mysqli_query($con,$q);
        while($result = mysqli_fetch_assoc($fetch_answer)){
            $answer_detail .= "<hr><div style='float: left;'>Faculty: $result[admin_name]</div><div style='margin-left:300px;'>Date:$result[ans_date]&nbsp;&nbsp;Time:$result[ans_time]</div><div>Answer:- $result[ans_text]</div>";
        }

        echo $answer_detail;
	}
	
	//fetch answer for faculty my_answer.php
	else if(isset($_REQUEST['question_id'])){
		$fetch_answer = mysqli_query($con,"select * from answer where que_id = $_REQUEST[question_id]");
		$result = mysqli_fetch_assoc($fetch_answer);
		
		//fetch faculty name 
		$fetch_faculty_name = mysqli_query($con,"select * from admin where admin_id=$result[admin_id]");
		$res = mysqli_fetch_assoc($fetch_faculty_name);
		
		$answer_detail = "<div style='float: left;'>Faculty:$res[admin_name]&nbsp;&nbsp;</div><div style='margin-left:300px;'>Date:$result[ans_date]&nbsp;&nbsp;Time:$result[ans_time]</div><div>Answer:- $result[ans_text]<br></div>";
		
		echo $answer_detail;
	}
	
	
?>