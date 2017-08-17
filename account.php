<?php
require('./inc/site.php');
require('./inc/db.php');
if(!$site->isLoggedIn())
{
header("Location: login.php");
}
$site->top("Manage Account");
$act = $_GET['act'];
?>
<link rel="stylesheet" type="text/css" href="./build/css/checkout.css">
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Manage Account</h3>
				</div>
			</div>            
			<div class='row'>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<form action="account.php?act=<?php echo $act; ?>" method="POST" role="form" enctype="multipart/form-data">
						<?php
						$sql  = "SELECT * FROM users where email = '{$_SESSION['username']}'";
								$res = $mysqli->query($sql);
								$row = $res->fetch_assoc();
						if(isset($_POST['submit']))
						{
							switch($_POST['act'])
							{
								case "pass":
								
								$old = $mysqli->real_escape_string($_POST['old']);
								$new = $mysqli->real_escape_string($_POST['new']);
								$confirm = $mysqli->real_escape_string($_POST['confirm']);

								if($row['password'] == $site->encryptPassword($_SESSION['username'], $old))
								{
									if($new == $confirm)
									{
										$newPass = $site->encryptPassword($_SESSION['username'], $new);
										$sql = "UPDATE users set password='$newPass' WHERE email ='{$_SESSION['username']}'";
										if(!$mysqli->query($sql))
										{
											echo $mysqli->error;
										}
										else
										{
											echo'<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Success!</strong> Your password has been updated
									</div>';
										}
									}else
									{
										echo'<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Error!</strong> New password and confirmation do not match
									</div>';
									}
								}else
								{
									echo'<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Error!</strong> Old password is not correct
									</div>';
								}
								break;

								case "info":
									//Okie dokie so first things first we need to de-hackify the input data...
								    $fname = $mysqli->real_escape_string($_POST['fname']);
								    $lname = $mysqli->real_escape_string($_POST['lname']);
								    
								    $mob = $mysqli->real_escape_string($_POST['mobile']);
								    $addr1 = $mysqli->real_escape_string($_POST['addr1']);
								    $addr2 = $mysqli->real_escape_string($_POST['addr2']);
								    $addr3 = $mysqli->real_escape_string($_POST['addr3']);
								    $town = $mysqli->real_escape_string($_POST['town']);
								    $county = $mysqli->real_escape_string($_POST['county']);
								    $postcode = $mysqli->real_escape_string($_POST['postcode']);
								    $mobile = $mysqli->real_escape_string($_POST['mobile']);
									$sql = "UPDATE users set firstName ='$fname', lastName='$lname', addr1='$addr1', addr2='$addr2', addr3='$addr3', town='$town', county='$county', postcode='$postcode', mobile='$mob' WHERE email = '{$_SESSION['username']}'";
									if(!$mysqli->query($sql))
									{
										echo $mysqli->error;
									}
									else
									{
										echo'<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Success!</strong> Your account has been updated.
									</div>';									
									}
								break;
							}
						}
						$sql  = "SELECT * FROM users where email = '{$_SESSION['username']}'";
								$res = $mysqli->query($sql);
								$row = $res->fetch_assoc();
						switch($act)
						{
							case "pass":
							echo '<div class="form-group"><label for="old">Current Password</label><input type="password" class="form-control" name="old"></div>
							<div class="form-group"><label for="new">New Password</label><input type="password" class="form-control" name="new"></div>
							<div class="form-group"><label for="confirm">Confirm Password</label><input type="password" class="form-control" name="confirm"></div>
							<input type="hidden" name="act" value="pass" /><button type="submit" class="btn btn-primary" name=\'submit\'>Submit</button>';
							break;

							case "info":

							echo '<div class="form-group">
<label for="fname">First Name</label><input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="'.$row['firstName'].'" required>
</div>
<div class="form-group">
<label for="lname">Last Name</label><input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="'.$row['lastName'].'" required>
</div>
<div class="form-group">
<label for="mobile">Mobile</label><input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" value="'.$row['mobile'].'" required>
</div>
<div class="form-group">
<label for="addr1">Address Line 1</label><input type="text" class="form-control" id="addr1" name="addr1" placeholder="Address First Line" value="'.$row['addr1'].'" required>
</div>
<div class="form-group">
<label for="addr2">Address Line 2</label><input type="text" class="form-control" id="addr2" name="addr2" placeholder="Address Second Line" value="'.$row['addr2'].'">
</div>
<div class="form-group">
<label for="addr3">Address Line 3</label><input type="text" class="form-control" id="addr3" name="addr3" placeholder="Third Line" value="'.$row['addr3'].'">
</div>
<div class="form-group">
<label for="town">Town</label><input type="text" class="form-control" id="town" name="town" placeholder="Town" required value="'.$row['town'].'">
</div>
<div class="form-group">
<label for="county">County</label><input type="text" class="form-control" id="county" name="county" placeholder="County" value="'.$row['county'].'" required>
</div>
<div class="form-group">
<label for="postcode">Postcode</label><input type="text" class="form-control" id="postcode" name="postcode"  value="'.$row['postcode'].'" required>
</div>

<input type="hidden" name="act" value="info" /><button type="submit" class="btn btn-primary" name=\'submit\'>Submit</button>';
							break;

							case "billing":
							echo "Here you can view any saved payment methods";
							//Show our stripe payment system
							$card = \Stripe\Customer::retrieve($row['stripeCustomer'])->sources->all(array('object' => 'card'));
							$i = 0;
							foreach($card->data as $item) {
								?>
								<div class='cardBox'>
							<img src='./images/cards/<?php echo $item->brand; ?>.png' alt='<?php echo $item->brand; ?>' title='<?php echo $item->brand; ?>' /> <?php echo "Ending in " . $item->last4; ?> <span style='float:right;'><button type="button" class="btn btn-danger">Delete</button><?php if($i != '0'){echo '<button type="button" class="btn btn-success default" id="" data-card="'.$item->id.'">Make Default</button>'; } $i++;?></span></div>

					
								<?php
							}
							break;
						}


						?>						
					
					</form>
				</div>
				</div>
		</div>
	</div>
</div>
        <!-- /page content -->

<?php
$site->foot();
?>
<script type="text/javascript">
	$('.default').click(function(){
		$(this).html("<img src='./images/loading.gif' width='50px'/>");
		$.post('./inc/ajax/default.php', {act: 'change', customer: '<?php echo $row['stripeCustomer'];?>',card: $(this).data("card")}, function(data){
		console.log(data);
		location.reload();
	});
	});
</script>