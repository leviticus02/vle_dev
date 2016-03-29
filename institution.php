<?php
require_once 'core/init.php';
$notIndex = true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php'; 

require_once 'includes/i_reg_fields.php'; 

?>
<section id="mainContainer">
Institution registration<br />Request a code<br />
institution type - uni/college/online

<form action="" method="post" id="institutionReg">
    <div class="field">
        <label for="i_name">Institution Name</label>
        <input type="text" name="i_name" value="<?php echo escape(Input::get('i_name')); ?>" id="i_name">
    </div>

    <div class="field">
        <label for="institution_code">Uniqie Institution Code</label>
        <input type="text" name="institution_code" id="institution_code" value="<?php echo escape(Input::get('institution_code')); ?>">
    </div>
    
    <div class="field">
        <label for="email">Email contact</label>
        <input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
    </div>
    
     <div class="field">
        <label for="username">Login ID</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="field">
        <label for="password_again">Password Again</label>
        <input type="password" name="password_again" id="password_again" value="">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Register">
</form>

</section>
<?php require_once 'views/all_pages/foot.php';  ?>