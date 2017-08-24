<?php
//Create a course
require('./inc/site.php');
if(!$admin->isloggedin())
{
	header("Location: login.php");
}
$admin->top("Editing course");
?>
<style type="text/css">
	.infoBox
{
	background-color: #FFF;
	border: solid 1px #CDCDCD;
	padding: 15px;
	margin-bottom: 40px;
}
.boxTitle
{
	border-left: solid 1px #CDCDCD;
	border-right: solid 1px #CDCDCD;
	border-top: solid 3px #2A3F54;
	background-color: #F6F6F6;
	color: #000;
	padding: 15px;
	font-size: 16px;
	font-weight: bold;
}
</style>

<?php
if(isset($_GET['c']))
{
	$courseID = $mysqli->real_escape_string($_GET['c']);
	$sql = "SELECT *, courses.name as CName, staff.name as StaffName FROM courses JOIN staff on courses.author = staff.id WHERE courses.id ='$courseID'";
	$res = $mysqli->query($sql);
	$row = $res->fetch_assoc();
	echo "<h1>Manage Course: <i>{$row['CName']}</i></h1>";
	?>
	<div class='boxTitle'>
	Course Information <div style='float:right;' id='edit'><a id='editInfo'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
	</div>
	<div class='infoBox'>
	<strong>Course Name : </strong> <div id='courseName'><?php echo $row['CName'];?></div>
	<strong>Author : </strong>	<div id='courseAuthor'><?php echo $row['StaffName']; ?></div>
	<strong>Price : </strong><div id='coursePrice'> <?php echo $admin->getSetting('currency')  . $row['price']; ?></div>
	<strong>Description : </strong>
	<div id='courseDesc'><?php echo $row['description']; ?></div>
	</div>
	<div class='boxTitle'>Modules</div>
	<div class='infoBox'>
	<table class='table table-striped table-responsive'>
	<thead>
	</thead>
	<tbody>
		<?php
		$sqlm = "SELECT * FROM `modules` WHERE courseID = '$courseID' ORDER BY `modules`.`displayOrder` ASC";
		$resm = $mysqli->query($sqlm);
		while($rowm = $resm->fetch_assoc())
		{
			echo "<tr><td>{$rowm['name']}</td><td style='text-align: right;'><button class='btn btn-default' id='edit' data-id='{$rowm['module_id']}'>Edit</button> <button class='btn btn-danger' id='delete' data-id='{$rowm['module_id']}'>Delete</button></td></tr>";
		}
		?>
	</tbody>
	</table>
	</div>
	<?php
}
$admin->footer();
?>
<script type="text/javascript">
	var price = <?php echo $row['price']; ?>;
	var id = <?php echo $courseID; ?>;
</script>
<script type="text/javascript" src='./dist/js/edit.js'></script>
