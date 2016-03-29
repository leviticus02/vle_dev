<?php 
	
//Action if statement - action for all
if (isset($_GET['action']) && $action == 'all') : 
	
	
	
?>	

	
	
<?php	

elseif (isset($_GET['action']) && $action == 'add') :  


?>

 <section id="feedHeader" >
 <div id="headTileCont">
 	<div id="headContents">
       <div class="feedCourseInfo" >
          <?php echo escape($user->data()->name);?> > Course managment > Add a course
      </div>
      <div class="feedCourse" >
		Add course form
     </div>	
     </div>
</div>
	
	
<?php
	

elseif (isset($_GET['course'])) : 

	if ($exists) : 
	require_once 'functions/course_leader.php';	
	$courseInfo = $query->courseInfo($code, $_GET['course']);
	$enrollmentCount = $query->enrollmentCount($code, $_GET['course']);
	$courseModules = $query->getCourseModules($code, $_GET['course']);
	foreach ($courseInfo as $course){
		$courseTitle = $course->course;
		$courseType = $course->type;
		$courseDuration = $course->length;
		$courseID = $course->course_id;
	}
	$leaderInfo = getCourseLeader($code, $courseID, $user, $query);

?>    

 				<section id="feedHeader" >
                <div id="headTileCont">
                	<div id="headContents">
                       <div class="feedCourseInfo" >
                           Code: <?= $courseID;?> | 
                           Leader: <?php if(!$leaderInfo){echo 'None assigned';}else{ ?><a href="profile.php?user=<?= $leaderInfo[1]; ?>"><?= $leaderInfo[0]; } ?></a> |  
                           Duration: <?= $courseDuration; ?> Years |
                           Students Enrolled: <?= $enrollmentCount; ?> (edit)
                       </div>
                       <div class="feedCourse" >
                            <?= $courseTitle . ' ' . $courseType;?>
                       </div>	
                   </div>
                   </div>		
       			</section>
    
<?php

	endif ;	
	
?>

<?php

else :

?>

			<section id="feedHeader" >
    <div id="headTileCont">
    	<div id="headContents">
           <div class="feedCourseInfo" >
                 <?php echo escape($user->data()->name);?> > Course managment > All Courses
            </div>
            <div class="feedCourse" >
                Course List 
             </div>	
         </div>	
         </div>	
    </section>

<?php	

endif ;  

?>