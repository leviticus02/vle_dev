<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
			 'm_name' => array(
                'name' => 'Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'module_code' => array(
                'module_code' => 'module_code',
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'modules'
            ),
        ));

        if ($validate->passed()) {
            $user = new User();
			$query = new Query();

            try {
              
				 $query->createModule(array(
				 	'institution_code' => Input::get('i_code'),
				 	'parent_course_code' => Input::get('parent'),
				 	'module_code' => Input::get('module_code'),
					'name' => Input::get('m_name'),
					'description' => Input::get('m_description'),
                    'module_year' => Input::get('year')
					
                ));
				
			echo '<div id="modalAlert">' . 
			  		'Module: ' . Input::get('m_name') . ' added' .
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