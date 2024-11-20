<?php
include('header.php');
?>
<?php
if(isset($_GET['idt']))
{
	$idt = $_GET['idt'];
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

	$usql = "UPDATE `dis_laptop` SET dis_empname='', dis_status='1', dis_returndate='$mydate' WHERE dis_barcode='$idt'";
	$ures = mysqli_query($conn,$usql);
	if($ures == true)
	{
		header('Location:laptop.php?adl=edd');
	}
	else
	{
		echo "<script>alert('Somthing Went Wrong!')</script>";
	}
}
?>
<?php

if(isset($_GET['lapr']))
{
	$lapr = $_GET['lapr'];
	$ky = @$_GET['ky'];

	
	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');

	$vql = "SELECT * FROM `dis_lapreciept` WHERE dis_code='$ky'";
	$vres = mysqli_query($conn,$vql);
	$vnum = mysqli_fetch_array($vres);
	$vsup = $vnum['dis_counter'];
	$vtup = ($vsup-1);

		

	$csql = "UPDATE `dis_lapreciept` SET dis_counter='$vtup' WHERE dis_code='$ky'";
	mysqli_query($conn,$csql);

	$usql = "UPDATE `dis_laptop` SET dis_empname='', dis_status='1', dis_returndate='$mydate' WHERE dis_barcode='$lapr'";
	$ures = mysqli_query($conn,$usql);
	if($ures == true)
	{
		header('Location:laptop.php?adl=detail');
	}
	else
	{
		echo "<script>alert('Somthing Went Wrong!')</script>";
	}

}
?>
<?php

if(isset($_GET['delcod']))
{
	$delcod = $_GET['delcod'];
	$delky = @$_GET['delky'];

	
	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');
	$vql = "SELECT * FROM `dis_lapreciept` WHERE dis_code='$delky'";
	$vres = mysqli_query($conn,$vql);
	$vnum = mysqli_fetch_array($vres);
	$cont = $vnum['dis_quantity'];
	$vcont = ($cont-1);
	$vsup = $vnum['dis_counter'];
	$vtup = ($vsup-1);

		

	$csql = "UPDATE `dis_lapreciept` SET dis_quantity='$vcont', dis_counter='$vtup' WHERE dis_code='$delky'";
	mysqli_query($conn,$csql);

	$usql = "UPDATE `dis_laptop` SET dis_empname='', dis_status='11', dis_returndate='$mydate' WHERE dis_barcode='$delcod'";
	$ures = mysqli_query($conn,$usql);
	if($ures == true)
	{
		header('Location:laptop.php?adl=detail');
	}
	else
	{
		echo "<script>alert('Somthing Went Wrong!')</script>";
	}

}
?>
<?php
	if(isset($_POST['submitdata']))
	{
		$pdate = $_POST['pdate'];
		$vendor = $_POST['vendor'];
		$asstqnty = $_POST['asstqnty'];
		$warrdur = $_POST['warrdur'];
		$remarks = $_POST['remarks'];

		$timdu = $warrdur*365;

		date_default_timezone_set("Asia/Kolkata");
		$mydate = date('Y-m-d');

		$effDate = date('Y-m-d', strtotime("+$timdu days", strtotime($pdate)));

		$vql = "SELECT * FROM `dis_lapreciept`";
		$vres = mysqli_query($conn,$vql);
		$vnum = mysqli_num_rows($vres);
		$vcnt = "LAP1".$vnum;

		$rsql = "INSERT INTO `dis_lapreciept`(`dis_code`, `dis_assets`, `dis_vendor`, `dis_quantity`, `dis_duration`, `dis_remarks`, `dis_uploadby`, `dis_uploadon`, `dis_expirdate`, `dis_status`) VALUES ('$vcnt','Laptop','$vendor','$asstqnty','$warrdur','$remarks','$uname','$mydate','$effDate','1')";
		mysqli_query($conn,$rsql);

		for($i=1;$i<=$asstqnty;$i++)
		{
		$tvql = "SELECT * FROM `dis_laptop`";
		$tvres = mysqli_query($conn,$tvql);
		$tvnum = mysqli_num_rows($tvres);
		$tnvi = $tvnum+1;
		$tvcnt = "L-".$tnvi;

		if($tvnum <= 0)
		{
			
			$alts = "INSERT INTO `dis_laptop`(`dis_code`, `dis_barcode`, `dis_status`) VALUES('$vcnt','L-1','1')";
			
			 mysqli_query($conn,$alts);
			
		}
		else
		{

			$alts = "INSERT INTO `dis_laptop`(`dis_code`, `dis_barcode`, `dis_status`) VALUES ('$vcnt','$tvcnt','1')";
			mysqli_query($conn,$alts);
			
		}
		}
		$nvql = "SELECT dis_barcode FROM `dis_laptop` WHERE dis_code='$vcnt' ORDER BY `dis_sno` ASC LIMIT 1";
		$nvres = mysqli_query($conn,$nvql);
		$nvrow = mysqli_fetch_array($nvres);
		$nvf = $nvrow['dis_barcode'];

		$cvql = "SELECT dis_barcode FROM `dis_laptop` WHERE dis_code='$vcnt' ORDER BY `dis_sno` DESC LIMIT 1";
		$cvres = mysqli_query($conn,$cvql);
		$cvrow = mysqli_fetch_array($cvres);
		$nvs = $cvrow['dis_barcode'];

		$dnsq = "UPDATE `dis_lapreciept` SET dis_codeseries_f='$nvf',dis_codeseries_s='$nvs' WHERE dis_code='$vcnt'";
		$dnres = mysqli_query($conn,$dnsq);

		if($dnres == true)
		{
			header('Location:laptop.php?adl=add');
		}
		else
		{
			echo "<script>alert('Somthing Went Wrong. Try Again!')</script>";
		}
	


}
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>Laptop Inventory</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="laptop.php?adl=add" class="navlink">Laptop Receipt <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="laptop.php?adl=detail" class="navlink">Laptop Details <i class="	fa fa-angle-double-right"></i></a></li>

					</ul>
			</div>
			<div class="fistmenu mt-4">
				<p>IT Inventory</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="laptop.php?adl=edd" class="navlink">IT Receipt <i class="	fa fa-angle-double-right"></i></a></li>
						
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
						<?php
							if(isset($_GET['adl']))
							{
								$adl = $_GET['adl'];
								if($adl == "add")
								{
									?>
									<button class="btn btn-primary float-right" onclick="document.getElementById('stockinvnt').style.display='block'"><i class="fa fa-plus"></i> Inventory</button>
									<?php
								}

							}
						?>
						
					</div>
				</div>

			</div>
			<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					
						<?php
						if(isset($_GET['adl']))
						{
							$adl = $_GET['adl'];
							switch($adl)
							{
								case"edd":
								?>
								<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
                                    <th class="sticky-top">Barcode</th>
									<th class="sticky-top">Entry Date</th>
									<th class="sticky-top">Issue To</th>
									<th class="sticky-top">Assets_Name</th>
									<th class="sticky-top">Action</th>
									<th class="sticky-top">Stock</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$nums = 1;
								$mvql = "SELECT * FROM `dis_laptop` WHERE dis_status='3'";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
									<tr>
										<td><?php echo $nums;?></td>
                                    <td><?php echo $mrow['dis_barcode'];?></td>
										<td><?php echo $mrow['dis_issuedate'];?></td>
										<td><?php echo $mrow['dis_empname'];?></td>
										
										<td><?php echo "Laptop";?></td>
										
										<td><a href="issueit.php?id=<?php echo $mrow['dis_barcode'];?>" class="suppbnt">Issue</a></td>
										<td><a href="laptop.php?idt=<?php echo $mrow['dis_barcode'];?>&ky=<?php echo $mrow['dis_code'];?>" class="histbnt ">Stock</a></td>

										</tr>
									<?php
									$nums++;
								}
								break;
								case"add":
								?>
								<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Entry Date</th>
									<th class="sticky-top" colspan="2">Barcode_Series</th>
									<th class="sticky-top">Assets_Name</th>
									<th class="sticky-top">Vendor_Name</th>
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
								$nums = 1;
								$mvql = "SELECT * FROM `dis_lapreciept`";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
									<tr>
										<td><?php echo $nums;?></td>
										<td><?php echo $mrow['dis_uploadon'];?></td>
										<td class="bgwarn"><?php echo $mrow['dis_codeseries_f'];?></td>
										<td class="bgwarn"><?php echo $mrow['dis_codeseries_s'];?></td>
										<td><?php echo $mrow['dis_assets'];?></td>
										<td><?php echo $mrow['dis_vendor'];?></td>
										
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
										<td><a href="laphis.php?id=<?php echo $mrow['dis_code'];?>" class="histbnt">History</a></td>
										<td><a href="lapsup.php?id=<?php echo $mrow['dis_code'];?>" class="suppbnt">Issue</a></td>

										
										</tr>
									<?php
									$nums++;
								}
								break;
								case"detail":
								?>
								<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Laptop Code</th>
									<th class="sticky-top">Employee ID</th>
									<th class="sticky-top">Full Name</th>
									<th class="sticky-top">Process</th>
									<th class="sticky-top">Designation</th>
									<th class="sticky-top">Laptop Brand</th>
									<th class="sticky-top">Features</th>
									<th class="sticky-top">Serial No</th>
									<th class="sticky-top">Issue Date</th>
									<th class="sticky-top">Return Date</th>
									<th class="sticky-top text-center" colspan="2">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$nums = 1;
								$mvql = "SELECT * FROM `dis_laptop` WHERE dis_status !='11'";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
								<tr>
									<td><?php echo $nums;?></td>
										<td><a href='issueit.php?ids=<?php echo $mrow['dis_barcode'];?>' class='editt'><?php echo $mrow['dis_barcode'];?></a></td>
										<td><?php echo $mrow['dis_empid'];?></td>
										<td><?php echo $mrow['dis_empname'];?></td>
										<td><?php echo $mrow['dis_process'];?></td>
										<td><?php echo $mrow['dis_designation'];?></td>
										
										<td><?php echo $mrow['dis_lapname'];?></td>
										<td><?php echo $mrow['dis_lapfeature'];?></td>
										<td><?php echo $mrow['dis_serialno'];?></td>
										
										<td><?php echo $mrow['dis_issuedate'];?></td>
										<td><?php echo $mrow['dis_returndate'];?></td>
										
											<?php
											if($mrow['dis_status'] == "2")
											{
												?>
												<td>
												<a href="laptop.php?lapr=<?php echo $mrow['dis_barcode'];?>&ky=<?php echo $mrow['dis_code'];?>" class="returnbtn" onclick="return confirm('Are you Sure!')">Return</a></td>
												<?php
											}
											else
											{
												echo "<td></td>";
											}
											?>
											<td><a href="laptop.php?delcod=<?php echo $mrow['dis_barcode'];?>&delky=<?php echo $mrow['dis_code'];?>" class="histbnt" onclick="return confirm('Are you Sure!')">Scrap</a></td>
									</tr>
									<?php
									$nums++;

										}
								break;
								default:
								?>
								<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Laptop Code</th>
									<th class="sticky-top">Employee ID</th>
									<th class="sticky-top">Full Name</th>
									<th class="sticky-top">Process</th>
									<th class="sticky-top">Designation</th>
									<th class="sticky-top">Laptop Brand</th>
									<th class="sticky-top">Features</th>
									<th class="sticky-top">Serial No</th>
									<th class="sticky-top">Issue Date</th>
									<th class="sticky-top">Return Date</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
								$nums = 1;
								$mvql = "SELECT * FROM `dis_laptop`";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
								<tr>
									<td><?php echo $nums;?></td>
										<td><?php echo $mrow['dis_barcode'];?></td>
										<td><?php echo $mrow['dis_empid'];?></td>
										<td><?php echo $mrow['dis_empname'];?></td>
										<td><?php echo $mrow['dis_process'];?></td>
										<td><?php echo $mrow['dis_designation'];?></td>
										
										<td><?php echo $mrow['dis_lapname'];?></td>
										<td><?php echo $mrow['dis_lapfeature'];?></td>
										<td><?php echo $mrow['dis_serialno'];?></td>
										
										<td><?php echo $mrow['dis_issuedate'];?></td>
										<td><?php echo $mrow['dis_returndate'];?></td>
									</tr>
								<?php
								$nums++;
								}
								break;

							}

							
							
						}
						else
						{
							?>
							<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Laptop Code</th>
									<th class="sticky-top">Employee ID</th>
									<th class="sticky-top">Full Name</th>
									<th class="sticky-top">Process</th>
									<th class="sticky-top">Designation</th>
									<th class="sticky-top">Laptop Brand</th>
									<th class="sticky-top">Features</th>
									<th class="sticky-top">Serial No</th>
									<th class="sticky-top">Issue Date</th>
									<th class="sticky-top">Return Date</th>
									
									</tr>
							</thead>
							<tbody>
								<?php
								$nums = 1;
								$mvql = "SELECT * FROM `dis_laptop`";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
									<tr>
									<td><?php echo $nums;?></td>
										<td><?php echo $mrow['dis_barcode'];?></td>
										<td><?php echo $mrow['dis_empid'];?></td>
										<td><?php echo $mrow['dis_empname'];?></td>
										<td><?php echo $mrow['dis_process'];?></td>
										<td><?php echo $mrow['dis_designation'];?></td>
										
										<td><?php echo $mrow['dis_lapname'];?></td>
										<td><?php echo $mrow['dis_lapfeature'];?></td>
										<td><?php echo $mrow['dis_serialno'];?></td>
										
										<td><?php echo $mrow['dis_issuedate'];?></td>
										<td><?php echo $mrow['dis_returndate'];?></td>
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
	<section id="stockinvnt" class="popupform">
		<div class="popform animate">
			
			<form class="" method="post" action="">
							<div class="form-group row">
								<div class="col-md-6 bg-netlin">
									<label>Purchase Date :</label>
									<br>
									<input type="date" name="pdate" class="form-control" required>
								</div>
								<div class="col-md-6">
									<label for="">Name of Vendor* </label>
								<input type="text" name="vendor" class="form-control" placeholder="Vendor Name...">
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