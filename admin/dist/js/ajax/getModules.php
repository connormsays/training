<?php
require('../../../inc/site.php');

if(isset($_POST['id']))
{
	$id = $mysqli->real_escape_string($_POST['id']);

	$sql = "SELECT * FROM modules where courseID = '$id'";
	$res = $mysqli->query($sql);
	$rows = array();
	while($row = $res->fetch_assoc())
	{
		$rows[] = array('module' =>$row);
	}

	echo json_encode($rows);
}