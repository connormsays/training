<?php
require('./inc/site.php');
require('./inc/db.php');
if($_SESSION['userID'] != "")
{
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Regsiter | <?php echo $site->getSetting('siteName'); ?></title>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./vendors/animate.css/animate.min.css" rel="stylesheet">
    

    <!-- Custom Theme Style -->
    <link href="./build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <?php
  if(isset($_POST['submit']))
  {
    //Okie dokie so first things first we need to de-hackify the input data...
    $fname = $mysqli->real_escape_string($_POST['fname']);
    $lname = $mysqli->real_escape_string($_POST['lname']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $pass = $mysqli->real_escape_string($_POST['pass1']);
    $mob = $mysqli->real_escape_string($_POST['mobile']);
    $addr1 = $mysqli->real_escape_string($_POST['addr1']);
    $addr2 = $mysqli->real_escape_string($_POST['addr2']);
    $addr3 = $mysqli->real_escape_string($_POST['addr3']);
    $town = $mysqli->real_escape_string($_POST['town']);
    $county = $mysqli->real_escape_string($_POST['county']);
    $postcode = $mysqli->real_escape_string($_POST['postcode']);
    $mobile = $mysqli->real_escape_string($_POST['mobile']);
    \Stripe\Stripe::setApiKey($site->getSetting('stripe_secret'));

    $pass = $site->encryptPassword($email, $pass);
    $customer = \Stripe\Customer::create(array(
    "email" => $email,
    ));

    $cid = $customer->id;
    if($cid != "")
    {
      $SQL = "INSERT INTO users(`email`, `password`, `firstName`, `lastName`, `stripeCustomer`, `addr1`, `addr2`, `addr3`, `town`, `county`, `postcode`, `mobile`) VALUES ('$email', '$pass', '$fname', '$lname', '$cid', '$addr1', '$addr2', '$addr3', '$town', '$county', '$postcode', '$mobile');";
      $res = $mysqli->query($SQL);
      if($res)
      {
        //$mail->send($email, 'New Registration', '<h3>Hello</h3> <br />Just to let you know that your registration has gone through successfully, welcome to the site!');
        ?>
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Welcome! </strong> You are successfully registered, welcome to the family.
        </div>
        <?php
      }
      else
      {
        echo $mysqli->error . "Test";
      }

    }

  }
          ?>

            <form action='register.php' method="POST">
              <h1>Registration Form</h1>
<div class="form-group">
<input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" required>
</div>
<div class="form-group">
<input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" required>
</div>
<div class="form-group">
<input type="email" class="form-control" id="email" name='email' placeholder="Email" required>
</div>
<div class="form-group">
<input type="password" class="form-control" id="pass1" name='pass1' placeholder="Password" required>
</div>
<div class="form-group">
<input type="password" class="form-control" id="pass2" name='pass2' placeholder="Confirm Password" required>
</div>
<div class="form-group">
<input type="text" class="form-control" id="mobile" name='mobile' placeholder="Mobile Number" required>
</div>



<div class="form-group">
<input type="text" class="form-control" id="addr1" name='addr1' placeholder="Address First Line" required>
</div>
<div class="form-group">
<input type="text" class="form-control" id="addr2" name='addr2' placeholder="Address Second Line">
</div>
<div class="form-group">
<input type="text" class="form-control" id="addr3" name='addr3' placeholder="Third Line">
</div>
<div class="form-group">
<input type="text" class="form-control" id="town" name='town' placeholder="Town" required>
</div>
<div class="form-group">
<input type="text" class="form-control" id="county" name='county' placeholder="County" required>
</div>
<div class="form-group">
<input type="text" class="form-control" id="postcode" name='postcode' placeholder="Postcode" required>
</div>
            <div class="form-group">
                <center><input type='submit' name='submit' value='Register' class="btn btn-default submit" /></center>
               
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i> <?php echo $site->getSetting('siteName'); ?></h1>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>


      </div>
    </div>
  </body>
  <script type="text/javascript" src='./js/register.js'></script>
</html>
