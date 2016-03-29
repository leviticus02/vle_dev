<?php
$notIndex = true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php';

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

	if ($user->hasPermission('mod')){
			
		require_once 'includes/views/logged_in/mod_courses.php';
		
	}else if($user->hasPermission('admin')){
		
		require_once 'includes/views/logged_in/institute_courses.php';
		
	}else {
		
		require_once 'includes/views/logged_in/student_courses.php';
		
	}

require_once 'views/all_pages/foot.php'; 