<?php 
$notIndex = true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php';
$institutionCode = $user->data()->institution_code;
$userID = $user->data()->id;
require_once 'includes/feed_fields.php';
?>
<div id="headTile">
	<div id="headTileCont">
        <div id="headContents">
            <section id="feedHeader">
                    <p class="feedCourseInfo">
						<a href="includes/profile.php?user=<?php echo $institutionCode; ?>"><?php echo $query->getInsitutionName($institutionCode); ?></a> | 
                        <a href="includes/profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->first_name) . " " . escape($user->data()->last_name);?></a> | 
                        Student
                    </p>
                    <p class="feedCourse"><?php echo $query->getStudentCourses($userID, $institutionCode); ?> Faculty</p>
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
            <a href="modules.php">Your Modules</a>
            <a href="#">Your Documents</a>
            <a href="faculty.php" class="active">Faculty</a>
        </section>
    </section>
    

 	<section id="mainFeed">
    		<section id="instituteMain">
            
            <?php
			$courseTitle = $query->getStudentCourses($userID, $institutionCode);
			$code = $query->getCourseId($institutionCode, $courseTitle);
            $staffList = $query->facultyList($code);
			  
                      echo '<ul class="memberList">';	                  
                      foreach($staffList as $row) {
						echo '<li><div id="moduleCardCont">';  
						echo '<div id="moduleCard">';
                      	echo '<p class="modName">' . $query->courseStaffName($row->staff_id, $institutionCode) . '</p>';
						echo '<p class="modCode">Role: Course ' . $row->role . '</p>';
						echo '</div>';
						echo '</div></li>';
                      }
					  echo '</ul>';
                                         
                 ?>
              
          
    </section>
    
</section>

<?php
require_once 'views/all_pages/foot.php'; 
?>