<?php
$notIndex = false;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php'; 


if(Session::exists('home')) {
    echo '<p>' . Session::flash('home'). '</p>';
}

if($user->isLoggedIn() && !isset($_GET['domain'])) {
	
	if ($user->hasPermission('mod')){
			
		require_once 'includes/views/logged_in/admin_in.php';
		
	}else if($user->hasPermission('admin')){
		
		require_once 'includes/views/logged_in/institute_in.php';
		
	}else {
		
		require_once 'includes/views/logged_in/student_in.php';
		
	}

}else{
	
	if (!isset($_GET['domain'])){
		
		require_once 'includes/views/logged_out/home_default.php';	
			
	}else{
		
		require_once 'includes/views/logged_out/institution_default.php';
				
	}

}

require_once 'views/all_pages/foot.php'; 