<?php
//get institutuion code from domain post variable and insert it before username
if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validate->passed()) {
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);
			
            if($login) {
                Redirect::to('index.php');
            } else {
				echo '<div id="modalAlert">' . 
			  		'Incorrect username or password' .
					'</div>';
               
            }
        } else {
            foreach($validate->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}