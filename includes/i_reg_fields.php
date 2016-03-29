<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'i_name' => array(
                'name' => 'Institution Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
			'username' => array(
                'name' => 'Institution Identifier',
                'required' => true,
                'min' => 2,
                'max' => 50,
				'unique' => 'users'
            ),
            'institution_code' => array(
                'code' => 'Institution Code',
                'required' => true,
                'min' => 2,
                'max' => 20,
				'unique' => 'users'
               
            ),
			'email' => array(
                'email' => 'Institution Contact',
                'required' => true,
                'min' => 2,
                'max' => 50,
				'email' => true
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
        ));


        if ($validate->passed()) {
            $user = new User();
			$query = new Query();
            $salt = Hash::salt(32);

            try {
                $query->createInstitution(array(
                    'name' => Input::get('i_name'),
                    'code' => Input::get('institution_code')
                ));
				
				 $query->create(array(
                    'name' => Input::get('i_name'),
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'joined' => date('Y-m-d H:i:s'),
					'email' => Input::get('email'),
					'institution_code' => Input::get('institution_code'),
                    'group' => 3
                ));
				
				
                Session::flash('home', '<div id="modalAlert">Welcome ' . Input::get('i_name') . ' Admin! Your account has been registered. You may now log in.</div>');
                Redirect::to('index.php');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . "<br>";
            }
        }
    }
}
?>