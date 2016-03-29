<?php
require_once '../core/init.php';
$query = new Query();
$id = $_GET['id'];
$table = $_GET['type'];
$extra1 = $_GET['extra1'];
$extra2 = $_GET['extra2'];

//type 1 == course staff

if($table == 1){
	$query->deleteCourseStaff($id);
	echo 'done';
}

//type 2 == coursestaff and members (staff table id = id, member table id = extra1, staff table = extra2(1), student table = extra2(2))

if($table == 2){
	if ($extra2 == 1){
		$query->deleteStaff($id);
		$query->deleteMember($extra1);
		echo 'done';
	}
	if ($extra2 == 2){
		$query->deleteStudent($id);
		$query->deleteMember($extra1);
		echo 'done';
	}
}

//type 3 == main feed

if ($table == 3){
	$query->deleteMainFeedPost($id);
}

//type 4 = feed_rplies

if ($table == 4){
	$query->deleteFeedReply($id);
}

?>


