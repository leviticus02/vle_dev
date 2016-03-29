<?php

require_once '../core/init.php';

$user = new User();
$user->logout();

Redirect::to('../index.php?domain=' . $user->data()->institution_code);
//Redirect::to('../index.php');