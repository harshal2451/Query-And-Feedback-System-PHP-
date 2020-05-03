<?php
    include('connect.php');
    session_start();
    //fetch dept_id
    $fetch_dept_id = mysqli_query($con,"select * from block_user where dept_id = '$_REQUEST[dept_id]'");
   
   
    
   
    $response = "<h4 style='border-bottom: 1px solid grey;'>Blocked Students</h4><table border='0' style='text-align:center;' cellpadding='30'><tr style='border-bottom: 1px solid lightgrey;'><th>No</th><th>NAME</th><th>Action</th></tr>";
    
    $no = 1;
    
    if(mysqli_num_rows($fetch_dept_id) > 0){
        
        while($result = mysqli_fetch_assoc($fetch_dept_id)){
            $response .= "<tr style='border-bottom: 1px solid lightgrey;'><td> $no </td><td> $result[user_fname] </td><td> <button value='$result[user_id]' class='form-submit' onclick='unblockUser(this.value)'>Unblock</button></td></td></tr>";
            $no++;
        }
        $response .= "</table>";
        echo $response;
    }else
        echo "<h3 style='color:red'>No One Blocked till now</h3>";
?>