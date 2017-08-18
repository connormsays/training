<?php
//Create a course
require('./inc/site.php');
$admin->top("Create a course");
if(isset($_POST['submit']))
{
	//Sanitise
	$name = $mysqli->real_escape_string($_POST['name']);
	$description = $mysqli->real_escape_string($_POST['description']);
	$price = $mysqli->real_escape_string($_POST['price']);

	$sql = "INSERT INTO courses (id, name, description, author, price) VALUES (NULL, '$name', '$description', '{$_SESSION['staffID']}', '$price')";
	$res = $mysqli->query($sql);
	if(!$res)
	{
		echo $mysqli->error;
	}
	else
	{
		echo'<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Success! </strong>Course has been added successfully, manage from <a href="managecourse.php">course manager</a>
		</div>';
	}

}
?>

<form action="newcourse.php" method="POST" role="form">
	<legend>Create a course</legend>

	<div class="form-group">
		<label for="name">Course Name</label>
		<input type="text" class="form-control" name="name" placeholder="Course name..." required>
	</div>
	<div class="form-group">
		<label for="description">Course Description</label>
		<textarea name='description' class='form-control' placeholder="Description..."></textarea>		
	</div>
	<div class="form-group">
		<label for="price">Course Cost</label>
		<?php echo $admin->getSetting('currency'); ?><input type="number" min="0.00" max="10000.00" step="0.01"  class="form-control" name="price" required>	
	</div>
	

	<input type="submit" name='submit' value='Add Course' class="btn btn-primary" />
</form>

<?php
$admin->footer();