<?php
	session_start();
	include("connect.php");
	
	//fetch all questions for student to see answer from my_questions.php
	if(isset($_REQUEST['student_id'])){
		$fetch_allQuestions = mysqli_query($con,"select * from question where user_id =".$_REQUEST['student_id']." order by que_date desc");
		
		if(mysqli_num_rows($fetch_allQuestions) > 0){
		
			while($res = mysqli_fetch_assoc($fetch_allQuestions)){
			 ?><!-- The Modal -->
				<div class="modal" style="margin-top:15px;">
				
				  <!-- Modal content -->
				  <div class="modal-content" style="height:auto;">
					<div class="modal-header">
					   <h6 style="width:auto;">&nbsp;&nbsp;<?php echo $_SESSION['user_student'];?></h6><h6 style=" margin-top:-30px; margin-left:340px;"><?php echo "Date:$res[que_date]&nbsp;&nbsp; Time:$res[que_time]";?></h6>
					</div>
					<div class="modal-body" style="height:auto; overflow:auto; word-wrap: break-word;">
					  
					  <!----- Display Question -->
					  <div><p>Question:-&nbsp;&nbsp;<?php echo $res['que_text']; ?></p></div>
					  
					  <!----- Display answer -->
					  <div id="<?php echo $res['que_id'];?>"></div><br />
					  
                      <?php 
					  	if($res['que_status'] == "Answered")
					  		echo "<div><button id = btn_answer value = $res[que_id] onClick = getAnswer(this.value) style='width:60px; height:auto;'>Answer</button></div>";
						?>
					</div>
					<div class="modal-footer">
						<h6 id="date_time" style="float:left; margin:-1px 5px;"></h6><h6 style="margin:-2px 10px;"><?php echo $res['que_status']; ?></h6>
					</div>
				  </div>
				
				</div>
				
			<?php
			}
		}else{
			echo "<center><h3 style='color:red; border:solid; padding:10px; margin:200px -50px;;'>You have not submited any question yet</h3></center>";
		}
	}



    //fetch all questions and answers for student
    else if(isset($_REQUEST['all_id'])){
        
        //fetch dept_id 
        $fetch_dept_id = mysqli_query($con,"select * from user where user_id = $_REQUEST[all_id] ");
        $result = mysqli_fetch_assoc($fetch_dept_id);
        
		$fetch_allQuestions = mysqli_query($con,"select * from question where dept_id = $result[dept_id] order by que_date desc");
		
		if(mysqli_num_rows($fetch_allQuestions) > 0){
		
			while($res = mysqli_fetch_assoc($fetch_allQuestions)){
                
                //fetch usename of owner of question
				$fetch_username = mysqli_query($con,"select * from user where user_id = $res[user_id]");
				$result_username = mysqli_fetch_assoc($fetch_username);
                
			 ?><!-- The Modal -->
				<div class="modal_all" style="margin-top:15px;">
				
				  <!-- Modal content -->
				  <div class="modal-content" style="height:auto;">
					<div class="modal-header">
					   <h6 style="width:auto;">&nbsp;&nbsp;<?php $result_username['user_name'];?></h6><h6 style=" margin-top:-30px; margin-left:340px;"><?php echo "Date:$res[que_date]&nbsp;&nbsp; Time:$res[que_time]";?></h6>
					</div>
					<div class="modal-body" style="height:auto; overflow:auto; word-wrap: break-word;">
					  
					  <!----- Display Question -->
					  <div><p>Question:-&nbsp;&nbsp;<?php echo $res['que_text']; ?></p></div>
					  
					  <!----- Display answer -->
					  <div id="all<?php echo $res['que_id'];?>"></div><br />
					  
                      <?php 
					  	if($res['que_status'] == "Answered")
					  		echo "<div><button id = all_btn_answer value = $res[que_id] onClick = getAllAnswer(this.value) style='width:60px; height:auto;'>Answer</button></div>";
						?>
					</div>
					<div class="modal-footer">
						<h6 id="date_time" style="float:left; margin:-1px 5px;"></h6><h6 style="margin:-2px 10px;"><?php echo $res['que_status']; ?></h6>
					</div>
				  </div>
				
				</div>
				
			<?php
			}
		}else{
			echo "<h3 style='color:red; border:solid; padding-left:160px; margin:200px 300px;text-align:center;' >You have not submited any question yet</h3>";
		}
	}
	
	//fetch all questions of student for faculty to submit answer from give_answer.php
	else if(isset($_REQUEST['dept_id'])){
		$fetch_allQuestions = mysqli_query($con,"select * from question where dept_id=".$_REQUEST['dept_id']." order by que_date desc");
		
		if(mysqli_num_rows($fetch_allQuestions) > 0){
		
			while($res = mysqli_fetch_assoc($fetch_allQuestions)){
				
				//fetch usename of owner of question
				$fetch_username = mysqli_query($con,"select * from user where user_id = $res[user_id]");
				$result_username = mysqli_fetch_assoc($fetch_username);
			 ?><!-- The Modal -->
				<div class="modal" style="margin-top:15px;">
				
				  <!-- Modal content -->
				  <div class="modal-content" style="height:auto;">
					<div class="modal-header">
					   <h6 style="width:auto;">&nbsp;&nbsp;<?php echo $result_username['user_name'];?></h6><h6 style=" margin-top:-30px; margin-left:340px;"><?php echo "Date:$res[que_date]&nbsp;&nbsp; Time:$res[que_time]";?></h6>
					</div>
					<div class="modal-body" style="height:auto; overflow:auto; word-wrap: break-word;">
					  
                          <!----- Display Question -->
                          <div><p>Question:-&nbsp;&nbsp;<?php echo $res['que_text']; ?></p></div>
                          
                          <!----- Response Message -->
                          <div id="<?php echo $res['que_id']?>"></div><br />
                          
                          <?php
							//set button according to question status						  
                            if($res['que_status'] == "Answered"){                    
                          		echo "<div><button id='give_answer_btn$res[que_id]' value ='$res[que_id]' onClick='giveAnswer(this.value)' style='width:105px; height:auto;'>Edit Answer</button></div>";
					  		}
							else{
								echo "<div><button id='give_answer_btn$res[que_id]' value ='$res[que_id]' onClick='giveAnswer(this.value)' style='width:95px; height:auto;'>Give Answer                                </button></div>";
							}
						  ?>
					</div>
                    	
					<div class="modal-footer">
					<?php
					
						//set status for faculty whether he/she answered or not for particular questiom
						$fetch_answer = mysqli_query($con,"select * from answer where que_id = $res[que_id] and admin_id = $_REQUEST[faculty_id]"); 
						if(mysqli_num_rows($fetch_answer) > 0){
							
							echo "<a id='$result_username[user_name]' style='float:left; margin:-1px 5px;' onclick='blockUser(this.id)'>block $result_username[user_name]</a><h6 id = 'update_status' style='margin:-2px 10px;'>Answered By You</h6>";
							
						}
						else{
							
							echo "<a id='$result_username[user_name]' style='float:left; margin:-1px 5px;' onclick='blockUser(this.id)'>block $result_username[user_name]</a><h6 id = 'update_status' style='margin:-2px 10px;'>Not Answered By You</h6>";
							
						}
						
					?>
					   
					</div>
				  </div>
				
				</div>
				
			<?php
			}
		}else{
			echo "<h3 style='color:red; border:solid; padding-left:240px; margin:200px 300px;' >No Question Found</h3>";
		}
	}


	
//fetch all questions of student for faculty to submit answer from give_answer.php
	else if(isset($_REQUEST['all_for_faculty'])){
		$fetch_allQuestions = mysqli_query($con,"select * from question where dept_id =".$_REQUEST['faculty_dept']." order by que_date desc");
		
		if(mysqli_num_rows($fetch_allQuestions) > 0){
		
			while($res = mysqli_fetch_assoc($fetch_allQuestions)){
				
				//fetch usename of owner of question
				$fetch_username = mysqli_query($con,"select * from user where user_id = $res[user_id]");
				$result_username = mysqli_fetch_assoc($fetch_username);
			 ?><!-- The Modal -->
				<div class="modal_all" style="margin-top:15px;">
				
				  <!-- Modal content -->
				  <div class="modal-content" style="height:auto;">
					<div class="modal-header">
					   <h6 style="width:auto;">&nbsp;&nbsp;<?php echo $result_username['user_name'];?></h6><h6 style=" margin-top:-30px; margin-left:340px;"><?php echo "Date:$res[que_date]&nbsp;&nbsp; Time:$res[que_time]";?></h6>
					</div>
					<div class="modal-body" style="height:auto; overflow:auto; word-wrap: break-word;">
					  
                          <!----- Display Question -->
                          <div><p>Question:-&nbsp;&nbsp;<?php echo $res['que_text']; ?></p></div>
                          
                          <!----- Response Message -->
                          <div id="all<?php echo $res['que_id']?>"></div><br />
                          
                          <?php
							//set button according to question status						  
                            if($res['que_status'] == "Answered")
					  		echo "<div><button id = all_btn_answer value = $res[que_id] onClick = getAllAnswer(this.value) style='width:60px; height:auto;'>Answer</button></div>";
						  ?>
					</div>
                    	
					<div class="modal-footer">
					<?php
					
						//set status for faculty whether he/she answered or not for particular questiom
						$fetch_answer = mysqli_query($con,"select * from answer where que_id = $res[que_id] and admin_id = $_REQUEST[all_for_faculty]"); 
						if(mysqli_num_rows($fetch_answer) > 0){
							
							echo "<h6 id = 'update_status' style='margin:-2px 10px;'>Answered By You</h6>";
							
						}
						else{
							
							echo "<h6 id = 'update_status' style='margin:-2px 10px;'>Not Answered By You</h6>";
							
						}
						
					?>
					   
					</div>
				  </div>
				
				</div>
				
			<?php
			}
		}else{
			echo "<center><h3 style='color:red; border:solid; padding:10px; margin:200px -50px;'>No Question Found</h3></center>";
		}
	}
    
	//fetch faculty answers but first we have to fetch questions of faculty answers
	else if($_REQUEST['admin_id']){
		
		$fetch_allQuestions = mysqli_query($con,"select * from question where que_id in (select que_id from answer where admin_id = $_REQUEST[admin_id]) order by que_date desc");
		
		if(mysqli_num_rows($fetch_allQuestions) > 0){
		
			while($res = mysqli_fetch_assoc($fetch_allQuestions)){
				
				//fetch usename of owner of question
				$fetch_username = mysqli_query($con,"select * from user where user_id = $res[user_id]");
				$result_username = mysqli_fetch_assoc($fetch_username);
				
			 ?><!-- The Modal -->
				<div class="modal" style="margin-top:15px;">
				
				  <!-- Modal content -->
				  <div class="modal-content" style="height:auto;">
					<div class="modal-header">
					   <h6 style="width:auto;">&nbsp;&nbsp;<?php echo $result_username['user_name'];?></h6><h6 style=" margin-top:-30px; margin-left:340px;"><?php echo "Date:$res[que_date]&nbsp;&nbsp; Time:$res[que_time]";?></h6>
					</div>
					<div class="modal-body" style="height:auto; overflow:auto; word-wrap: break-word;">
					  
					  <!----- Display Question -->
					  <div><p>Question:-&nbsp;&nbsp;<?php echo $res['que_text']; ?></p></div>
					  
					  <!----- Display answer -->
					  <div id="<?php echo $res['que_id'];?>"></div><br />
					  
                      <?php 
					  		echo "<div><button id = btn_answer$res[que_id] value = $res[que_id] onClick = getAnswer(this.value) style='width:60px; height:auto;'>Answer</button></div>";
						?>
					</div>
					<div class="modal-footer">
						<h6 id="date_time" style="float:left; margin:-1px 5px;"></h6><h6 style="margin:-2px 10px;"><?php echo $res['que_status']; ?></h6>
					</div>
				  </div>
				
				</div>
				
			<?php
			}
		}else{
			echo "<center><h3 style='color:red; border:solid; padding:10px; margin:200px -50px;;'>You have not submited any answer yet!</h3></center>";
		}
	}
?>