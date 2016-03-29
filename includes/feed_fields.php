<?php
if (Input::exists()) {
		if (Input::get('feedPost') != NULL){
			
				//this is a main post
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
				 'feedPost' => array(
					'name' => 'Feed Post',
					'required' => true
				),
			));
	
			if ($validate->passed()) {
				
				$user = new User();
				$query = new Query();
				
				try {
				  
					 $query->postToFeed(array(
						'poster_id' => $user->data()->id,
						'institution_code' => $user->data()->institution_code,
						'course_code' => Input::get('courseID'),
						'attachment' => "",
						'post_body' => Input::get('feedPost')
					));
					
						
				} catch(Exception $e) {
					echo $error, '<br>';
				}
			} else {
				echo '<div id="modalAlert">';
				foreach ($validate->errors() as $error) {
					echo $error . "<br>";
				}
				echo '</div>';
			}
			
		}elseif (Input::get('replyPost') != NULL){
				//this is comment
				$validate = new Validate();
					$validation = $validate->check($_POST, array(
					'replyPost' => array(
					'name' => 'Reply Post',
					'required' => true
					),
				));
		
				if ($validate->passed()) {
					
					$user = new User();
					$query = new Query();
					
					try {
					  
						 $query->feedReply(array(
							'poster_id' => $user->data()->id,
							'parent_post_id' => Input::get('parent'),
							'reply_body' => Input::get('replyPost'),
							'reply_to_id' => Input::get('replyTo')
						));
						
							
					} catch(Exception $e) {
						echo $error, '<br>';
					}
				} else {
					echo '<div id="modalAlert">';
					foreach ($validate->errors() as $error) {
						echo $error . "<br>";
					}
					echo '</div>';
				}
				
		}else{
			//both null	
		}
}
?>