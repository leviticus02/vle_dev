<?php
require '../core/init.php';
$user = new User(); //Current
$query = new Query();
$userId = $_GET['id'];
$parentPost = $_GET['parent'];
$institution = $user->data()->institution_code;

$name = $query->studentName($userId, $institution);


echo json_encode($name);





