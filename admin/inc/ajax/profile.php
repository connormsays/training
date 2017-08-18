<?php
require('../site.php');


if(isset($_POST['act']))
{
	switch ($_POST['act'])
	{
		case "bio":
		$bio = $mysqli->real_escape_string($_POST['bio']);
		$sql = "UPDATE staff SET bio='$bio' WHERE id = '{$_SESSION['staffID']}'";
		$res = $mysqli->query($sql);
		if(!$res)
		{
			echo $mysqli->error;
		}else
		{
			echo "Updated";
		}

		case "name":
		$name = $mysqli->real_escape_string($_POST['name']);
		$sql = "UPDATE staff SET name='$name' WHERE id = '{$_SESSION['staffID']}'";
		$res = $mysqli->query($sql);
		if(!$res)
		{
			echo $mysqli->error;
		}else
		{
			echo "Updated";
		}
		break;

	}
}