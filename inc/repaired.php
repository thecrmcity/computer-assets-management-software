<?php
include('header.php');
?>
<?php
if(isset($_GET['rep']))
{

	$rep = $_GET['rep'];

	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');
	

	$esql = "UPDATE `dis_alldata` SET dis_status='1' WHERE dis_comcode='$rep'";
	$eres = mysqli_query($conn,$esql);
	if($eres == true)
	{
		header('Location:repaired.php');
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
						<th class="sticky-top">Assets</th>
						
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
								$sql = "SELECT * FROM `dis_alldata` WHERE dis_status='5'";
								$res = mysqli_query($conn,$sql);
								while($mrow = mysqli_fetch_array($res))
								{
									?>
									<tr>
								<td><?php echo $nums;?></td>
								<td><?php echo $mrow['dis_comcode'];?></td>
								<td><?php echo $mrow['dis_pname'];?></td>
								
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
											case "5":
											echo '<span class="sefire">Repaired</span>';
											break;
										}
										
									?>
									</td>
									<td><a href="repaired.php?rep=<?php echo $mrow['dis_comcode'];?>" class="return">Done</a></td>
									
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