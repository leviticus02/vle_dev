<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
			 'i_code' => array(
                'name' => 'Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
        ));

        if ($validate->passed()) {
            $user = new User();
			$query = new Query();

            try {
              
				 $query->addStaff(array(
					'institution_code' => Input::get('i_code'),
					'staff_id' => Input::get('staffName'),
                    'course_level' => Input::get('type'),
					'course_code' => Input::get('parent'),
                    'role' => Input::get('role')
                ));
				

                echo '<div id="modalAlert">' . 
			  		'Staff member added' .
					'</div>';
					
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