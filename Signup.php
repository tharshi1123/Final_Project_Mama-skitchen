<?php include('Connection.php') ?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Signature Cuisine</title>


    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    </head>
<body>
  
 <!-- ***** Header Area start ***** -->
<?php include 'Navbar.php'; ?>
    <!-- ***** Header Area End ***** -->

    <div style="text-align:center;float:center;padding:150px;">
  <div class="header">
  	<h2>Register</h2>
  </div>
	
<div style="float:center; margin: auto;width: 50%;">
  <form method="post" action="Signup.php"  >
  	<?php include('Error.php'); ?>
  	<div class=" form-group row" >
  	  <label class="col-sm-2 col-form-label">Username</label>
      
  	  <input type="text" name="username" value="<?php echo $username; ?>">

  	</div>
    <br>
  	<div class="form-group row">
  	  <label class="col-sm-2 col-form-label">Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
      <br>
  	<div class=" form-group row">
  	  <label class="col-sm-2 col-form-label">Password</label>
  	  <input type="password" name="password_1">
  	</div>
      <br>
  	<div class=" form-group row">
  	  <label class="col-sm-2 col-form-label">Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
      <br>
  	<div class="input-group">
  	  <button type="submit" name="reg_user" >Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</div>
</div>
</body>
</html>