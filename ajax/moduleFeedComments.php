<?php
require '../core/init.php';
$user = new User(); //Current
$query = new Query();
$code = $user->data()->institution_code;

	
$feed = $query->getModuleFeedComments($code, $_GET['parent']);


echo $feed;





