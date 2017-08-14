<?php
require('./inc/site.php');
require('./inc/db.php');
$site->top("Test");
$cid = $mysqli->real_escape_string($_GET['cid']);
?>
<link rel="stylesheet" type="text/css" href="./build/css/checkout.css">
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Purchase a new course</h3>
				</div>
			</div>            
			<div class='row'>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php
				if ($cid == "")
				{
					die("Invalid parameters");
				}
				$sql = "SELECT * FROM courses WHERE id='$cid'";
				$res = $mysqli->query($sql);
				if(!$res)
				{
					echo $mysqli->error;
				}
				$row = $res->fetch_assoc();
				?>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class='boxTitle'>
							Order Details
						</div>
						<div class='infoBox'>
							<span class='courseTitle'><?php echo $row['name']; ?></span> - <i><span class='author'> Created by: <?php echo $row['author']; ?></span></i><br />
							<?php echo $row['description']; ?>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class='boxTitle'>
							Payment Information
						</div>
						<div class='infoBox'>
						Select Payment Method
						<div class='infoBox payment'>
						<input type='radio' name='payment[]' id='card' /> Credit / Debit Card<br />
						<div class='creditCardPayment' style="display: none;">
						<form action="" method="POST" role="form">
						<div class="form-group">
								<label for="Name">Name on Card</label>
								<input type="text" class="form-control" id="cardName" name='name' required>
							</div>
							<div class="form-group">
								<label for="number">Card Number</label>
								<input type="text" class="form-control" id="cardNum" name='number' required>
							</div>
							<div class='row'>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
								<label for="exp_month">Expiry Month</label>
								<input type="text" class="form-control" id="cardMonth" name='exp_month' required>
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
								<label for="exp_year">Expiry Year</label>
								<input type="text" class="form-control" id="cardYear" name="exp_year" required>
							</div>
							</div>
							</div>
							<div class="form-group">
								<label for="cvc">CVC Code</label>
								<input type="text" class="form-control" id="cardCVC" name='cvc' required>
							</div>
						
							
						
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
						</div>
						</div>
						<div class='infoBox payment'>
						<input type='radio' name='payment[]' id='paypal' /> <img src='https://thevinevilla.files.wordpress.com/2015/05/paypal-logo.png?w=240' width="80px" alt='Paypal' title="Paypal" /><br />
						<div class='paypal' style="display:none;">
						Continue below to paypal. 
						</div>
						</div>
						</div>
					</div>
				</div>



				</div>
				</div>
		</div>
	</div>
</div>
        <!-- /page content -->
        <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
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

<?php
$site->foot();
?>