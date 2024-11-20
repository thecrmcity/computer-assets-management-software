<?php
include('header.php');
?>
<?php
if(isset($_GET['rep']))
{
	$rep = $_GET['rep'];
	$ids = $_GET['ids'];

	date_default_timezone_set("Asia/Kolkata");
  	$mydate = date('Y-m-d');

	$upts = "UPDATE `dis_alldata` SET dis_issueto='',dis_building='',dis_location='',dis_branch='', dis_duck='$mydate', dis_status='5' WHERE dis_comcode='$rep'";
	$upres = mysqli_query($conn,$upts);
	if($upres == true)
	{
		header('Location:repair.php');
	}

}

?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>Repairing Data</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="repair.php" class="navlink">Dashboard <i class="fa fa-angle-double-right" ></i></a></li>
						<?php
							$sql = "SELECT * FROM `dis_computer` WHERE dis_assets IN('New Computer Set','Old Computer Set') GROUP BY dis_assets";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="repair.php?p=<?php echo $row['dis_assets'];?>" class="navlink"><?php echo $row['dis_assets'];?> <i class="	fa fa-angle-double-right"></i></a></li>
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
				<div class="col-lg-12">
					
							<?php
							if(!isset($_GET['p']))
							{
								?>
								<div class="table-wrapper-scroll-y my-custom-scrollbar mt-4">
									<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Item Name</th>
									<th class="sticky-top">Quantity</th>
									<th class="sticky-top">Action</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
									$num = 1;
							$sql = "SELECT count(dis_pname) AS pnum, dis_pname FROM `dis_alldata` WHERE dis_status='3' GROUP BY dis_pname";
							$res = mysqli_query($conn,$sql);
							while($row = mysqli_fetch_array($res))
							{
								?>
								<tr>
									<td><?php echo $num;?></td>
									<td><?php echo $row['pnum'];?></td>
									<td><?php echo $row['dis_pname'];?></td>
									
									<td><a href="repair.php?p=<?php echo $row['dis_pname'];?>" class="navlink">Show <i class="fa fa-angle-double-right"></i></a></td>
								</tr>
								
								<?php
								$num++;
							}
							?>
								</tbody>
						</table>
					</div>
								<?php
							}
							?>
							
							
				</div>
			</div>
		</div>
		<div class="container">
			<div class="table-wrapper-scroll-y my-custom-scrollbar mt-4">
				<table class="table table-bordered table-striped table-hover">
					
						<?php
							if(isset($_GET['p']))
							{
								?>
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
									<th class="sticky-top">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$pro = $_GET['p'];
								$nums =1;
								$sql = "SELECT * FROM `dis_alldata` WHERE dis_pname='$pro' AND dis_status IN ('3','4')";
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
											echo '<span class="defire">Repairing</span>';
											break;
											case "4":
											echo '<span class="tefire">Request</span>';
											break;
											case "7":
											echo '<span class="gefire">Accept</span>';
											break;
										}
										
									?>
									</td>
									<td>
										<a href="repair.php?rep=<?php echo $mrow['dis_comcode'];?>&ids=<?php echo $mrow['dis_code']?>" class="return">Action</a>
											
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
		</div>
	</div>

</div>
<?php
include('footer.php');
?>