<?php
include('header.php');
?>

<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>Data Filter</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="dashboard.php" class="navlink">All Computer</a></li>
						<?php
							$sql = "SELECT * FROM `dis_computer` GROUP BY dis_assets";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="dashboard.php?p=<?php echo $row['dis_assets'];?>" class="navlink"><?php echo $row['dis_assets'];?></a></li>
							<?php
						}
						?>
						
					</ul>
			</div>
		</div>
	</div>
	<div class="mainbar">
		<div class="container">
			<form class="" method="POST" action="functions.php">
		<div class="table-wrapper-scroll-y my-custom-scrollbar mt-4">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						
						<th class="sticky-top">Barcode</th>
						<th class="sticky-top">Process</th>
						<th class="sticky-top">Building</th>
						<th class="sticky-top">Location</th>
						<th class="sticky-top">Branch</th>
						<th class="sticky-top">Issue Date</th>
						<th class="sticky-top">Repair No</th>
						<th class="sticky-top">Repair In</th>
						<th class="sticky-top">Repair Out</th>
						<th class="sticky-top">Status</th>
						
						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($_GET['pro']) AND isset($_GET['pd']))
							{
								$pro = $_GET['pro'];
								$pd = $_GET['pd'];
								$nums =1;
								
								$sql = "SELECT * FROM `dis_alldata` WHERE dis_branch='$pro' AND dis_pname='$pd' AND dis_status='2'";
								$res = mysqli_query($conn,$sql);
								while($mrow = mysqli_fetch_array($res))
								{
									?>
									<tr>
								<td><?php echo $nums;?></td>
								
								<td><?php echo $mrow['dis_comcode'];?></td>
								<td><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['dis_issuedate'];?></td>
								<td><?php echo $mrow['dis_counter'];?></td>
								<td><?php echo $mrow['dis_repairon'];?></td>
								<td><?php echo $mrow['dis_duck'];?></td>
								
								<td>
									<?php
										switch($mrow['dis_status'])
										{
											case "2":
											echo '<span class="refire">Working</span>';
											break;
											case "3":
											echo '<span class="tefire">Repairing</span>';
											break;
										}
										
									?>
									</td>
									
							</tr>
									<?php
									$nums++;
								}
							}
							else
							{
								$nums =1;
								$pro = $_GET['pro'];
								$sql = "SELECT * FROM `dis_alldata` WHERE dis_pname in ('New Computer Set','Old Computer Set') AND dis_branch='$pro' AND dis_status='2'";
								$res = mysqli_query($conn,$sql);
								while($mrow = mysqli_fetch_array($res))
								{
								?>
								<tr>
								<td><?php echo $nums;?></td>
								
								<td><?php echo $mrow['dis_comcode'];?></td>
								<td><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['dis_issuedate'];?></td>
								<td><?php echo $mrow['dis_counter'];?></td>
								<td><?php echo $mrow['dis_repairon'];?></td>
								<td><?php echo $mrow['dis_duck'];?></td>
								
								<td>
									<?php
										switch($mrow['dis_status'])
										{
											case "2":
											echo '<span class="refire">Working</span>';
											break;
											case "3":
											echo '<span class="refire">Repairing</span>';
											break;
										}
										
									?>
									</td>
									
							</tr>
								<?php
							$nums++;
								}
							}
						?>
						
					</tbody>
				</table>
			</div>
			
		</form>
		</div>
	</div>
</div>


<?php
include('footer.php');
?>