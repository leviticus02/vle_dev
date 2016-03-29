<?php
$notIndex=true;
$vlePage = true;
require_once 'views/all_pages/head.php'; 
require_once 'views/all_pages/nav_bar.php';

	$user = new User();
	//put in check to see if student is registered for module, if not dont allow
	//login check
	if(!$user->isLoggedIn()) {
		Redirect::to('index.php');
	}
	if (isset($_GET['module'])){
		$modCode = $_GET['module'];	
	}else{
		$modCode = "";	
	}
	$code = $user->data()->institution_code;
	$moduleInfo = $query->moduleInfo($code, $modCode);
	if ($moduleInfo){
		foreach ($moduleInfo as $moduleRow){
			$moduleTitle = $moduleRow->name;
			$moduleCode = $moduleRow->module_code;
		}
		$exists = true;	
	}else{
		Redirect::to('404');
		$exists = false;	
	}
	
	if ($user->hasPermission('mod') || $user->hasPermission('admin')){
		$permission = true;	
	}else{
		$permission = false;	
}
?>


<section id="vleContainer">
	<section id="sidePanel">
            <section id="sideHead">
                <div id="sideTitle">
                    <p class="sideTitle"><?php echo $moduleTitle; ?></p>
                    <p class="sideTitle"><?php echo $moduleCode; ?></p>
                </div>
            </section>
            
            <section id="sideLinks">
                <a id="modLink" href="#/feed">Module Feed</a>
            	<a id="modLink" href="#/docs">Module Documents</a>
                <a id="modLink" href="#/staff">Faculty</a>
            </section>
    </section>
    
    <section id="modulePageInformation">
    
        <section id="moduleFeed"></section>
        
        <section id="quickLinks">
           Quick Links<br />
            Assignment documents<br />
            Module Guide<br />
            Reading list<br />
            <?php
                    
				if ($permission) :
						
			?>
                    
             	<p class="sideTitle">edit or add files here</p>
                    
            <?php
						
				endif ;
                    
            ?>
        </section>
    </section>


</section>
<script type="text/javascript" src="public/js/app.js"></script>
<script type="text/javascript">

</script>
<?php
    

require_once 'views/all_pages/foot.php'; 