<?php
session_start();
include('config.php');
?>
<?php
if(isset($_POST['subuser']))
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$sql = "SELECT * FROM `dis_oprator` WHERE dis_email='$user' AND dis_pass='$pass'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);
	$_SESSION['uname'] = @$row['dis_name'];
	$_SESSION['uemail'] = @$row['dis_email'];
	$_SESSION['post'] = @$row['dis_post'];
	if($row == true)
	{
		header('Location:inc/dashboard.php');
	}
	else
	{
		$msg = "<div class='alert alert-danger'>Wrong Credential!</div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Silaris IT Inventory</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/gif" href="assets/img/fevicon.png">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
  	<link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
<div class="loginsystem">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="formcott">
					<img src="assets/img/brand-logo.png" class="img-fluid">
				</div>
			
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="formcot">
				<h3>Login</h3>
			<form class="tillfom" method="POST" action="">
			
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="user" class="form-control" required placeholder="Email here...">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="pass" class="form-control" required placeholder="Password...">
			</div>
			<div class="form-group">
				<input type="submit" name="subuser" class="btn btn-dark" value="Submit">
			</div>
		</form>
		<p><?php if(isset($msg)){ echo $msg;} ?></p>
	</div>
		</div>
		</div>
		

	</div>
	<footer>
		<p>Silaris Informations Pvt Ltd &copy; <?php echo date('Y');?> | Only Use For Silaris Internal Server </p>
	</footer>
</div>
<script src="assets/js/jquery.js"></script>
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>