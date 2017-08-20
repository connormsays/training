<?php
//Create a course
require('./inc/site.php');
if(!$admin->isloggedin())
{
	header("Location: login.php");
}
$admin->top("Create a course");
?>
<h1>Manage Courses</h1>
<?php
if(isset($_GET['c']))
{
	$courseID = $mysqli->real_escape_string($_GET['c']);
	?>
	<table class="table table-responsive table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Author</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			$sql = "SELECT *, courses.name as CourseName, courses.id AS courseID FROM courses join staff on courses.author = staff.id";
			$res = $mysqli->query($sql);
			if(!$res)
			{
				echo $mysqli->error;
			}else
			{
				while($row = $res->fetch_assoc())
				{
					echo "<tr><td class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>{$row['CourseName']}</td>
						  <td class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>{$row['description']}</td>
						  <td>{$row['name']}</td>
						  <td><a href='edit.php?c={$row['courseID']}' class='btn btn-primary'>Edit</a> <a href='' id='delete' class='btn btn-danger' data-id='{$row['courseID']}'>Delete </a></td>
						  </tr>";
				}
			}
			?>
		
	</tbody>
</table>
}
$admin->footer();

