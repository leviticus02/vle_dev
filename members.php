<?php
$notIndex=true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php';

if(!$user->isLoggedIn() || !$user->hasPermission('admin')) {
    Redirect::to('index.php');
}

if (isset($_GET['list'])){
	$listOption = 	$_GET['list'];
}else{
	$listOption = '';	
}

$code = $user->data()->institution_code;

?> 
<div id="headTile">
<div id="headTileCont">
 <div id="headContents">
	   	<section id="feedHeader">
        	<p class="feedCourseInfo"> <a href="includes/profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->name);?></a> > Member Management</p>
            <p class="feedCourse">Manage Members</p>
        </section>
      </div>
      </div>
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
         	<a href="register.php" >Member Registration</a>
            <a href="modules.php">Course Managment</a>
            <a href="members.php" class="active">Member Managment</a>
        </section>
    </section>
    
    
  <div id="mainFeed">
        <div id="instituteMain">  
    		<div id="modOptionsTabs">
   			   <a class="<?php if ($listOption == 'staff'){echo 'active';} ?>" href="members.php?list=staff">Staff List</a>
               <a class="<?php if ($listOption == 'student'){echo 'active';} ?>" href="members.php?list=student">Student List</a>
               <?php if (isset($_GET['list'])) : ?>
                   <form id="live-search" action="" class="styled" method="post">
                     <fieldset>
                        <input type="text" class="text-input" id="memberFilter" value="" placeholder="Filter..." />
                    </fieldset>
                  </form>
               <?php endif ; ?>
             </div>
             
             <div id="memberList">
              <span id="filter-count"></span>
             <?php
			  // list option condition
			  if($listOption == 'staff') : 
			  
			  	$staffList = $query->StaffList($code);
			  
			  ?>
              
              	 <?php 
                      echo '<ul class="memberList">';	                  
                      foreach($staffList as $row) {
						echo '<div id="id' . $row->id . '">';   
						echo '<li><div id="moduleCardCont">';  
						echo '<div id="moduleCard">';
                      	echo '<p class="modName">' . $query->courseStaffName($row->user_id, $code) . '</p>';
						echo '<p class="modCode">
						<a href="#">Edit</a> 
						<a class="confirm" href="javascript:void(0)" id="removeStaff' . $row->id . '" onclick="del(' . $row->id . ', 2, ' . $row->user_id . ' , 1)">
						Remove
						</a></p>';
						echo '</div>';
						echo '</div>';
						echo '</div></li>';
                      }
					  echo '</ul>';
                                         
                 ?>
              
              
              
             <?php 
			 
			 elseif ($listOption == 'student') :
			 
			 	$studentList = $query->StudentList($code);
			 
			 ?>
             
				<?php 
                      echo '<ul class="memberList">';	                  
                      foreach($studentList as $row) {
						echo '<div id="id' . $row->id . '">';  
						echo '<li><div id="moduleCardCont">';  
						echo '<div id="moduleCard">';
                      	echo '<p class="modName">' . $query->studentName($row->user_id, $code) . '</p>';
						echo '<p class="modCode">
						' . $query->getStudentCourses($row->user_id, $code) . ' | 
						<a href="#">Edit</a> 
						<a href="javascript:void(0)" id="removeStaff' . $row->id . '" onclick="del(' . $row->id . ', 2, ' . $row->user_id . ' , 2)">
						Remove
						</a></p>';
						echo '</div>';
						echo '</div>';
						echo '</div></li>';
                      }
					  echo '</ul>';
                                         
                 ?> 
              
             <?php 
			 
			 else : 
			 
			 ?>
             
             <div id="moduleCardCont">
             	<div id="moduleCard">
                	You can add members <a href="register.php">here</a>
                </div>
            </div>
             
             
             <?php
			 // end list option condition
			  endif ;
			  
			  ?>
              </div>
             
    
    	</div>
  </div>

</section>

<?php
require_once 'views/all_pages/foot.php'; 
?>