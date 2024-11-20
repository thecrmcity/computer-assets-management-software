<?php
include('header.php');
?>
<?php
if(isset($_POST['addaset']))
{
	$pname = $_POST['pname'];

	$ssl = "INSERT INTO `dis_elecproduct`(`dis_proname`,`dis_status`) VALUES ('$pname','1')";
	$rss = mysqli_query($conn,$ssl);
	if($rss == true)
	{
		header('Location:non-electronic.php?act=create');
	}
}

?>
<?php
if(isset($_POST['submitdata']))
{
	$pdate = $_POST['pdate'];
	$assets = "Non-Electronics";
	$vendor = $_POST['vendor'];
	$vlocation = $_POST['vlocation'];
	$asstqnty = $_POST['asstqnty'];
	$warrdur = $_POST['warrdur'];
	$remarks = $_POST['remarks'];

	$add = $_GET['add'];

	$timdu = $warrdur*365;

	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');

	$effDate = date('Y-m-d', strtotime("+$timdu days", strtotime($pdate)));

	$vql = "SELECT * FROM `dis_electronic` ORDER BY dis_sno DESC LIMIT 1";
	$vres = mysqli_query($conn,$vql);
	$vrow = mysqli_fetch_array($vres);
	$vnum = $vrow['dis_sno'];
	$vnum = ($vnum+1);
	$vcnt = "SIL0".$vnum;


	$sql = "INSERT INTO `dis_electronic`(`dis_code`, `dis_date`, `dis_assets`, `dis_vendor`, `dis_vendorloc`, `dis_quantity`, `dis_duration`, `dis_remarks`, `dis_uploadby`, `dis_uploadon`, `dis_expirdate`, `dis_status`) VALUES ('$vcnt','$pdate','$assets','$vendor','$vlocation','$asstqnty','$warrdur','$remarks','$uname','$mydate','$effDate','1')";
	$res = mysqli_query($conn,$sql);

	
	switch($assets)
	{
		
		case "Non-Electronics":
		for($i=1;$i<=$asstqnty;$i++)
		{
		$tvql = "SELECT * FROM `dis_electronicdata`";
		$tvres = mysqli_query($conn,$tvql);
		$tvnum = mysqli_num_rows($tvres);
		$tnvi = $tvnum+1;
		$tvcnt = "NEL-".$tnvi;

		if($tvnum <= 0)
		{
			
			$alts = "INSERT INTO `dis_electronicdata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`, `dis_psubname`, `dis_status`) VALUES ('$vcnt','NEL-1','$pdate','$effDate','$warrdur','$assets','$remarks','1')";
			mysqli_query($conn,$alts);
		}
		else
		{

			

			$alts = "INSERT INTO `dis_electronicdata`(`dis_code`, `dis_comcode`, `dis_pdate`, `dis_expridate`, `dis_duration`, `dis_pname`, `dis_psubname`,`dis_status`) VALUES ('$vcnt','$tvcnt','$pdate','$effDate','$warrdur','$assets', '$remarks','1')";
			mysqli_query($conn,$alts);
		}
		}
		$nvql = "SELECT dis_comcode FROM `dis_electronicdata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` ASC LIMIT 1";
		$nvres = mysqli_query($conn,$nvql);
		$nvrow = mysqli_fetch_array($nvres);
		$nvf = $nvrow['dis_comcode'];

		$cvql = "SELECT dis_comcode FROM `dis_electronicdata` WHERE dis_code='$vcnt' ORDER BY `dis_sno` DESC LIMIT 1";
		$cvres = mysqli_query($conn,$cvql);
		$cvrow = mysqli_fetch_array($cvres);
		$nvs = $cvrow['dis_comcode'];

		$dnsq = "UPDATE `dis_electronic` SET dis_codeseries_f='$nvf',dis_codeseries_s='$nvs' WHERE dis_code='$vcnt'";
		$dnres = mysqli_query($conn,$dnsq);

		if($res == true AND $dnres == true)
		{
			header('Location:non-electronic.php?act=ent');
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
				<p>Item Creation</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="non-electronic.php?act=create" class="navlink">Create New <i class="	fa fa-angle-double-right"></i></a></li>
						
						
					</ul>
			</div>
			<div class="fistmenu">
				<p>Item Inventory</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="non-electronic.php?act=ent" class="navlink"> Non-Electronics <i class="fa fa-angle-double-right"></i></a></li>

						
						
					</ul>
			</div>
			<div class="fistmenu mt-4">
				<p>Non Electronic</p>
					<ul class="nav flex-column">
						

						<?php
							$sql = "SELECT DISTINCT dis_remarks FROM `dis_electronic` WHERE dis_assets='Non-Electronics'";
							$res = mysqli_query($conn,$sql);
							while($row = mysqli_fetch_array($res))
							{
								?>
								<li class="navitem"><a href="non-electronic.php?act=<?php echo $row['dis_remarks'];?>" class="navlink"> <?php echo $row['dis_remarks'];?> <i class="fa fa-angle-double-right"></i></a></li>
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
			<?php
				if(isset($_GET['act']))
				{
					$act = $_GET['act'];
					switch($act)
					{
						case "ent":
						?>
						<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						<th class="sticky-top">Entry Date</th>
						<th class="sticky-top" colspan="2">Barcode_Series</th>
						<th class="sticky-top">Assets_Name</th>
						<th class="sticky-top">Details</th>
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
						$mvql = "SELECT * FROM `dis_electronic` WHERE dis_assets='Non-Electronics'";
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
								<td><a href="elhistory.php?id=<?php echo $mrow['dis_code'];?>&set=<?php echo 'Non-Electronics';?>" class="histbnt">History</a></td>
								<td><a href="elsupply.php?id=<?php echo $mrow['dis_code'];?>&set=<?php echo 'Non-Electronics';?>" class="suppbnt">Issue</a></td>


							</tr>
							<?php
							$nums++;
						}
					
						?>		
					
					</tbody>
				</table>
			</div>

						<?php
						break;
						case "create":
						?>
						<div class="row">
							
						
						<div class="col-lg-6 col-md-6 mt-4">
							<div class="datacreate">
								<h4 class="text-center">Create Item</h4>
						<form class="" method="POST" action="">

							<div class="form-group">
								<label for="">Name Of Item </label>
								<input type="text" name="pname" class="form-control" required placeholder="Item name...">
							</div>
							<div class="form-group">
								<input type="submit" name="addaset" class="btn btn-dark" value="Submit">
							</div>
						</form>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 mt-4">
							<div class="table-wrapper-scroll-y my-custom-scrollbar">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center text-uppercase">Elctronic Items</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Item Name</th>
									<th class="sticky-top">Status</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
										$pnum = 1;
										$psql = "SELECT * FROM `dis_elecproduct` ORDER BY `dis_proname` DESC";
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
						</div>
						</div>
						<?php
						break;
						default:
						?>
						<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						<th class="sticky-top">Barcode</th>
						<th class="sticky-top">Assets_Name</th>
						<th class="sticky-top">Details</th>
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
						if(isset($_GET['act']))
						{
							$act = $_GET['act'];
						
						$nums = 1;
						$mvql = "SELECT * FROM `dis_alldata` WHERE dis_psubname='$act' AND dis_pname='Non-Electronics'";
						$mvres = mysqli_query($conn,$mvql);
						while($mrow = mysqli_fetch_array($mvres))
						{
							?>
							<tr>
							<td><?php echo $nums;?></td>
								<td><?php echo $mrow['dis_comcode'];?></td>
								<td><?php echo $mrow['dis_pname'];?></td>
								<td><?php echo $mrow['dis_psubname'];?></td>
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
						<?php
						break;
						
					}
				}
				else
				{
					?>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<table class="table table-bordered mb-5">
						
		            	<tr>
                	<td colspan=4 class="text-center bg-dark text-white font-weight-bold">
                		<form method="GET">
                		<select class="" name="est">
                			<option value="" disabled="" selected="">Select Electronic Item</option>
                			<?php
                				$tsql = "SELECT DISTINCT dis_psubname FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics'";
                				$tres = mysqli_query($conn,$tsql);
                				while($trow = mysqli_fetch_array($tres))
                				{
                					?>
                					<option value="<?php echo $trow['dis_psubname'];?>"><?php echo $trow['dis_psubname'];?></option>
                					<?php
                				}
                			?>
                			
                		</select>
                		<input type="submit" value="Search">
                		</form>
                	</td>
                	<td colspan="4" class="text-center bg-dark text-white font-weight-bold">
                		<?php if(isset($_GET['est'])){ echo "<span style='letter-spacing:1px;'>".$_GET['est']."</span>";} ?>
                	</td>
            	</tr>
            	<?php
						$osql = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status IN ('1','2','3')";
					$ores = mysqli_query($conn,$osql);
					$onum = mysqli_num_rows($ores);

					$esql = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status IN ('1')";
					$eres = mysqli_query($conn,$esql);
					$enum = mysqli_num_rows($eres);

					$dsql = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status IN ('2')";
					$dres = mysqli_query($conn,$dsql);
					$dnum = mysqli_num_rows($dres);

					$osqlm = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status IN ('3')";
					$oresm = mysqli_query($conn,$osqlm);
					$onumm = mysqli_num_rows($oresm);

					$ttblan = $enum-$dnum;



					$est = @$_GET['est'];
					$estnt = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status IN ('1','2','3') AND dis_psubname='$est'";
					$estntre = mysqli_query($conn,$estnt);
					$estntnum = mysqli_num_rows($estntre);

					$spl = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status='2' AND dis_psubname='$est'";
					$ospl = mysqli_query($conn,$spl);
					$osnum = mysqli_num_rows($ospl);

					$balq = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status='1' AND dis_psubname='$est'";
					$balrs = mysqli_query($conn,$balq);
					$balnm = mysqli_num_rows($balrs);

					$rpql = "SELECT * FROM `dis_electronicdata` WHERE dis_pname='Non-Electronics' AND dis_status='3' AND dis_psubname='$est'";
					$rprs = mysqli_query($conn,$rpql);
					$rpnm = mysqli_num_rows($rprs);


						?>
				<tr>
					<td class="bg-info font-weight-bold text-white">Inventory</td>
					<td class="bg-info font-weight-bold text-white"><?php if(isset($_GET['est'])){ echo $estntnum;}else{ echo $onum;}?></td>
					<td class="bg-warning font-weight-bold">Supply </td>
					<td class="bg-warning font-weight-bold"><a href="data.php" class="text-dark"><?php if(isset($_GET['est'])){ echo $osnum;}else{echo $dnum;}?> </a></td>
                	<td class="bg-success font-weight-bold text-white">Balance</td>
					<td class="bg-success font-weight-bold text-white"><?php if(isset($_GET['est'])){ echo $balnm;}else{ echo $onum-$dnum;}?></td>
					<td class="bg-danger font-weight-bold text-white">Reparing</td>
					<td class="bg-danger font-weight-bold text-white"><?php if(isset($_GET['est'])){ echo $rpnm;}else{ echo $onumm;}?></td>
					
				</tr>
					</table>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="table-wrapper-scroll-y my-custom-scroll">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center">Branch Wise Data</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Branch Name</th>
									<th class="sticky-top">Total Assets</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
										if(isset($_GET['est']))
										{
											$tnum=1;
												$est = $_GET['est'];
							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_branch FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_psubname='$est' AND dis_status='2' GROUP BY dis_branch";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="branch.php?pro=<?php echo $mrow['dis_branch'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>

								<?php
								$tnum++;
										}
									}
									else
									{
										$tnum=1;
							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_branch FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_status='2' GROUP BY dis_branch";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="branch.php?pro=<?php echo $mrow['dis_branch'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php
								$tnum++;
									}
								}
									?>
								</tbody>
							</table>
						</div>
						<div class="table-wrapper-scroll-y my-custom-scroll mt-4">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center">Location Wise Data</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Location</th>
									<th class="sticky-top">Total Assets</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($_GET['est']))
										{
											$tnum=1;
											$est = $_GET['est'];
							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_location FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_psubname='$est' AND dis_status='2' GROUP BY dis_location";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="location.php?pro=<?php echo $mrow['dis_location'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php
								$tnum++;
							}
						}
						else
						{
							$tnum=1;
							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_location FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_status='2' GROUP BY dis_location";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="location.php?pro=<?php echo $mrow['dis_location'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php
							}
						}
									?>
								</tbody>
							</table>
						</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="table-wrapper-scroll-y my-custom-scrollbar">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr><th colspan="3" class="text-center">Building Wise Data</th></tr>
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Building No.</th>
									<th class="sticky-top">Total Assets</th>
									
									</tr>
								</thead>
								<?php
									if(isset($_GET['est']))
										{
											$tnum=1;
							$est = $_GET['est'];
							$msql = "SELECT COUNT(dis_building) AS nums, dis_building FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_psubname='$est' AND dis_status='2' GROUP BY dis_building";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="building.php?pro=<?php echo $mrow['dis_building'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php
							}
						}
						else
						{
							$tnum=1;
							
							$msql = "SELECT COUNT(dis_building) AS nums, dis_building FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_status='2' GROUP BY dis_building";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
									<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="building.php?pro=<?php echo $mrow['dis_building'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php
								$tnum++;
							}
						}
								?>
								<tbody>
								</tbody>
							</table>
						</div>
						
						</div>
					</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="table-wrapper-scroll-y my-custom-scrollbar">
								<table class="table table-bordered table-striped table-hover">
									<thead class="bgsky">
										<tr><th colspan="3" class="text-center">Process Wise Data</th></tr>
										<tr>
										<th class="sticky-top">S.No.</th>
										<th class="sticky-top">Name of Process</th>
										<th class="sticky-top">Total Assets</th>
										
										</tr>
									</thead>
									<tbody>
										<?php
											if(isset($_GET['est']))
											{
												$tnum=1;
												$est = $_GET['est'];
							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_issueto FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_psubname='$est' AND dis_status='2' GROUP BY dis_issueto";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="process.php?pro=<?php echo $mrow['dis_issueto'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php
								$tnum++;
							}
											}
											else
											{
												$tnum=1;
												$msql = "SELECT COUNT(dis_issueto) AS nums, dis_issueto FROM dis_electronicdata WHERE dis_pname='Non-Electronics' AND dis_status='2' GROUP BY dis_issueto";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="process.php?pro=<?php echo $mrow['dis_issueto'];?>&pd=Non-Electronics" class="tdlink"><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
									<?php
									$tnum++;
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<?php
				}
			?>
			
		</div>
	</div>
<section id="stockinvnt" class="popupform">
		<div class="popform animate">
			<h5 class="stocktxt text-center">Non-Electronics Inventory</h5>
			<form class="" method="post" action="">
							<div class="form-group row">
								<div class="col-md-6 bg-netlin">
									<label>Purchase Date :</label>
									<br>
									<input type="date" name="pdate" class="form-control" required>
								</div>
								<div class="col-md-6">
									<label for="">Select Assets : </label>
									<select class="form-control" name="remarks" required>
                                	<option value="" disabled="" selected="">Select Non-Electronic</option>
                                	<?php
                                		$ctsql = "SELECT * FROM `dis_elecproduct`";
                                		$ctres = mysqli_query($conn,$ctsql);
                                		while($ctrow = mysqli_fetch_array($ctres))
                                		{
                                			?>
                                			<option value="<?php echo $ctrow['dis_proname'];?>"><?php echo $ctrow['dis_proname'];?></option>
                                			<?php
                                		}
                                	?>
                                	
                                </select>
									
									
								
								</div>
								
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="">Name of Company* </label>
								<input type="text" name="vendor" class="form-control" placeholder="Company Name..." required>
								</div>
								<div class="col-md-6">
									<label for="">Comment <small>(additinal Information)</small> </label>
									<input type="text" name="vlocation" class="form-control" placeholder="Comment...">
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