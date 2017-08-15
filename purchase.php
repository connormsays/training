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
				if(isset($_POST['number']))
				{
					if($_POST['stripeToken'] == "")
					{
						echo "<div class=\"alert alert-danger\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
							<strong>Ooops!</strong> Something went wrong
						</div>";
					}
					else
					{
						$token = $mysqli->real_escape_string($_POST['stripeToken']);
						$name = $mysqli->real_escape_string($_POST['name']);
						$card = $mysqli->real_escape_string($_POST['number']);
						$exp_month = $mysqli->real_escape_string($_POST['exp_month']);
						$exp_year = $mysqli->real_escape_string($_POST['exp_year']);
						$cvc = $mysqli->real_escape_string($_POST['cvc']);
						$amount = $mysqli->real_escape_string($_POST['amount']) * 100;
						
						try{

						$charge = \Stripe\Charge::create(array(
						  "amount" => $amount,
						  "currency" => "gbp",
						  "source" => $token, // obtained with Stripe.js
						  "description" => "Isograph.com Training Course Charge"
						  
						));

						var_dump($charge);
					} catch (Exception $ex)
					{
						echo $ex;
					}
					}
				}
				var_dump($_POST);
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
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class='boxTitle'>
							Order Details
						</div>
						<div class='infoBox'>
							<span class='courseTitle'><?php echo $row['name']; ?></span> - <i><span class='author'> Created by: <?php echo $row['author']; ?></span></i><br />
							<?php echo $row['description']; ?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class='boxTitle'>
							Pricing Information
						</div>
						<div class='infoBox'>
							<strong>1 X <?php echo $row['name']; ?></strong> <span class='orderPrice'><?php echo $site->getSetting('currency') . $row['price']; ?></span>
							<hr />
							<strong>Order Total</strong> <span class='orderPrice'><?php echo $site->getSetting('currency') . $row['price']; ?></span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class='boxTitle'>
							Payment Information
						</div>
						<div class='infoBox'>
						Select Payment Method
						<div class='infoBox payment'>
						<input type='radio' name='payment[]' id='card' /> Credit / Debit Card<br />
						<div class='creditCardPayment' style="display: none;">
						<div class="payment-errors" style="display:none;">
							
							
						</div>
						<form action="purchase.php" method="POST" role="form" id='payment-form'>
						<div class="form-group">
								<label for="Name">Name on Card</label>
								<input type="text" class="form-control" id="cardName" name='name' data-stripe="name" required>
							</div>
							<div class="form-group">
								<label for="number">Card Number</label>
								<input type="text" class="form-control" id="cardNum" name='number' data-stripe="number" required>
							</div>
							<div class='row'>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
								<label for="exp_month">Expiry Month</label>
								<input type="text" class="form-control" id="cardMonth" name='exp_month' data-stripe="exp_month" required>
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
								<label for="exp_year">Expiry Year</label>
								<input type="text" class="form-control" id="cardYear" name="exp_year" data-stripe="exp_year" required>
							</div>
							</div>
							</div>
							<div class="form-group">
								<label for="cvc">CVC Code</label>
								<input type="text" class="form-control" id="cardCVC" name='cvc' data-stripe="cvc" required>
								<input type='hidden' name='amount' value='<?php echo $row['price'];?>' />
							</div>
						
							
						
							<input type="submit" id='submit_form' name='submit_form' class="btn btn-primary" value='Pay Now' />
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
        <script src="https://js.stripe.com/v2/"></script>
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

<script type="text/javascript" src='./build/js/stripe.js'></script>

<script type="text/javascript">
Stripe.setPublishableKey('<?php echo $site->getSetting('stripe_publish'); ?>');
</script>



<?php
$site->foot();
?>