<?php
require_once 'core/init.php';
function studentYear($userId, $user, $query) {
    //get student year from database
	$year = $query->getStudentYear($userId);
	//user joined date
	$joined = $user->data()->joined;
	//get year difference between joined date and now
	$today = date('Y');
	$joinedFormat =  date('Y', strtotime($joined));
	$difference = abs($today-$joinedFormat);
	//if difference is 0 they are in first year, if difference is 1, they are in second year, if difference is 2 they are in third year 
	if($difference == 0){
		return array('1', 'First Year');
	}elseif ($difference == 1){
		return array('2', 'Second Year');
	}elseif ($difference == 2){
		return array('3', 'Third Year');
	}elseif ($difference == 3){
		return array('4', 'Fourth Year');
	}else{
		return false;	
	}
}