<?php
include('header.php');
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
			<div class="col-lg-6 col-md-6 mt-5">
				<div class="userpro">
					<table>
						<tr>
							<th>User Full Name</th>
							<td></td>
						</tr>

						<tr>
							<th>User Email</th>
							<td></td>
						</tr>
						<tr>
							<th>Currect Password</th>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<th>User Status</th>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
<?php
include('footer.php');
?>