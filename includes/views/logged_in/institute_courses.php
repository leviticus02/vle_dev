<?php 
if (isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = 'all';	
}
$code = $user->data()->institution_code;
$courses = $query->getInsitutionCourses($code);
$count = $query->courseCount($code);
$exists = false;
if (isset($_GET['course'])){
	foreach($courses as $row) {
		if ($row->course_id == $_GET['course']){
			$exists = true;		
		}
	}
}
?>

<div id="headTile">
	<?php include 'includes/modules/head_tile_contents.php'; ?>
</div>


		<section id="mainContainer">
            
    			<section id="sidePanel">
    	<section id="sideHead">
        	<div id="sideTitle">
                <p class="sideTitle"><?php echo escape($user->data()->name);?></p>
                <p class="sideTitle">Institute Administration</p>
            </div>
             <a href="index.php">Feed</a>
        </section>
        
    	<section id="sideLinks">
         	<a href="register.php">Member Registration</a>
            <a href="modules.php" class="active">Course Managment</a>
            <a href="members.php">Member Managment</a>
        </section>
    </section>
    
    <section id="mainFeed">
    	<section id="instituteMain">
    
    <?php if (!isset($_GET['course'])) : ?>
    <div id="modOptionsTabs">
   		 <a class="<?php if (!isset($_GET['action']) || $action != 'add'){echo 'active';} ?>" href="modules.php">All current courses</a>
       <a class="<?php if (isset($_GET['action']) && $action == 'add'){echo 'active';} ?>" href="modules.php?action=add">Add a course</a>
       <form id="live-search" action="" class="styled" method="post">
   		 <fieldset>
        	<input type="text" class="text-input" id="courseFilter" value="" placeholder="Filter courses..." />
        		<span id="filter-count"></span>
    		</fieldset>
		</form>
   </div>
    <?php endif; ?>
    
	<?php
	
	//action if - action for add		
	if (isset($_GET['action']) && $action == 'add') :
			
			require_once 'includes/course_reg_fields.php';
			
	?>
        
			 <div id="moduleCardCont">
            	<div id="moduleCard">
			<form action="" method="post" id="courseForm">
            <div class="field">
                <label for="c_name">Course Name</label>
                <input type="text" name="c_name" value="<?php echo escape(Input::get('c_name')); ?>" id="c_name">
            </div>
        
            <div class="field">
                <label for="course_id">Course Code</label>
                <input type="text" name="course_id" id="course_id" value="<?php echo escape(Input::get('course_id')); ?>">
            </div>
            <div class="field">
            	 <label for="courseType">Course Type</label> 
            	<select name="courseType">
                     <option selected="selected" disabled="disabled">Select</option>
                     <option value="BSc">Bachelor of Science</option>
                     <option value="Ba">Bachelor of arts</option>
                     <option value="BEng">Bachelor of engineering</option>
                     <option value="MEng">Undergraduate Masters Degree</option>
                     <option value="MSc">Master of Science</option>
                     <option value="MA">Master of Arts</option>
                     <option value="MEd">Master of Education</option>
                     <option value="LLM">Master of Law</option>
                     <option value="MBA">Master of Business Administration</option>
                     <option value="MRes">Master of Research</option>
                     <option value="PhD">PhD</option>
                 </select>
            </div>
                <div class="field">
               <label for="duration">Course Duration in Years</label> 
                <select name="duration">
                    <option selected="selected" disabled="disabled">Select</option>
                    <option value="1">1 Year</option>
                    <option value="2">2 Years</option>
                    <option value="3">3 Years</option>
                    <option value="4">4 Years</option>
              </select>
      		</div>
            
                <input type="hidden" name="i_code" id="i_code" value="<?php echo $code; ?>">
            	 <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    			<input type="submit" value="Add Course">
		</form>
        </div>
        </div>
				
	<?php	
	//action if - only course is set	
	elseif (isset($_GET['course'])) : 
		
	?>
        
			<?php
				
				//set moduleoption variable to all if not set
				if (isset($_GET['module'])){
						$moduleOption = $_GET['module'];
					}else{
						$moduleOption = 'all';
					}
					
			?>
                
                <?php	
				
				// exists if - module exists
				if ($exists) :
				
				?>
                
    
					<section id="coursePage">
                        <div id="courseModuleOptions">
                        	<div id="modOptionsTabs">
                            <a class="<?php if ($moduleOption == 'feed'){echo 'active';} ?>" href="modules.php?course=<?php echo $courseID; ?>&module=feed">Course Feed</a>
                            <a class="<?php if ($moduleOption == 'all'){echo 'active';} ?>" href="modules.php?course=<?php echo $courseID; ?>&module=all">Modules</a>
                            <a class="<?php if ($moduleOption == 'add'){echo 'active';} ?>" href="modules.php?course=<?php echo $courseID; ?>&module=add">Add a Module</a>
                            <a class="<?php if ($moduleOption == 'staff'){echo 'active';} ?>" href="modules.php?course=<?php echo $courseID; ?>&module=staff">Course Staff</a></div>
                            <div id="modulePage">
                            
                            <?php 
							
							if($moduleOption == 'add'):
								require_once 'includes/module_reg_fields.php';
							 
							 ?>
                              <div id="moduleCardCont">
            					<div id="moduleCard">
								<form action="" method="post" id="moduleForm">
                                    <div class="field">
                                        <label for="m_name">Module Name</label>
                                        <input type="text" name="m_name" value="<?php echo escape(Input::get('m_name')); ?>" id="m_name">
                                    </div>
                                
                                    <div class="field">
                                        <label for="module_code">Module Code</label>
                                        <input type="text" name="module_code" id="module_code" value="<?php echo escape(Input::get('module_code')); ?>">
                                    </div>
                                    
                                     <div class="field">
                                        <label for="m_description">Module Description</label>
                                        <input type="text" name="m_description" id="m_description" value="<?php echo escape(Input::get('m_description')); ?>">
                                    </div>
                                    
                                    Start date<br />
                                    End date<br />
                       
                                        <div class="field">
                                       <label for="year">for which year?</label> 
                                        <select name="year">
                                            <option selected="selected" disabled="disabled">Select</option>
                                            <option value="1">1st Year</option>
                                            <option value="2">2nd Year</option>
                                            <option value="3">3rd Year</option>
                                            <option value="4">4th Year</option>
                                             <option value="5">All</option>
                                      </select>
                                    </div>
                                    	<input type="hidden" name="parent" id="parent" value="<?php echo $courseID; ?>">
                                        <input type="hidden" name="i_code" id="i_code" value="<?php echo $code; ?>">
                                         <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <input type="submit" value="Add Course">
                                </form>
                                </div>
                                </div>
							<?php 
							
							elseif ($moduleOption == 'feed') :
							$feed = $query->getMainFeed($user->data()->institution_code, $courseID);
			  				 require_once 'functions/time_elapsed.php';
							 require_once 'includes/feed_fields.php';
							
							?>
                            
                            <form  id="mainFeedForm" method="post" enctype="multipart/form-data">
                	<textarea name="feedPost" id="feedPost" placeholder="Update everyone..."></textarea>
                    <input type="hidden" name="courseID" value="<?php echo $courseID; ?>" />
                    <div id="feedFormButtons">
                    	<div>
                    		<input type="submit" id="feedUploadAlias" value="Attach file"  />
                        </div>
                        <div>
                    		<input type="submit" id="mainFeedSubmit" value="Submit"  />
                        </div>
                    </div>
                      <input type="file" name="feedUP" id="feedUp">
                </form>
            	
               <?php 
			   
			   if ($feed){
				   foreach ($feed as $feedGet){
					   $replies = $query->getFeedReplies($feedGet->id);
					   
				?>
                	   <div id="id<?php echo $feedGet->id; ?>">
                           <div id="moduleCardCont">
                            <div id="moduleCard">
                                <?php if($feedGet->poster_id == $user->data()->id): ?>
                                <div id="Delete">
                                    <button id="edit">Edit</button>
                                    <button id="x" onclick="del(<?php echo $feedGet->id; ?>, 3, 0, 0)">X</button>
                                </div>
                                <?php endif; ?>
                                <div id="postInfo">
                                    <a href="profile.php?user=<?php  ?>"> 
                                    <?php echo $query->studentName($feedGet->poster_id, $user->data()->institution_code) ?>
                                    </a> 
                                    <span id="subText"><?php echo time_elapsed_string($feedGet->date, $full = false) ?></span>				
                                </div>
                                <div id="postBody">
                                    <?php echo $feedGet->post_body ?> 
                                </div>
                                
                               
                                
                                <div id="mainFeedReplies">
                                	 <?php 
									 if ($replies){	
									 	foreach ($replies as $reply){ 
									 
									 ?>
                                     <div id="id<?php echo $reply->id; ?>">
                                     	<div id="replyCont">
                                        <?php if($reply->poster_id == $user->data()->id): ?>
                                            <div id="Delete">
                                                <button id="edit">Edit</button>
                                                <button id="x" onclick="del(<?php echo $reply->id; ?>, 4, 0, 0)">X</button>
                                            </div>
                                        <?php endif; ?>
                                        	<div id="replyHead">
                                            	<span class="">
                                                	<a href="profile.php?user=<?php  ?>"> 
														<?php echo $query->studentName($reply->poster_id, $user->data()->institution_code) ?>
                                                    </a>
                                                </span>
                                                <span id="subText">
													<?php echo time_elapsed_string($reply->date, $full = false) ?>
                                                </span>
                                            </div>
                                            <div id="replyBody">
                                            
                                            	<?php if ($reply->reply_to_id != 0) : ?>
                                                	<a href="#">
                                                		@<?php echo $query->studentName($reply->reply_to_id, $user->data()->institution_code) ?>
                                                    </a>
                                                <?php endif ; ?>
                                                
                                            	<?php echo $reply->reply_body ?> 
                                                
                                                <div class="replyOptions">
                                                 <button style="border:none;background-color:white;cursor:pointer;" id="subText" onclick="rep(<?php echo $reply->poster_id ?>, <?php echo $feedGet->id ?>)">
                                                    	Reply
                                                  </button>
                                                </div>   
                                            </div>
                                        </div>
                                       </div>
                                     <?php
									 
									  	} 
									 }
									  
									  ?>
                                </div>
                                
                                <div id="replyForm">
                                <form  id="mainFeedReplyForm" method="post" enctype="multipart/form-data">
                                    <textarea name="replyPost" class="replyPost" id="replyPost<?php echo $feedGet->id ?>" placeholder="Reply..."></textarea>
                                    <input type="hidden" name="parent" value="<?php echo $feedGet->id ?>" />
                                    <input type="hidden" name="replyTo" id="replyTo<?php echo $feedGet->id ?>" value="" />
                                    <div id="replyButtonCont">
                                    	<input type="submit" id="mainFeedReplySubmit" value="Submit"  />
                                    </div>
                                </form>
                                </div>
                                
                           </div>
                        </div>
                    </div>
                        
              <?php          
				   }
			   }
			  ?>
                            
                            <?php
							
							elseif ($moduleOption == 'all') :
								$allExists =false;
								$firstExists = false;
								$secondExists = false;
								$thirdExists = false;
								$fourthExists = false;
								if (!$courseModules){echo 'nothing here';}else{
									
									foreach ($courseModules as $row){
										if ($row->module_year == '1'){
											$firstExists = true;
										}
										if ($row->module_year == '2'){
											$secondExists = true;
										}
										if ($row->module_year == '3'){
											$thirdExists = true;
										}
										if ($row->module_year == '4'){
											$fourthExists = true;
										}
										if ($row->module_year == '5'){
											$allExists = true;
										}
									}
									
									if ($firstExists){
										echo '<p class="moduleYear">First year</p>';
										foreach ($courseModules as $row){
											if ($row->module_year == '1'){
												include 'includes/modules/module_card.php';
											}
										}
									}
									
									if ($secondExists){
										echo '<p class="moduleYear">Second year</p>';
										foreach ($courseModules as $row){
											if ($row->module_year == '2'){
												include 'includes/modules/module_card.php';
											}
										}
									}
									if ($thirdExists){
										echo '<p class="moduleYear">Third year</p>';
										foreach ($courseModules as $row){
											if ($row->module_year == '3'){
												include 'includes/modules/module_card.php';
											}
										}
									}
									if ($fourthExists){
										echo '<p class="moduleYear">Fourth year</p>';
										foreach ($courseModules as $row){
											if ($row->module_year == '4'){
												include 'includes/modules/module_card.php';
											}
										}
									}
									if ($allExists){
										echo '<p class="moduleYear">All years</p>';
										foreach ($courseModules as $row){
											if ($row->module_year == '5'){
												include 'includes/modules/module_card.php';
											}
										}
									}
									
								}
								
							elseif ($moduleOption == 'staff') :
							
								require_once 'includes/staff_reg_fields.php';
								//list staff for course
								echo '<div id="staffList">';
								$courseStaffList = $query->courseStaffList($code, $courseID);
								if (!$courseStaffList){ echo 'None assigned'; }else{
										foreach ($courseStaffList as $row){
											$staffName = $query->courseStaffName($row->staff_id, $code);
											if($row->role == 'leader'){
												$role = 'Course Leader';
											}else{
												$role = 'Course Admin';	
											}
											echo '<div id="id' . $row->id .'">';
											echo '<div id="moduleCard" class="staff">';
											echo '<p class="modName">' . $staffName . '</p>';
											echo '<p class="modCode">' . $role . ' | ';
											echo '<a href="javascript:void(0)" id="removeStaff' . $row->id . '" onclick="del(' . $row->id . ', 1, 0, 0)">Remove</a></p>';
											echo '</div>';
											echo '</div>';
										}
									}
								echo '</div>';
							//get list of staff for the institution
							$staffList = $query->StaffList($code, $courseID);
							
							?>
                            
                            	
							<div id="staffForm">
                             <p class="formHeader">Add staff</p>
                            <form action="" method="post">
                            
                          
                                <div class="field">
                                   <label for="staffName">Staff name</label> 
                                    <div class="field">
                                     <input id="srch" type="text" name="search" placeholder="Staff name..." autocomplete="off" />
                                    </div>	
                                   <select name="staffName" id="staffName">
                                   <option selected="selected" disabled="disabled">Select</option>
                                       <?php 
                                       
                                         foreach($staffList as $row) {
                                             echo '<option value="'. $row->user_id . '">';
                                             echo $query->courseStaffName($row->user_id, $code) . "</option>";
                                         }
                                         
                                       ?>
                                  </select>
                              </div>
                              
                              <div class="field">
                                       <label for="role">Staff Role</label> 
                                        <select name="role">
                                            <option selected="selected" disabled="disabled">Select</option>
                                            <option value="leader">Course Leader</option>
                                            <option value="admin">Course Admin</option>
                                      </select>
                               </div>
                              <input type="hidden" name="parent" id="parent" value="<?php echo $courseID; ?>">
                              <input type="hidden" name="i_code" id="i_code" value="<?php echo $code; ?>">
                              <input type="hidden" name="type" id="type" value="course">
                              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <input type="submit" value="Add Staff">
                                  
                            </form>
								
						</div>
                        		
						<?php 
						
						endif ;
						
						?>
                        
                        </div>
                    </section>
	 		<?php
				
			  // course exists else - course doesnt exist
			  else :
			  
			 ?>
				 
				No course Selected
                     
            <?php         
				
			   //end exists if	
			   endif ;
			   
			 ?>
				</div> 
				  
		
              
		<?php
		
		 else :
		 
		 ?>
			
          <?php
			
			 echo '<div id="courseGrid">';
				if ($courses){
					echo '<ul class="courselist">';
						foreach ($courses as $row){
							$enrollmentCount = $query->enrollmentCount($code, $row->course_id);
							echo '<li><a href="?course=' . $row->course_id . '"><div id="courseCard">';
							echo '<div id="courseCardTitle">' . $row->course . ' ' . $row->type . '</div><br>';
							echo '<span>Students Enrolled: ' . $enrollmentCount . '</span>';
							echo '</div></a></li>';
						}
						
				}
					echo '</ul';
					echo '</div>';	
					
					?>
            
        <?php
		
		endif ; 
		
		
		?>
        
        </div>

     </section>
    
    
    
    
</section>
