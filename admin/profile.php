<?php
require('./inc/site.php');
if(!$admin->isloggedin())
{
	header("Location: login.php");
}
$admin->top("Profile");
$sql = "SELECT * FROM staff where id='{$_SESSION['staffID']}'";
$res = $mysqli->query($sql);
$row = $res->fetch_assoc();
?>
<div class="box box-primary">
            <div class="box-body box-profile">
            <div class='profileInfo'>
              <div class='Profileimage'><img class="profile-user-img img-responsive img-circle image" src="<?php if($row['profilePictureLocation'] != "" ){echo $row['profilePictureLocation'];} else {echo "./dist/img/user.png";} ?>" alt="User profile picture"></div>
              <div class='middle'><a id='editProfileInfo'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></div>
              <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3></div>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Bio</b> <a class="pull-right" id='editBio'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><br />
                  <div id='bio'>
                  <?php echo $row['bio']; ?>
                  </div>
                </li>
                <li class="list-group-item">
                  <b>Courses</b><br />
                  <?php $csql = "SELECT * FROM courses WHERE author = '{$_SESSION['staffID']}'";
                  $cres = $mysqli->query($csql);
                  while($crow = $cres->fetch_assoc())
                  {
                  	echo $crow['name'] . "<br />";
                  }
                  ?>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <script type="text/javascript">
     
          	$('#editBio').click(function(){
          		
          		$('#bio').html("<textarea id='bioEdit' class='form-control name='bioEdit' rows='10'><?php echo $row['bio'];?></textarea>");

          	});

          	$( document ).on("focusout", "#bioEdit", function()
          	{
          		var bio = $('#bioEdit').val();
				$.post('./inc/ajax/profile.php', {act: 'bio', bio: bio}, function(data){
				if(data == "Updated")
				{
					$('#bio').html(bio);
				}else
				{
					console.log(data);
				}
				});
          		
          	});

          	$('#editProfileInfo').click(function()
          	{
          		$('.profile-username').html("<input type='text' name='name' id='name' class='form-control' value='<?php echo $row['name']; ?>' /><br /><br /><button class='btn btn-success' id='saveProfileInfo'>Save Profile</button>");
          		$('.Profileimage').html("<img class=\"profile-user-img img-responsive img-circle image\" src=\"<?php if($row['profilePictureLocation'] != "" ){echo $row['profilePictureLocation'];} else {echo "./dist/img/user.png";} ?>\" alt=\"User profile picture\"><input type='file' id='profilePic' name='file' class='form-control' />");
          	});

          	$(document).on("click", "#saveProfileInfo", function()
          	{

				var file_data = $('#profilePic').prop('files')[0];   
				var form_data = new FormData();                  
				form_data.append('file', file_data);
				                           
				$.ajax({
				url: './inc/ajax/upload.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(php_script_response){
				console.log(php_script_response); // display response from the PHP script, if any
        $('.Profileimage').html("<img class=\"profile-user-img img-responsive img-circle image\" src=\"<?php if($row['profilePictureLocation'] != "" ){echo $row['profilePictureLocation'];} else {echo "./dist/img/user.png";} ?>\" alt=\"User profile picture\">");
				}
				});

        $.post('./inc/ajax/profile.php', {act: 'name', name: $('#name').val()}, function(data){
        if(data == "Updated")
        {
          $('.profile-username').html($('#name').val());
          location.reload();
        }
      });
        
        

				
          	});
          	
          </script>
<?php
$admin->footer();
?>