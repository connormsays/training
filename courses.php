<?php
require('./inc/site.php');
require('./inc/db.php');
if(!$site->isLoggedIn())
{
header("Location: login.php");
}
$site->top("My Courses");
?>
<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Purchased Courses</h3>
				</div>
			</div>            
			<div class='row'>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Course Name</th>
							<th>Author</th>
							<th>Purchase Date</th>
							<th>Progess</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$sql = "SELECT * FROM orders join courses on courses.id = orders.courseID where username = '{$_SESSION['username']}'";
					$res = $mysqli->query($sql);
					if(!$res)
					{
						echo $mysqli->error;
					}else
					{
						while($row = $res->fetch_assoc())
						{
							echo "<tr><td>{$row['name']}</td><td>{$row['author']}</td><td>{$row['purchase_date']}</td><td>
							<div class=\"progress\"><div class=\"progress-bar progress-bar-info\" role=\"progressbar\" aria-valuenow=\"{$row['user_progress']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['user_progress']}%; color:#4E4E4E;\">  {$row['user_progress']}% Complete</div></div> <a href='quiz.php?c={$row['id']}' class='btn btn-success'> <i class=\"fa fa-play-circle\" aria-hidden=\"true\"></i> Continue </a></td></tr>";
						}
					}


					?>
						
					</tbody>
				</table>

				</div>
				</div>
		</div>
	</div>
</div>
        <!-- /page content -->
        <script src="https://js.stripe.com/v2/"></script>

        <script type="text/javascript">
        	$('#card').click(function()
        	{
        		$('.creditCardPayment').fadeIn();
        		$('.paypal').hide();
        	});
        	$('#paypal').click(function()
        	{
        		$('.paypal').fadeIn();
        		$('.creditCardPayment').hide();
        	});

        	$('#cardNum').focusout(function(){
        		$('#cardNum').prop('type', 'password');
        	});
        	$('#cardNum').focusin(function(){
        		$('#cardNum').prop('type', 'text');
        	});

        </script>

<script type="text/javascript" src='./build/js/stripe.js'></script>

<script type="text/javascript">
Stripe.setPublishableKey('<?php echo $site->getSetting('stripe_publish'); ?>');
</script>



<?php
$site->foot();
?>