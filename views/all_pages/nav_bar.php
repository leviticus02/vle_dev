<?php 
if(!$user->isLoggedIn() && !$notIndex) : 	
require_once 'includes/login_check.php';
?>
 <?php if(!isset($_GET['domain'])) : ?>
    <section id="loginOverlay">
        <section id="loginFormContainer">
                   <form action="" method="post" id="loginForm">
                    
                    <span class="navButtonGray">Log In</span>
                    
                        <div class="field">
                            <input type="text" name="username" id="username" placeholder="Log in ID">
                        </div>
                    
                        <div class="field">
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>
                    
                        <div class="field" class="floatElement">
                          <div id="checkLabel">
                            <label for="remember" >Remember me </label>
                          </div>
                          <div id="checkBox">  
                            <input type="checkbox" name="remember" id="remember" > 
                          </div>
                        </div>
    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <input type="submit" value="Log In" id="loginbutton">
                    </form>
        </section>
    </section>
	<?php endif ; ?>
 <?php endif ; ?>

<section id="topBar" class="navBar">
	<section id="navContainer" <?php if (isset($vlePage)){echo 'style="width:89%;"';} ?>>
    
        <section id="title" class="title">
           <a href="index.php"> <h1>lectio</h1></a>
        </section>
        
        <?php if($user->isLoggedIn()) : ?>
         <section id="searchBarNav">
               <!-- search -->
           </section>
         <?php endif ; ?>
        
        <section id="buttons">
        	  <section id="login">
               <?php if(!$user->isLoggedIn() && !isset($_GET['domain'])) : ?>
               	<button id="loginBtn">Log In</button>
               <?php elseif ($notIndex) : ?> 
               		
               <?php endif ; ?>
            </section>
            
            
        	<section id="register">
             <?php if(!$user->isLoggedIn()) : ?>
					<a href="institution.php"><div class="navButton"><p>Sign Up</p></div></a>
				<?php else : ?>
                <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><div class="navButtonGray"><p>Profile</p></div></a>
            		<a href="settings.php" ><div class="navButtonGray"><p>Settings</p></div></a>	
                    <a href="includes/logout.php"><div class="navButtonGray"><p>Log Out</p></div></a>
                 <?php endif ; ?>
            </section>
            
        </section>
        
    </section>    
</section>