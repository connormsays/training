<?php
require('../../inc/db.php');
if(isset($_POST['email']))
{
		$email = $mysqli->real_escape_string($_POST['email']);

		$sql = "SELECT * FROM users WHERE username = '$email'LIMIT 1";
		$res = $mysqli->query($sql);
		if(!$res)
		{
			echo $mysqli->error;
		}else{
			$rr = $res->fetch_assoc();
			if($rr['username'] == $email)
			{
			echo "User Exists";
			}
			else{
				
			}
			
		}
}
?>