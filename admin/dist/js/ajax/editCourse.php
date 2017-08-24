<?php
require('../../../inc/site.php');

switch($_POST['act'])
{
	case "updateCourse":
	$name = $mysqli->real_escape_string($_POST['name']);
	$price = $mysqli->real_escape_string($_POST['price']);
	$desc = $mysqli->real_escape_string($_POST['desc']);
	$id = $mysqli->real_escape_string($_POST['id']);

	$sql = "UPDATE courses SET name='$name', price='$price', description='$desc' WHERE id='$id'";
	if(!$mysqli->query($sql))
	{
		echo $mysqli->error;
	}else
	{
		echo "Updated";
	}

	break;
}