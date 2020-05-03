<?php
    include('connect.php');
    session_start();
    $q = "select Q.que_text,A.ans_text from question Q NATURAL JOIN answer A where admin_id in (select admin_id from admin where admin_uname= '$_SESSION[user_faculty]')";
    $result = mysqli_query($con,$q);
    echo "<table class='tbl' border='0' style='text-align:center;' cellpadding='30'><h4 style= margin-top:20px;><b>Question Answers</b></h4><hr>";
    $srno = 1;
    echo "<th>Sr.Number</th><th>Question</th><th>Answer</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>$srno</td><td>$row[que_text]</td><td>$row[ans_text]</td></tr>";
        $srno ++;
    }
    echo "</table>";
?>