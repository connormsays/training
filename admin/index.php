<?php
require('./inc/site.php');
if(!$admin->isloggedin())
{
	header("Location: login.php");
}


$admin->top("Test");

?>
This is a test
<?php
$admin->footer();
?>