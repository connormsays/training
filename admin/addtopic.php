<?php
//Create a course
require('./inc/site.php');
$admin->top("Create a Topic");
$sql = "SELECT * FROM courses JOIN modules on courses.id = modules.courseID";
$res = $mysqli->query($sql);
if(!$res)
{
	echo $mysqli->error;
}
while($row = $res->fetch_assoc())
{
	echo $row['name'];
}

$admin->footer();