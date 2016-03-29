<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
			 'c_name' => array(
                'name' => 'Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'course_id' => array(
                'course_id' => 'course_id',
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'courses'
            ),
        ));

        if ($validate->passed()) {
            $user = new User();
			$query = new Query();

            try {
              
				 $query->createCourse(array(
					'institution_code' => Input::get('i_code'),
					'course_id' => $user->data()->institution_code . '-' . Input::get('course_id'),
                    'course' => Input::get('c_name'),
					'type' => Input::get('courseType'),
                    'length' => Input::get('duration')
                ));
				

                Redirect::to('modules.php?course=' . $user->data()->institution_code . '-' . Input::get('course_id'));
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