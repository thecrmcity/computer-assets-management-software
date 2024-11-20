<?php
include('header.php');
?>
<?php

if(isset($_GET['lapr']))
{
	$lapr = $_GET['lapr'];
	$ky = $_GET['ky'];

	
	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');

	$vql = "SELECT * FROM `dis_lapreciept` WHERE dis_code='$ky'";
	$vres = mysqli_query($conn,$vql);
	$vnum = mysqli_fetch_array($vres);
	$vsup = $vnum['dis_counter'];
	$vtup = ($vsup-1);

	$csql = "UPDATE `dis_lapreciept` SET dis_counter='$vtup' WHERE dis_code='$ky'";
	mysqli_query($conn,$csql);

	$usql = "UPDATE `dis_laptop` SET dis_empname='', dis_empid='',dis_process='',dis_status='1', dis_returndate='$mydate',dis_designation='' WHERE dis_barcode='$lapr'";
	$ures = mysqli_query($conn,$usql);
	if($ures == true)
	{
		header('Location:laphis.php?id='.$ky);
	}
	else
	{
		echo "<script>alert('Somthing Went Wrong!')</script>";
	}

}
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			
		</div>
	</div>
	<div class="mainbar">
		<div class="container mt-5">
			<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						<th class="sticky-top">System Code</th>
						<th class="sticky-top">Employee ID</th>
						<th class="sticky-top">Full Name</th>
                        <th class="sticky-top">Brand</th>
						<th class="sticky-top">Designation</th>
						
						<th class="sticky-top">Features</th>
						<th class="sticky-top">Serial_Number</th>
						<th class="sticky-top">Issue Date</th>
						<th class="sticky-top">Return Date</th>
						<th class="sticky-top">Remarks</th>
						<th class="sticky-top">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET['id']))
						{

				$id = $_GET['id'];
				

				$nums = 1;
				$mvql = "SELECT * FROM `dis_laptop` WHERE dis_code='$id'";
				$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
								<tr>
									<td><?php echo $nums;?></td>
									
									<?php
									$netv = $mrow['dis_status'];
									switch($netv)
									{
										case "1":
										echo '<td class="bg-success text-white text-center">'.$mrow['dis_barcode'].'</td>';
										break;
										case "3":
										echo '<td class="bg-warning text-center">'.$mrow['dis_barcode'].'</td>';
										break;
										default:
										echo '<td class="bg-danger text-white text-center">'.$mrow['dis_barcode'].'</td>';
									}
									

									?>
									<td><?php echo $mrow['dis_empid'];?></td>
									<td><?php echo $mrow['dis_empname'];?></td>
									<td><?php echo $mrow['dis_lapname'];?></td>
									<td><?php echo $mrow['dis_designation'];?></td>
									<td><?php echo $mrow['dis_lapfeature'];?></td>
									<td><?php echo $mrow['dis_serialno'];?></td>
									<td><?php echo $mrow['dis_issuedate'];?></td>
									<td><?php echo $mrow['dis_returndate'];?></td>
									<td><?php echo $mrow['dis_remarks'];?></td>
									<?php
											if($mrow['dis_status'] == "2")
											{
												?>
									<td><a href="laphis.php?lapr=<?php echo $mrow['dis_barcode'];?>&ky=<?php echo $mrow['dis_code'];?>" class="return">Return</a></td>
									<?php
											}
											else
											{
												echo "<td></td>";
											}
											?>

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