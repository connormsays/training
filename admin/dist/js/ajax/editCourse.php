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

	case "deleteModule":
	$id = $mysqli->real_escape_string($_POST['id']);
	$sql = "DELETE FROM modules where module_id='$id'";
	if(!$mysqli->query($sql))
	{
		echo $mysqli->error;
	}else
	{
		echo "Updated";
	}
	break;

	case "createModule":
	$id = $mysqli->real_escape_string($_POST['id']);
	$name = $mysqli->real_escape_string($_POST['name']);
	$sql = "INSERT INTO modules (courseID, name, displayOrder) VALUES ('$id', '$name', '1')";
	if(!$mysqli->query($sql))
	{
		echo $mysqli->error;
	}else
	{
		echo "Updated";
	}
	break;
}