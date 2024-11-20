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

	$mst = "SELECT dis_counter FROM dis_computer WHERE dis_code='$ids'";
	$mres = mysqli_query($conn,$mst);
	$mrow = mysqli_fetch_array($mres);
	$mt = $mrow['dis_counter'];
	$st = ($mt-1);

	$pts = "UPDATE dis_computer SET  dis_counter='$st' WHERE dis_code='$ids'";
	mysqli_query($conn,$pts);

	$upts = "UPDATE `dis_alldata` SET dis_issueto='',dis_building='',dis_location='',dis_branch='', dis_duck='$mydate', dis_status='5' WHERE dis_comcode='$rep'";
	$upres = mysqli_query($conn,$upts);
	if($upres == true)
	{
		header('Location:dashboard.php');
	}

}

?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			
		</div>
	</div>
	<div class="mainbar">
		
		<div class="container">
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
									<th class="sticky-top">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								
								$nums =1;
								$sql = "SELECT * FROM `dis_alldata` WHERE dis_status='7'";
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
										<a href="accept.php?rep=<?php echo $mrow['dis_comcode'];?>&ids=<?php echo $mrow['dis_code']?>" class="aeturn">OK</a>
											
											
											
									</td>
									
							</tr>
							<?php
							$nums++;

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