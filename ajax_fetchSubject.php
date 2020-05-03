<?php
	include("connect.php");
	
	$fetch_subject = mysqli_query($con,"select * from subject where dept_id =".$_REQUEST['selected_department']);
	
	echo "<select id='selected_subject' class='input-xlarge' required>";
    echo "<option value=''>Select</option>";
	while($res = mysqli_fetch_assoc($fetch_subject)){
		echo "<option value = $res[sub_id] >$res[sub_name]</option>";
	}
	echo "</select>";
?>