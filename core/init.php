<?php
/**
 * Created by Chris on 9/29/2014 3:58 PM.
 */

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '192.168.10.170',
        'username' => 'vle',
        'password' => 'secret',
        'db' => 'db'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'sessions' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(function($class) {
    require_once __DIR__ . '/../classes/class.' . $class . '.php';
});

require __DIR__ . '/../functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('sessions/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}