<?php
//var_dump($_POST);
require '../core/init.php';
if (Input::exists()) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
			 'post_body' => array(
                'name' => 'Name',
                
            ),
        ));

        if ($validate->passed()) {
            $user = new User();
			$query = new Query();
			$moduleInfo = $query->moduleInfo($user->data()->institution_code, $_POST['module_code']);
            try {
				
				
				$links = preg_replace('/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i','<a target=\'_blank\' href=\'$1\'>$1</a>', Input::get('post_body'));
				
				
                $inID = $query->modulePost(array(
                    'parent_module_id' => $moduleInfo[0]->id,
					'institution_id' => $user->data()->institution_code,
					'user_id' => $user->data()->id,
                    'post_body' => Input::get('post_body'),
                    'links' => "",
                    'documents' => ""
                ));
				
				/*
				$code = $user->data()->institution_code;
				$feed = $user->getModuleFeed($code, $moduleInfo[0]->id);
				echo $feed;
				*/
				
				//this is returning the query result info to put back onto the page, it would be better to have a query here that gets the 
				//info from the database using the insert id from abve
				echo json_encode([
					'id' => $inID,
					'parent_module_id' => $moduleInfo[0]->id,
					'institution_id' => $user->data()->institution_code,
					'user_id' => $user->data()->id,
					'post_body' => Input::get('post_body'),
					'links' => '',
					'documents' => '',
					'date' => date('today'),
					'user' => [
						'first_name' => $user->data()->first_name,
						'last_name' => $user->data()->last_name,
						'name' => $user->data()->name,
						'username' => $user->data()->username,
						'id' => $user->data()->id
					]
				]);
				
	 
            } catch(Exception $e) {
                echo $error, '<br>';
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . "<br>";
            }
        }
		
    }
?>