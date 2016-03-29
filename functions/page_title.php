<?php

require_once 'core/init.php';
function title($user) {
    if($user->isLoggedIn()){
		$userName = escape($user->data()->name);
		$title = $userName . ' - Lectio';	
	}else{
		$title = 'Lectio home';	
	}
	
	return $title;
	
}