<?php
$notIndex=true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php';

if(!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    $user = new User($username);

    if(!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();
?>
<section id="mainContainer">

        <p>Name: <?php echo escape($data->first_name); ?></p>
        <p>Institution: <?php echo escape($data->institution_code); ?></p>
        <p>Modules: </p>
</section>

<?php
    }
}
require_once 'views/all_pages/foot.php'; 