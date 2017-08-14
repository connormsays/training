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

    <title>Login | Isograph Training</title>

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
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
<?php
if(isset($_POST['submit']))
{
$username = $mysqli->real_escape_string($_POST['username']);
$password = $mysqli->real_escape_string($_POST['password']);

$sql = "SELECT * FROM users where email='$username' AND password='$password'";
$res = $mysqli->query($sql);
if($res)
{
  $row = $res->fetch_assoc();

  if($row['email'] == "")
  {
   echo "<div class=\"alert alert-danger\">
     <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
     <strong>Title!</strong> Alert body ...
   </div>";
  }else{
    $_SESSION['username'] = $row['email'];
  }

}else{
  echo $mysqli->error;
}
}
?>


            <form action='login.php' method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" name='username' placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name='password' placeholder="Password" required="" />
              </div>
              <div>
                <input type='submit' name='submit' value='Login' class="btn btn-default submit" />
               
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i> Isograph Online Training</h1>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>


      </div>
    </div>
  </body>
</html>
