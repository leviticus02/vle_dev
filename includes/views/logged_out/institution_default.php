<?php 
	if (!$query->getInsitutionName($_GET['domain'])){
		Redirect::to('index.php');
	}
?>
<section id="homeBodyContainer">
    <section id="homeContent">
        <div id="midBox">
        	<div id="midLeft">
            	<?php echo $query->getInsitutionName($_GET['domain']); ?>
            </div>
            <div id="midRight">
            <section id="domainLoginFormContainer">
            	<?php if(!$user->isLoggedIn()) : ?>
           	 	
    	       <form action="" method="post" id="loginForm">
               	
                <span class="navButtonGray"><?php echo $query->getInsitutionName($_GET['domain']); ?> Log In</span>
                
                    <div class="field">
                        <input type="text" name="username" id="username" placeholder="Log in ID">
                    </div>
                
                    <div class="field">
                        <input style="margin-left:-0px;" type="password" name="password" id="password" placeholder="Password">
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
                <?php else : ?>
                	Logged in as <?php echo $user->data()->name; ?>
                <?php endif ;?>
    </section>
            </div>
        </div>
    </section>
</section>