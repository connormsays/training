<?php
//Create a course
require('./inc/site.php');
$admin->top("Create a course");
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
	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
$admin->footer();