<?php
include('header.php');
?>
<?php
if(isset($_POST['submitdata']))
{
	$pdate = $_POST['pdate'];
	$assets = $_POST['assets'];
	$vendor = $_POST['vendor'];
	$vlocation = $_POST['vlocation'];
	$asstqnty = $_POST['asstqnty'];
	$warrdur = $_POST['warrdur'];
	$remarks = $_POST['remarks'];

	$add = $_GET['add'];

	$timdu = $warrdur*365;

	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d h:i:s');

	$effDate = date('Y-m-d', strtotime("+$timdu days", strtotime($pdate)));

	$vql = "SELECT * FROM `dis_computer` ORDER BY dis_sno DESC LIMIT 1";
	$vres = mysqli_query($conn,$vql);
	$vrow = mysqli_fetch_array($vres);
	$vnum = $vrow['dis_sno'];
	$vnumd = ($vnum + 1);
	$vcnt = "SIL0".$vnumd;


	$sql = "INSERT INTO `dis_computer`(`dis_code`, `dis_date`, `dis_assets`, `dis_vendor`, `dis_vendorloc`, `dis_quantity`, `dis_duration`, `dis_remarks`, `dis_uploadby`, `dis_uploadon`, `dis_expirdate`, `dis_status`) VALUES ('$vcnt','$pdate','$assets','$vendor','$vlocation','$asstqnty','$warrdur','$remarks','$uname','$mydate','$effDate','1')";
	$res = mysqli_query($conn,$sql);

	
	switch($assets)
	{
		case "New Computer Set":
		for($i=1;$i<=$asstqnty;$i++)
		{
		$tvql = "SELECT * FROM `dis_alldata` WHERE dis_pname='New Computer Set'";
		$tvres = mysqli_query($conn,$tvql);
		$tvnum = mysqli_num_rows($tvres);
		$tnvi = $tvnum+1;
		$tvcnt = "S-".$tnvi;

		if($tvnum <= 0)
		{
			
			$alts = "INSERT INTO `dis_alldata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`, `dis_status`) VALUES ('$vcnt','S-1','$pdate','$effDate','$warrdur','$assets' ,'1')";
			mysqli_query($conn,$alts);
		}
		else
		{

			

			$alts = "INSERT INTO `dis_alldata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`,`dis_status`) VALUES ('$vcnt','$tvcnt','$pdate','$effDate','$warrdur','$assets' ,'1')";
			mysqli_query($conn,$alts);
		}
		}
		$nvql = "SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` ASC LIMIT 1";
		$nvres = mysqli_query($conn,$nvql);
		$nvrow = mysqli_fetch_array($nvres);
		$nvf = $nvrow['dis_comcode'];

		$cvql = "SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` DESC LIMIT 1";
		$cvres = mysqli_query($conn,$cvql);
		$cvrow = mysqli_fetch_array($cvres);
		$nvs = $cvrow['dis_comcode'];

		$dnsq = "UPDATE `dis_computer` SET dis_codeseries_f='$nvf',dis_codeseries_s='$nvs' WHERE dis_code='$vcnt'";
		$dnres = mysqli_query($conn,$dnsq);

		if($res == true AND $dnres == true)
		{
			header('Location:receipt.php');
		}
		else
		{
			echo "<script>alert('Somthing Went Wrong. Try Again!')</script>";
		}
		break;
		case "Old Computer Set":
		for($i=1;$i<=$asstqnty;$i++)
		{
		$tvql = "SELECT * FROM `dis_alldata` WHERE dis_pname='Old Computer Set'";
		$tvres = mysqli_query($conn,$tvql);
		$tvnum = mysqli_num_rows($tvres);
		$tnvi = $tvnum+1;
		$tvcnt = "OLD-".$tnvi;

		if($tvnum <= 0)
		{
			
			$alts = "INSERT INTO `dis_alldata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`, `dis_status`) VALUES ('$vcnt','OLD-1','$pdate','$effDate','$warrdur','$assets' ,'1')";
			mysqli_query($conn,$alts);
		}
		else
		{

			

			$alts = "INSERT INTO `dis_alldata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`,`dis_status`) VALUES ('$vcnt','$tvcnt','$pdate','$effDate','$warrdur','$assets' ,'1')";
			mysqli_query($conn,$alts);
		}
		}
		$nvql = "SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` ASC LIMIT 1";
		$nvres = mysqli_query($conn,$nvql);
		$nvrow = mysqli_fetch_array($nvres);
		$nvf = $nvrow['dis_comcode'];

		$cvql = "SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` DESC LIMIT 1";
		$cvres = mysqli_query($conn,$cvql);
		$cvrow = mysqli_fetch_array($cvres);
		$nvs = $cvrow['dis_comcode'];

		$dnsq = "UPDATE `dis_computer` SET dis_codeseries_f='$nvf',dis_codeseries_s='$nvs' WHERE dis_code='$vcnt'";
		$dnres = mysqli_query($conn,$dnsq);

		if($res == true AND $dnres == true)
		{
			header('Location:receipt.php');
		}
		else
		{
			echo "<script>alert('Somthing Went Wrong. Try Again!')</script>";
		}
		break;
		
		default:
		for($i=1;$i<=$asstqnty;$i++)
		{
		$tvql = "SELECT * FROM `dis_alldata` WHERE dis_pname NOT IN ('New Computer Set','Old Computer Set','Software')";
		$tvres = mysqli_query($conn,$tvql);
		$tvnum = mysqli_num_rows($tvres);
		$tnvi = $tvnum+1;
		$tvcnt = "O-".$tnvi;

		if($tvnum <= 0)
		{
			
			$alts = "INSERT INTO `dis_alldata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`, `dis_status`) VALUES ('$vcnt','O-1','$pdate','$effDate','$warrdur','$assets' ,'1')";
			mysqli_query($conn,$alts);
		}
		else
		{

			

			$alts = "INSERT INTO `dis_alldata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`,`dis_status`) VALUES ('$vcnt','$tvcnt','$pdate','$effDate','$warrdur','$assets' ,'1')";
			mysqli_query($conn,$alts);
		}
		}
		$nvql = "SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` ASC LIMIT 1";
		$nvres = mysqli_query($conn,$nvql);
		$nvrow = mysqli_fetch_array($nvres);
		$nvf = $nvrow['dis_comcode'];

		$cvql = "SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` DESC LIMIT 1";
		$cvres = mysqli_query($conn,$cvql);
		$cvrow = mysqli_fetch_array($cvres);
		$nvs = $cvrow['dis_comcode'];

		$dnsq = "UPDATE `dis_computer` SET dis_codeseries_f='$nvf',dis_codeseries_s='$nvs' WHERE dis_code='$vcnt'";
		$dnres = mysqli_query($conn,$dnsq);

		if($res == true AND $dnres == true)
		{
			header('Location:receipt.php');
		}
		else
		{
			echo "<script>alert('Somthing Went Wrong. Try Again!')</script>";
		}
		break;
	}
	

	
}

?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu mb-4">
				<p>Computer Assets</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="receipt.php?add=New Computer Set" class="navlink">New Computer <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="receipt.php?add=Old Computer Set" class="navlink">Old Computer <i class="	fa fa-angle-double-right"></i></a></li>
						
					</ul>
			</div>
			<div class="fistmenu">
				<p>Other Assets</p>
					<ul class="nav flex-column">
						
						<?php
							$sql = "SELECT * FROM `dis_alldata` WHERE dis_status!='9' AND dis_pname NOT IN ('New Computer Set','Old Computer Set','Software') GROUP BY dis_pname";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="othereciept.php?add=<?php echo $row['dis_pname'];?>" class="navlink"><?php echo $row['dis_pname'];?> <i class="	fa fa-angle-double-right"></i></a></li>
							<?php
						}
						?>
					</ul>
			</div>
		</div>
	</div>
	<div class="mainbar">
		<div class="container">
			<div class="row py-3">
				<div class="col-lg-6 col-md-6">
					
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="stock-fm clearfix">
						<button class="btn btn-primary float-right" onclick="document.getElementById('stockinvnt').style.display='block'"><i class="fa fa-plus"></i> Purchase Inventory</button>
					</div>
				</div>

			</div>

			<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						<th class="sticky-top">Entry Date</th>
						<th class="sticky-top" colspan="2">Barcode_Series</th>
						<th class="sticky-top">Assets_Name</th>
						<th class="sticky-top">Vendor_Name</th>
						<th class="sticky-top">PO_Number</th>
						<th class="sticky-top">Warranty</th>
						<th class="sticky-top">Inventory</th>
						<th class="sticky-top">Supply</th>
						<th class="sticky-top">Balance</th>
						<th class="sticky-top">History</th>
						<th class="sticky-top">Action</th>
						
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET['add']))
						{

							$add = $_GET['add'];
						$nums = 1;
						$mvql = "SELECT * FROM `dis_computer` WHERE dis_assets='$add' AND dis_status!='10'";
						$mvres = mysqli_query($conn,$mvql);
						while($mrow = mysqli_fetch_array($mvres))
						{
							?>
							<tr>
								<td><?php echo $nums;?></td>
								<td><?php echo $mrow['dis_date'];?></td>
								<td class="bgwarn"><?php echo $mrow['dis_codeseries_f'];?></td>
								<td class="bgwarn"><?php echo $mrow['dis_codeseries_s'];?></td>
								<td><?php echo $mrow['dis_assets'];?></td>
								<td><?php echo $mrow['dis_vendor'];?></td>
								<td><?php echo $mrow['dis_vendorloc'];?></td>
								<td><?php echo $mrow['dis_duration']."yrs";?></td>
								<td><?php echo $mrow['dis_quantity'];?></td>
								<td><?php echo $mrow['dis_counter'];?></td>
								<td><?php 
								$fst = $mrow['dis_quantity'];
								$lst = $mrow['dis_counter'];
								if($lst === "")
								{
									echo $fst;
								}
								else
								{
									echo $fst-$lst;
								}
								?></td>
								<td><a href="history.php?id=<?php echo $mrow['dis_code'];?>&set=<?php echo $add;?>" class="histbnt">History</a></td>
								<td><a href="osupply.php?id=<?php echo $mrow['dis_code'];?>&set=<?php echo $add;?>" class="suppbnt">Issue</a></td>


							</tr>
							<?php
							$nums++;
						}

					}
					else
					{

						$nums = 1;
						$mvql = "SELECT * FROM `dis_computer` WHERE dis_assets='New Computer Set'";
						$mvres = mysqli_query($conn,$mvql);
						while($mrow = mysqli_fetch_array($mvres))
						{
							?>
							<tr>
							<td><?php echo $nums;?></td>
								<td><?php echo $mrow['dis_date'];?></td>
								<td class="bgwarn"><?php echo $mrow['dis_codeseries_f'];?></td>
								<td class="bgwarn"><?php echo $mrow['dis_codeseries_s'];?></td>
								<td><?php echo $mrow['dis_assets'];?></td>
								<td><?php echo $mrow['dis_vendor'];?></td>
								<td><?php echo $mrow['dis_vendorloc'];?></td>
								<td><?php echo $mrow['dis_duration']."yrs";?></td>
								<td><?php echo $mrow['dis_quantity'];?></td>
								<td><?php echo $mrow['dis_counter'];?></td>
								<td><?php 
								$fst = $mrow['dis_quantity'];
								$lst = $mrow['dis_counter'];
								if($lst === "")
								{
									echo $fst;
								}
								else
								{
									echo $fst-$lst;
								}
								?></td>
								<td><a href="history.php?id=<?php echo $mrow['dis_code'];?>&set=<?php echo 'New%20Computer%20Set';?>" class="histbnt">History</a></td>
								<td><a href="osupply.php?id=<?php echo $mrow['dis_code'];?>&set=<?php echo 'New%20Computer%20Set';?>" class="suppbnt">Issue</a></td>


							</tr>
							<?php
						}
					}
						?>		
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
<section id="stockinvnt" class="popupform">
		<div class="popform animate">
			<h5 class="stocktxt">Purchase Inventory</h5>
			<form class="" method="post" action="">
							<div class="form-group row">
								<div class="col-md-6 bg-netlin">
									<label>Purchase Date :</label>
									<br>
									<input type="date" name="pdate" class="form-control" required>
								</div>
								<div class="col-md-6">
									<label for="">Select Assets : </label>
									<select class="form-control" name="assets" required>
										<option value="" disabled="" selected="">Select Assets</option>
										<option value="New Computer Set">New Computer Set</option>
										<option value="Old Computer Set">Old Computer Set</option>
										<?php
											$sql = "SELECT * FROM `dis_products` WHERE dis_proname!='Software' GROUP BY dis_proname";
											$res = mysqli_query($conn,$sql);
											while($row = mysqli_fetch_array($res))
											{
												?>
												<option value="<?php echo $row['dis_proname'];?>"><?php echo $row['dis_proname'];?></option>
												
												<?php
											}
											?>

									</select>
									
									
								
								</div>
								
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="">Name of Vendor* </label>
								<input type="text" name="vendor" class="form-control" placeholder="Vendor Name..." required>
								</div>
								<div class="col-md-6">
									<label for="">PO Number <small>(Optional)</small> </label>
									<input type="text" name="vlocation" class="form-control" placeholder="Vendor Location...">
								</div>
								
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="">Assets Quantity </label>
									<input type="number" name="asstqnty" class="form-control" required>
								</div>
								<div class="col-md-6">
									<label for="">Warranty Duration</small></label>
									<input type="number" name="warrdur" class="form-control" required>
								</div>
							
							</div>
							<div class="form-group">
								<label for="">Remark <small>(Optional)</small></label>
                                <textarea class="form-control" name="remarks" placeholder="Any Comments..."></textarea>
							</div>
							<div class="form-group">
								
								
								<input type="submit" name="submitdata" class="btn btn-dark" value="Submit">
					<button class="btn btn-danger" onclick="document.getElementById('stockinvnt').style.display='none'">Close</button>
							</div>
						</form>
			
		</div>
	</section>
</div>
<?php
include('footer.php');
?>