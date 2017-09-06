
<?php
//Create a course
require('./inc/site.php');
$admin->top("Create a Topic");
if(isset($_POST['submit']))
{
	var_dump($_POST);
}

?>
<!-- Include Editor style. -->

 
<!-- Include JS file. -->

<h1>Create a topic</h1>
<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>

<select name='courses' id='courses' class='form-control'>
<option value=''>Please select a course</option>
<?php
$sql = "SELECT * FROM courses";
$res = $mysqli->query($sql);
if(!$res)
{
	echo $mysqli->error;
}
while($row = $res->fetch_assoc())
{
	echo "<option value='{$row['id']}'>{$row['name']}</option>";
}
?>
</select></div>
<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
<select name='modules' id='modules' class='form-control' disabled="true">
<option value='0'>Please select a module</option>
</select></div><br /><br />

<div class='topicContent' style='display: none;'>
<h3>Topic Content</h3>
<form action="addtopic.php" method="POST" role="form">
	<div class="form-group">
		<label for="topicTitle">Topic Title</label>
		<input type="text" class="form-control" id="title" name='title' placeholder="Topic Title...">
	</div>
		<div class="form-group">
		<label for="topicContent">Topic Content</label>
		<textarea name="content" id="inputContent" class="form-control" rows="10"></textarea>
	</div>

	

	<input type="submit" name='submit' id='submit' value="submit" class="btn btn-primary" />
</form>
</div>

<!-- include summernote css/js-->

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
<link href="./dist/summernote.css" rel="stylesheet">
<script src="./dist/summernote.js"></script>
<script type="text/javascript">
	$('#inputContent').summernote({
		fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
		toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['fontname','strikethrough', 'superscript', 'subscript']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['insert', ['picture', 'link', 'video']]
  ]
	});

</script>
<?php

$admin->footer();
?>


<script type="text/javascript" src='./dist/js/topic.js'></script>