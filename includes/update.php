<?php


require_once './core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if($validate->passed()) {
            try {
                $user->update(array(
                    'first_name' => Input::get('f_name'),
					'last_name' => Input::get('l_name')
                ));

                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');

            } catch(Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach($validate->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="f_name">First Name</label>
        <input type="text" name="f_name" value="<?php echo escape($user->data()->first_name); ?>">
        
        <label for="l_name">Last Name</label>
        <input type="text" name="l_name" value="<?php echo escape($user->data()->last_name); ?>">

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Update">
    </div>
</form>