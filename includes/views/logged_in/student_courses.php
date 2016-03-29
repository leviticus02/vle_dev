<?php
require_once 'functions/student_year.php';
require_once 'functions/course_leader.php';
$institutionCode = $user->data()->institution_code;
$userID = $user->data()->id;
$courseTitle = $query->getStudentCourses($userID, $institutionCode);
$courseId = $query->getCourseId($institutionCode, $courseTitle);
$courseModules = $query->getCourseModules($institutionCode, $courseId);
$courseInfo = $query->courseInfo($institutionCode, $courseId);
foreach ($courseInfo as $course){
	$courseTitle = $course->course;
	$courseType = $course->type;
	$courseDuration = $course->length;
	$courseID = $course->course_id;
}
if (studentYear($userID, $user, $query)){
	$studentYear = studentYear($userID, $user, $query);
}
$leaderInfo = getCourseLeader($institutionCode, $courseId, $user, $query);
?>
<div id="headTile">
<div id="headTileCont">
 <div id="headContents">
	 <section id="feedHeader" >
                       <div class="feedCourseInfo" >
                           Code: <?= $courseID;?> | 
                           Leader: 
                           <?php 
                           
                           if(!$leaderInfo){
                               
                               echo 'None assigned';
                               
                            }else{ 
                            
                            ?>
                            
                            <a href="profile.php?user=<?= $leaderInfo[1]; ?>"><?= $leaderInfo[0];
                            
                            }
                
                            ?>
                             
                            </a> |  
                           Duration: <?= $courseDuration; ?> Years
                       </div>
                       <div class="feedCourse" >
                           <?= $courseTitle . ' ' . $courseType;?>
                       </div>			
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
            <a href="index.php" >Feed</a>
        </section>
        
    	<section id="sideLinks">
            <a href="modules.php" class="active">Your Modules</a>
            <a href="#">Your Documents</a>
            <a href="faculty.php">Faculty</a>
        </section>
    </section>

	  <section id="mainFeed">
    	<section id="instituteMain">
                      
                    <div id="studentModules">
                            <?php 
                            
                            //display modules for student year
                            
                            echo ' <p class="moduleTitleYear">' . $studentYear[1] . ' Modules: </p>';
                            if ($courseModules){
                                foreach ($courseModules as $row){
                                    if ($row->module_year == $studentYear[0]){
                                        include 'includes/modules/module_card.php';
                                    }
                                    if ($row->module_year == '5'){
                                        include 'includes/modules/module_card.php';
                                    }
                                }
                            }else{
                                echo 'No modules yet';	
                            }
                            
                            ?>
                        </div>
                 </section>
         	</section>
         </section>
</section>