<?php
//System Settings
require('./inc/site.php');
$admin->top("Settings");
if(isset($_POST['submit']))
{
	foreach($_POST['options'] as $option => $value) 
	{
		$option = $mysqli->real_escape_string($option);
		$value = $mysqli->real_escape_string($value);
		 if($option == "currency")
    {
      $value = htmlentities($value);
    }
		echo $admin->update_option($option, $value);
	}
	echo "<div class=\"alert alert-success\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
			<strong>Success!</strong> Settings updated.
		</div>";
}
echo "<h1>System Settings</h1>";
$sql = "SELECT * FROM settings ORDER BY displayOrder";
$res = $mysqli->query($sql);
echo "<div class=\"box box-primary\">
            <div class=\"box-header with-border\">
              <h3 class=\"box-title\">System Settings</h3></div><div class=\"box-body\">";
echo "<form action='settings.php' method='POST'>";
while($row = $res->fetch_assoc())
{
	echo "<div class=\"form-group\">
		<label for=\"{$row['name']}\">{$row['Display']}</label>
		<input type=\"text\" class=\"form-control\" name='options[{$row['name']}]' value='{$row['value']}'>
	</div>";
}
echo "</div><div class=\"box-footer\">
                <input type=\"submit\" name='submit' class=\"btn btn-primary\" value='Save'/>              </div>";


$admin->footer();