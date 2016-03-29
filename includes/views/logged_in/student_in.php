<?php 
$institutionCode = $user->data()->institution_code;
$userID = $user->data()->id;
require_once 'includes/feed_fields.php';
?>
<div id="headTile">
	<div id="headTileCont">
        <div id="headContents">
            <section id="feedHeader">
                    <p class="feedCourseInfo">
						<a href="profile.php?user=<?php echo $institutionCode; ?>"><?php echo $query->getInsitutionName($institutionCode); ?></a> | 
                        <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->first_name) . " " . escape($user->data()->last_name);?></a> | 
                        Student
                    </p>
                    <p class="feedCourse"><?php echo $query->getStudentCourses($userID, $institutionCode); ?></p>
             </section>
         </div>
     </div>
</div>

<section id="mainContainer">

	<section id="sidePanel">
    	<section id="sideHead">
        <div id="sideTitle">
                <p class="sideTitle"><?php echo escape($user->data()->name);?></p>
                <p class="sideTitle">Student</p>
            </div>
            <a href="index.php" class="active">Feed</a>
        </section>
        
    	<section id="sideLinks">
            <a href="modules.php">Your Modules</a>
            <a href="#">Your Documents</a>
            <a href="faculty.php">Faculty</a>
        </section>
    </section>
    

 	<section id="mainFeed">
    		<section id="instituteMain">
            
           <div id="modOptionsTabs">
               <a class="<?php if (!isset($_GET['feed']) || $_GET['feed'] != 'course'){echo 'active';} ?>" href="?role=staff">
               	<?php echo $query->getInsitutionName($institutionCode); ?> Feed
               </a>
               
               <a class="<?php if (isset($_GET['feed']) && $_GET['feed'] == 'course'){echo 'active';} ?>" href="?feed=course">
               	<?php echo $query->getStudentCourses($userID, $institutionCode); ?> Feed
               </a>
            </div>
            
            
        <?php 
			if (isset($_GET['feed']) && $_GET['feed'] == 'course') {
				$course = $query->getStudentCourseId($userID, $institutionCode);
				
		?>
				<form  id="mainFeedForm" method="post" enctype="multipart/form-data">
                	<textarea name="feedPost" id="feedPost" placeholder="Update everyone..."></textarea>
                    <input type="hidden" name="courseID" value="<?php echo $course; ?>" />
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
                
			}else{
				$course = '';	
			}
			$feed = $query->getMainFeed($user->data()->institution_code, $course);
			   require_once 'functions/time_elapsed.php';
			   require_once 'functions/links.php';
			   if ($feed){
				   foreach ($feed as $feedGet){
					    $replies = $query->getFeedReplies($feedGet->id);
						
					   
				?>
                	<div id="id<?php echo $feedGet->id; ?>">
					   <div id="moduleCardCont">
					   	<div id="moduleCard">
                        <?php if($feedGet->poster_id == $user->data()->id): ?>
                                <div id="Delete">
                                    <button id="x" onclick="del(<?php echo $feedGet->id; ?>, 3, 0, 0)">X</button>
                                </div>
                        <?php endif; ?>
					   		<div id="postInfo">
					  			<a href="profile.php?user=<?php echo $feedGet->poster_id ?>"> 
					   			<?php echo $query->studentName($feedGet->poster_id, $user->data()->institution_code) ?>
					   			</a> 
					   			<span id="subText"><?php echo time_elapsed_string($feedGet->date, $full = false) ?></span>				
					   		</div>
					   		<div id="postBody">
					   			<?php echo links($feedGet->post_body) ?> 
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
                                                
                                            	<?php echo links($reply->reply_body) ?> 
                                                
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
                                <form  id="mainFeedReplyForm" method="post">
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
          
            
        </section>
    </section>
    
</section>