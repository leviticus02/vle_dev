<?php
require '../core/init.php';
$user = new User(); //Current
$query = new Query();
$modCode = $_GET['module'];
$code = $user->data()->institution_code;
$moduleInfo = $query->moduleInfo($code, $modCode);
foreach ($moduleInfo as $moduleRow){
		if ($modCode == $moduleRow->module_code){
			$parentMod = $moduleRow->id;
		}
	}
	
$feed = $query->getModuleFeed($code, $parentMod);

echo $feed;





