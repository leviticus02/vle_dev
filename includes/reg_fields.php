<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'first_name' => array(
                'name' => 'Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
			 'last_name' => array(
                'name' => 'Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'username' => array(
                'name' => 'Username',
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
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
				
                $inID = $query->create(array(
                    'name' => Input::get('first_name') . " " . Input::get('last_name'),
					'first_name' => Input::get('first_name'),
					'last_name' => Input::get('last_name'),
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'joined' => date('Y-m-d H:i:s'),
					'institution_code' => Input::get('i_code'),
                    'group' => Input::get('role')
                ));
				
				if(Input::get('role') == '2'){
					$query->createStaffRecord(array(
						'user_id' => $inID,
						'institution_id' => Input::get('i_code')
                	));
				}elseif(Input::get('role') == '1'){
					 $query->createStudentRecord(array(
					'user_id' => $inID,
					'institution_id' => Input::get('i_code'),
                    'course' => Input::get('course'),
					//'course_type' => Input::get('courseType'),
                    'year' => Input::get('yearSelect')
                ));
				}else{
					 $query->createStudentRecord(array(
					'user_id' => $inID,
					'institution_id' => Input::get('i_code'),
                    'course' => Input::get('course'),
					//'course_type' => Input::get('courseType'),
                    'year' => Input::get('yearSelect')
                ));
				}
				
			
				
              echo '<div id="modalAlert">' . 
			  		Input::get('first_name') . ' ' . Input::get('last_name') . 
					' Has been created' .
					'</div>';
             
            } catch(Exception $e) {
                echo $error, '<br>';
            }
        } else {
			echo '<div id="modalAlert">';
            foreach ($validate->errors() as $error) {
                echo $error.'<br>';
            }
			echo '</div>';
        }
		
    }
}
?>