<?php
include('header.php');
?>
<?php
if(isset($_POST['savetab']))
{
	$cancode = implode(',', $_POST['cancode']);
	$cancode = explode(',',$cancode);

	$asset = implode(',', $_POST['asset']);
	$asset = explode(',',$asset);

	$veltr = array_combine($cancode,$asset);
	foreach($veltr as $val => $eval)
	{
		$etvl = "UPDATE `dis_alldata` SET dis_status='7' WHERE dis_comcode='$val'";
		mysqli_query($conn,$etvl);

		$emat = "SELECT dis_comcode FROM `dis_alldata` WHERE dis_pname ='$eval' AND dis_status='1' LIMIT 1";
		$eras = mysqli_query($conn,$emat);
		$erow = mysqli_fetch_array($eras);
		$erw = $erow['dis_comcode'];
		$ern = $erow['dis_code'];

		$wet = "SELECT dis_counter FROM `dis_computer` WHERE dis_code='$ern'";
		$wrs = mysqli_query($conn,$wet);
		$srs = mysqli_fetch_array($wrs);
		$setd = $srs['dis_counter'];
		$netd = ($setd-1);

		$stvl = "UPDATE `dis_computer` SET dis_counter='$netd' WHERE dis_comcode='$erw'";
		mysqli_query($conn,$stvl);

		$rist = "UPDATE `dis_repair` SET dis_status='0' WHERE dis_barcode='$val'";
		mysqli_query($conn,$rist);

		$dtvl = "UPDATE `dis_alldata` SET dis_status='2' WHERE dis_comcode='$erw'";
		$etdd = mysqli_query($conn,$dtvl);
		if($etdd == true)
		{
			header('Location:dashboard.php');
		}
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
			<form class="" method="POST" action="">
			<div class="table-wrapper-scroll-y my-custom-scrollbar mt-5">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						<th class="sticky-top">Request Item</th>
						<th class="sticky-top">Barcode</th>
						<th class="sticky-top">Assets Name</th>
						<th class="sticky-top">Process</th>
						<th class="sticky-top">Building</th>
						<th class="sticky-top">Location</th>
						<th class="sticky-top">Branch</th>
						<th class="sticky-top">Issue Date</th>
						<th class="sticky-top">Repair No</th>
						<th class="sticky-top">Repair In</th>
						<th class="sticky-top"><div class="custom-control custom-switch"><input type="checkbox" name="" value="" class="chk_all custom-control-input" id="switch1"><label class="custom-control-label" for="switch1"> </label> </div></th>
						
						</tr>
					</thead>
					<tbody>
						<?php
							$num =1;
							$sql = "SELECT * FROM `dis_repair` WHERE dis_status='1'";
							$res = mysqli_query($conn,$sql);
							while($row = mysqli_fetch_array($res))
							{
								?>
								<tr>
									<td><?php echo $num;?></td>
									<td class="bg-warning">
									<input type="hidden" name="asset[]" class="chk_me" value="<?php echo $row['dis_requiredset'];?>">
										<?php echo $row['dis_requiredset'];?></td>
									<td><?php echo $row['dis_barcode'];?></td>
									<td><?php echo $row['dis_pname'];?></td>
									<td><?php echo $row['dis_issueto'];?></td>
									<td><?php echo $row['dis_building'];?></td>
									<td><?php echo $row['dis_location'];?></td>
									<td><?php echo $row['dis_branch'];?></td>
									<td><?php echo $row['dis_issuedate'];?></td>
									<td><?php echo $row['dis_counter'];?></td>
									<td><?php echo $row['dis_reprairon'];?></td>
									<td><input type="checkbox" name="cancode[]" class="chk_me" value="<?php echo $row['dis_barcode'];?>"></td>
								</tr>	
								<?php
								$num++;
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="clearfix mt-3">
					
					<input type="submit" name="savetab" class="btn btn-primary ml-4 float-right">
				
			</div>
			</form>
		</div>
	</div>

</div>

<?php
include('footer.php');
?>