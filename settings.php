<?php
$notIndex=true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php';
?> 
<div id="headTile">
<div id="headTileCont">
 <div id="headContents">
	   	<section id="feedHeader">
        	<p class="feedCourseInfo"> <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->name);?></a> > Settings</p>
            <p class="feedCourse">Account Settings</p>
        </section>
      </div>
      </div>
</div>

<section id="mainContainer">


		<?php if ($user->hasPermission('mod')) : ?>
			
            <section id="sidePanel">
    	<section id="sideHead">
        	<div id="sideTitle">
                <p class="sideTitle"><?php echo escape($user->data()->name);?></p>
                <p class="sideTitle">Staff</p>
            </div>
             <a href="index.php">Feed</a>
        </section>
        
    	<section id="sideLinks">
            <a href="modules.php" class="active">Course Administration</a>
        </section>
    </section>

		
	<?php elseif($user->hasPermission('admin')) : ?>
		
		<section id="sidePanel">
    	<section id="sideHead">
        	<div id="sideTitle">
                <p class="sideTitle"><?php echo escape($user->data()->name);?></p>
                <p class="sideTitle">Institute Administration</p>
            </div>
            <a href="index.php" >Feed</a>
        </section>
        
    	<section id="sideLinks">
         	<a href="register.php" >Member Registration</a>
            <a href="modules.php">Course Managment</a>
            <a href="members.php">Member Managment</a>
        </section>
    </section>
    
    <?php $admin = true; ?>
		
	<?php else :?>
		
		<section id="sidePanel">
    	<section id="sideHead">
        <div id="sideTitle">
                <p class="sideTitle"><?php echo escape($user->data()->name);?></p>
                <p class="sideTitle">Student</p>
            </div>
            <a href="index.php">Feed</a>
        </section>
        
    	<section id="sideLinks">
            <a href="modules.php">Your Modules</a>
            <a href="#">Your Documents</a>
            <a href="faculty.php">Faculty</a>
        </section>
    </section>
		
	<?php endif ; ?>

	<div id="mainFeed">
        <div id="instituteMain">
             
            <div id="moduleCardCont">
                <div id="moduleCard">
                    <div id="optionDiv2">
                    	Change Password
                    </div>
                    
                    <div id="optionForm2">
                    	Change Password
                    	<?php
							require_once 'includes/changepassword.php';
						?>
                    </div>
                    
                </div>
            </div>
            
            <?php if(isset($admin)) : ?>
             <div id="moduleCardCont">
                <div id="moduleCard">
            		Edit your domain home page
                </div>
             </div>
            <?php endif ; ?>
            
        </div>
    </div>
    
    
</section>
<?php
require_once 'views/all_pages/foot.php'; 
?>