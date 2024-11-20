<?php
include('header.php');
?>
<?php
if(isset($_POST['addpro']))
{
	$pro = strtoupper($_POST['pro']);

	$sql = "INSERT INTO `dis_process`(`dis_proname`, `dis_status`) VALUES ('$pro','1')";
	$res = mysqli_query($conn,$sql);
	if($res == true)
	{
		header('Location:assets.php');
	}
	else
	{
		echo "<script>alert('Something Went Wrong!');</script>";
	}
}

?>
<?php
if(isset($_POST['addaset']))
{
	$pname = $_POST['pname'];

	$ssl = "INSERT INTO `dis_products`(`dis_proname`,`dis_status`) VALUES ('$pname','1')";
	$rss = mysqli_query($conn,$ssl);
	if($rss == true)
	{
		header('Location:assets.php');
	}
}

?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu mb-4">
				<p>Process</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="assets.php?ir=process" class="navlink">Create New <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="assets.php?ir=prolist" class="navlink">Process List <i class="	fa fa-angle-double-right"></i></a></li>
						
					</ul>
			</div>
			<div class="fistmenu mb-4">
				<p>Assets</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="assets.php?ir=assets" class="navlink">Create New <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="assets.php?ir=asslist" class="navlink">Assets List <i class="	fa fa-angle-double-right"></i></a></li>
						
					</ul>
			</div>
			<div class="fistmenu">
				<p>Resources</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="assets-data.php" class="navlink">All Assets <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="assets-data.php?show=New Computer Set" class="navlink">New Computer <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="assets-data.php?show=Old Computer Set" class="navlink">Old Computer <i class="	fa fa-angle-double-right"></i></a></li>
						<?php
							$sql = "SELECT * FROM `dis_products` GROUP BY dis_proname";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="assets-data.php?show=<?php echo $row['dis_proname'];?>" class="navlink"><?php echo $row['dis_proname'];?> <i class="	fa fa-angle-double-right"></i></a></li>
							<?php
						}
						?>
					</ul>
			</div>
		</div>
	</div>
	<div class="mainbar">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 mt-4">
					<div class="datacreate">
				<?php
				if(isset($_GET['ir']))
				{
					$ir = $_GET['ir'];
					switch($ir)
					{
						case "process":
						?>
						<h4 class="text-center">Create Process</h4>
						<form class="" method="POST" action="">

							<div class="form-group">
								<label for="">Name Of Process </label>
								<input type="text" name="pro" class="form-control" required placeholder="Process...">
							</div>
							<div class="form-group">
								<input type="submit" name="addpro" class="btn btn-dark" value="Submit">
							</div>
						</form>
						<?php
						break;
						case "assets":
						?>
						<h4 class="text-center">Create Assets</h4>
						<form class="" method="POST" action="">

							<div class="form-group">
								<label for="">Name Of Assets </label>
								<input type="text" name="pname" class="form-control" required placeholder="Assets...">
							</div>
							<div class="form-group">
								<input type="submit" name="addaset" class="btn btn-dark" value="Submit">
							</div>
						</form>
						<?php
						break;
						default:
						break;
					}
				}
				?>
			</div>
				</div>
				
				<div class="col-lg-6 col-md-6 mt-4">
					
					<?php
				if(isset($_GET['ir']))
				{
					$ir = $_GET['ir'];
					switch($ir)
					{
						case "process":
						?>
						
						<div class="table-wrapper-scroll-y my-custom-scrollbar">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center text-uppercase">Last 3 Created Process</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Process Name</th>
									<th class="sticky-top">Status</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
										$pnum = 1;
										$psql = "SELECT * FROM `dis_process` ORDER BY `dis_proname` DESC LIMIT 3";
										$pres = mysqli_query($conn,$psql);
										while($prow = mysqli_fetch_array($pres))
										{
											?>
											<tr>
											<td><?php echo $pnum;?></td>
											<td><?php echo $prow['dis_proname'];?></td>
											<td><?php if($prow['dis_status'] == "1"){ echo "<span class='refire'>Active</span>";}else{ echo "<span class='defire'>Disable</span>";}?></td>
										</tr>
											<?php
											$pnum++;
										}
									?>
								</tbody>
							</table>
						</div>
						<?php
						break;
						
						case "prolist":
						?>
						
						<div class="table-wrapper-scroll-y my-custom-scrollbar">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center text-uppercase">Created Process Table</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Process Name</th>
									<th class="sticky-top">Status</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
										$pnum = 1;
										$psql = "SELECT * FROM `dis_process` ORDER BY `dis_proname` DESC";
										$pres = mysqli_query($conn,$psql);
										while($prow = mysqli_fetch_array($pres))
										{
											?>
											<tr>
											<td><?php echo $pnum;?></td>
											<td><?php echo $prow['dis_proname'];?></td>
											<td><?php if($prow['dis_status'] == "1"){ echo "<span class='refire'>Active</span>";}else{ echo "<span class='defire'>Disable</span>";}?></td>
										</tr>
											<?php
											$pnum++;
										}
									?>
								</tbody>
							</table>
						</div>
						<?php
						break;
						case "asslist":
						?>
						
						<div class="table-wrapper-scroll-y my-custom-scrollbar">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center text-uppercase">Created Assets Table</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Process Name</th>
									<th class="sticky-top">Status</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
										$pnum = 1;
										$psql = "SELECT * FROM `dis_products` ORDER BY `dis_proname` DESC";
										$pres = mysqli_query($conn,$psql);
										while($prow = mysqli_fetch_array($pres))
										{
											?>
											<tr>
											<td><?php echo $pnum;?></td>
											<td><?php echo $prow['dis_proname'];?></td>
											<td><?php if($prow['dis_status'] == "1"){ echo "<span class='refire'>Active</span>";}else{ echo "<span class='defire'>Disable</span>";}?></td>
										</tr>
											<?php
											$pnum++;
										}
									?>
								</tbody>
							</table>
						</div>
						<?php
						break;
						case "assets":
						?>
						
						<div class="table-wrapper-scroll-y my-custom-scrollbar">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center text-uppercase">Created 3 Assets</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Assets Name</th>
									<th class="sticky-top">Status</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
										$pnum = 1;
										$psql = "SELECT * FROM `dis_products` ORDER BY `dis_proname` DESC";
										$pres = mysqli_query($conn,$psql);
										while($prow = mysqli_fetch_array($pres))
										{
											?>
											<tr>
											<td><?php echo $pnum;?></td>
											<td><?php echo $prow['dis_proname'];?></td>
											<td><?php if($prow['dis_status'] == "1"){ echo "<span class='refire'>Active</span>";}else{ echo "<span class='defire'>Disable</span>";}?></td>
										</tr>
											<?php
											$pnum++;
										}
									?>
								</tbody>
							</table>
						</div>
						<?php
						break;
					}
				}
				?>
					
				</div>
				
			</div>
			
		</div>
	</div>

</div>
<?php
include('footer.php');
?>