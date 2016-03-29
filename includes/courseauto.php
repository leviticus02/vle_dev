<?php
require '../core/init.php';
$user = new User(); //Current
$query = new Query();
$code = $user->data()->institution_code;

	

$courses = $query->getInsitutionCourses($code);
foreach($courses as $course){
	echo json_encode($course->course);
}
//var_dump($courses);
//echo json_encode($courseName);