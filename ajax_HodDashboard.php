<?php
    include('connect.php');
    session_start();
    //fetch dept_id
    $fetch_dept_id = mysqli_query($con,"select * from admin where admin_uname = '$_SESSION[user_hod]'");
    $result = mysqli_fetch_assoc($fetch_dept_id);
    $dept = $result['dept_id'];
    
    $fetch_dept_name = mysqli_query($con,"select dept_name from department where dept_id = $dept");
    $result1 = mysqli_fetch_assoc($fetch_dept_name);
    $deptName = $result1['dept_name'];
    
    
    $q = "SELECT A.admin_id,A.admin_name,A.admin_email,B.sub_name from admin A NATURAL JOIN subject B where dept_id= $dept and admin_type='FACULTY'";
    $fetch_data = mysqli_query($con,$q);

    $response = "<h4 style='border-bottom: 1px solid grey;'>Faculties of Department of $deptName</h4><table border='0' style='text-align:center;' cellpadding='30'><tr style='border-bottom: 1px solid lightgrey;'><th>ID</th><th>NAME</th><th>EMAIL</th><th>SUBJECT</th></tr>";
    while($row = mysqli_fetch_assoc($fetch_data)){
        $response .= "<tr style='border-bottom: 1px solid lightgrey;'><td> $row[admin_id] </td><td> $row[admin_name] </td><td> $row[admin_email] </td><td> $row[sub_name] </td></tr>";
    }
    $response .= "</table>";
    echo $response;
?>