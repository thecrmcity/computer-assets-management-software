<?php
include('header.php');
?>
<?php
if(isset($_POST['change']))
{
	$cpass = $_POST['cpass'];
	$npass = $_POST['npass'];
	$ppass = $_POST['ppass'];

	$sql = "SELECT * FROM `dis_oprator` WHERE dis_email='$uemail'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);
	if($row['dis_pass'] == $cpass)
	{
		if($row['dis_pass'] == $npass)
		{
			$msg = "<div class='alert alert-danger'>Password Same with Current Password! Please Change</div>";
		}
		else
		{
			if($npass == $ppass)
			{
				$tql = "UPDATE `dis_oprator` SET dis_pass='$npass' WHERE dis_email='$uemail'";
				$trs = mysqli_query($conn,$tql);
				if($trs == true)
				{
					header('Location:change.php');
				}
			}
			else
			{
				$msg = "<div class='alert alert-danger'>Password Not Match with New Password! Please Same</div>";
			}
		}
	}
	else
	{
		$msg = "<div class='alert alert-danger'>Current Password Not Correct!</div>";
	}
}
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>User Details</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="profile.php" class="navlink">User Profile</a></li>
						<li class="navitem"><a href="change.php" class="navlink">Change Password</a></li>
						
					</ul>
			</div>
		</div>
	</div>
	<div class="mainbar">
		<div class="container">
			<div class="row">
			<div class="col-lg-6 col-md-6 mt-5">
				<div class="userpass">
					<form class="" method="POST">
						<div class="form-group row">
							<div class="col-lg-6 col-md-6">
								<label>Current Password</label>
							</div>
							<div class="col-lg-6 col-md-6">
								<input type="password" name="cpass" placeholder="Current Password..." required class="form-control">
							</div>
							
							
						</div>
						<div class="form-group row">
							<div class="col-lg-6 col-md-6">
								<label>New Password</label>
							</div>
							<div class="col-lg-6 col-md-6">
								<input type="password" name="npass" placeholder="New Password..." required class="form-control">
							</div>

							
							
						</div>
						<div class="form-group row">
							<div class="col-lg-6 col-md-6">
								<label>Confirm Password</label>
							</div>
							<div class="col-lg-6 col-md-6">
								<input type="password" name="ppass" placeholder="Confirm Password..." required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="change" value="Change Password" class="btn btn-dark">
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 mt-5">
				<div class="messg">
					<?php if(isset($msg)){ echo $msg;}?>
				</div>
			</div>
		</div>
		</div>
	</div>

</div>
<?php
include('footer.php');
?>