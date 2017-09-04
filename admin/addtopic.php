<?php
//Create a course
require('./inc/site.php');
$admin->top("Create a Topic");
?>
<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
<select name='courses' id='courses' class='form-control'>
<option value=''>Please select a course</option>
<?php
$sql = "SELECT * FROM courses";
$res = $mysqli->query($sql);
if(!$res)
{
	echo $mysqli->error;
}
while($row = $res->fetch_assoc())
{
	echo "<option value='{$row['id']}'>{$row['name']}</option>";
}
?>
</select></div>
<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
<select name='modules' id='modules' class='form-control' disabled="true">
<option value=''>Please select a module</option>

</select></div>

<?php

$admin->footer();
?>

<script type="text/javascript" src='./dist/js/topic.js'></script>