<?php
/**
 * include = script will execute regardless of error
 * require = script will stop if errror
 */
$notIndex=true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php';

$user = new User();
$query = new Query();

if(!$user->isLoggedIn() || !$user->hasPermission('admin')) {
    Redirect::to('index.php');
}

$code = $user->data()->institution_code;
$courses = $query->getInsitutionCourses($code);
 
?>

	<div id="headTile">
        <div id="headTileCont">
            <div id="headContents">
                <section id="feedHeader">
                        <p class="feedCourseInfo">
                          <a href="profile.php?user=<?php echo $institutionCode; ?>"><?php echo $query->getInsitutionName($code); ?> > Member Registration</a>
                        </p>
                        <p class="feedCourse">
                        	<?php if (isset($_GET['role']) && $_GET['role'] == 'staff') : ?>
                            	Staff Registration
                        	<?php elseif (isset($_GET['role']) && $_GET['role'] == 'student') : ?>
                            	Student Registration
                        	<?php else : ?>
                            	Registration Overview
                            <?php endif ; ?>
                        </p>
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
         	<a href="register.php" class="active">Member Registration</a>
            <a href="modules.php">Course Managment</a>
            <a href="members.php">Member Managment</a>
        </section>
    </section>
    <section id="mainFeed">
    
    	<section id="instituteMain">
        
          <div id="courseModuleOptions">
                        	<div id="modOptionsTabs">
                            
                            <a class="<?php if (isset($_GET['role']) && $_GET['role'] == 'staff'){echo 'active';} ?>" href="?role=staff">Register Staff</a>
                            <a class="<?php if (isset($_GET['role']) && $_GET['role'] == 'student'){echo 'active';} ?>" href="?role=student">Register Student</a></div>
        
        
    	<?php 
		require_once 'includes/reg_fields.php';
		
		if (isset($_GET['role']) && $_GET['role'] == 'staff') : ?>
        
         <div id="moduleCardCont">
            <div id="moduleCard">
    
            <form action="" method="post" id="regForm">
                    
                    <div id="formDetails">
                        <p class="formHeader">Memeber details</p>

                        <div class="field">
                            <label for="first_name">first Name</label>
                            <input type="text" name="first_name" value="<?php echo escape(Input::get('first_name')); ?>" id="first_name">
                        </div>
                        <div class="field">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="<?php echo escape(Input::get('last_name')); ?>" id="last_name">
                        </div>
                        <div class="field">
                            <label for="username">User ID, this will act as their login ID</label>
                            <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
                        </div>
                    </div>
                    
                  
                  
                <div id="formPassword">
                    <p class="formHeader">Member Password</p>
                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                    
                        <div class="field">
                            <label for="password_again">Password Again</label>
                            <input type="password" name="password_again" id="password_again" value="">
                        </div>
                </div>
                
                 <input type="hidden" name="i_code" id="i_code" value="<?php echo $code; ?>">
            		 <input type="hidden" name="role" id="i_code" value="2">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" value="Register">
            </form>
           </div>
           </div>
           
           
           <?php elseif (isset($_GET['role']) && $_GET['role'] == 'student') : ?>
           
            <div id="moduleCardCont">
            <div id="moduleCard">
           	  <form action="" method="post" id="regForm" autocomplete="off" >
                    
                    <div id="formDetails">
                        <p class="formHeader">Memeber details</p>

                        <div class="field">
                            <label for="first_name">first Name</label>
                            <input type="text" name="first_name" value="<?php echo escape(Input::get('first_name')); ?>" id="first_name">
                        </div>
                        <div class="field">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="<?php echo escape(Input::get('last_name')); ?>" id="last_name">
                        </div>
                        <div class="field">
                            <label for="username">User ID, this will act as their login ID</label>
                            <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
                        </div>
                    </div>
                    
                  
                   <div id="formCourses">
                    <p class="formHeader">Member course information</p>
                    
                    
                        <div class="field">
                             <label for="yearSelect">Starting at which year?</label> 
                            <select name="yearSelect">
                                 <option value="--">Select</option>
                                 <option value="1">First Year</option>
                                 <option value="2">Second Year</option>
                                 <option value="3">Third Year</option>
                             </select>
                        </div>
                        
                        
                        <div class="field">
                       <label for="course">Course</label> 
                        <div class="field">
                            <input id="srchCourse" type="text" name="search" placeholder="Course name..." autocomplete="off" />
                         </div>	
                        <select name="course" id="courseSelect">
                        <option value="--">Select</option>
                           <?php 
                           
                             foreach($courses as $row) {
                                 echo '<option value="'. $row->course_id . '">';
                                 echo $row->course . ' ' . $row->type . "</option>";
                             }
                             
                           ?>
                      </select>
                      
                      
                      </div>
                  </div>
                 
     
                <div id="formPassword">
                    <p class="formHeader">Member Password</p>
                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                    
                        <div class="field">
                            <label for="password_again">Password Again</label>
                            <input type="password" name="password_again" id="password_again" value="">
                        </div>
                </div>
                
                 <input type="hidden" name="i_code" id="i_code" value="<?php echo $code; ?>">
            		 <input type="hidden" name="role" id="i_code" value="1">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" value="Register">
            </form>
            </div>
            </div>
           
           <?php else : ?>
            <div id="moduleCardCont">
            <div id="moduleCard">
           
             You can manage your members <a href="members.php">here</a>
             
             </div>
             </div>
           
           <?php endif ; ?>
           
        </section>   
    </section>
</section>
<?php require_once 'views/all_pages/foot.php';  ?>