<?php
include('header.php');
?>
<?php

function dateDiffInDays($date1, $date2) 
{
	$diff = strtotime($date2) - strtotime($date1);
	return abs(round($diff / 86400));
}

if(isset($_POST['serversub']))
{
	$srvname = $_POST['srvname'];
	$ipdetail = $_POST['ipdetail'];
	$serialno = $_POST['serialno'];
	$make = $_POST['make'];
	$model1 = $_POST['model1'];
	$model2 = $_POST['model2'];
	$servicetag = $_POST['servicetag'];
	$build = $_POST['build'];
	$location = $_POST['location'];
	$branch = $_POST['branch'];
	$shipdate = $_POST['shipdate'];
	$warnty = $_POST['warnty'];
	$ram = $_POST['ram'];
	$hardisk1 = $_POST['hardisk1'];
	$hardisk2 = $_POST['hardisk2'];
	$shardisk1 = $_POST['shardisk1'];
	$shardisk2 = $_POST['shardisk2'];
	$prodetal = $_POST['prodetal'];
	$core = $_POST['core'];
	$bios = $_POST['bios'];
	$os1 = $_POST['os1'];
	$os2 = $_POST['os2'];
	$os = $os1." ".$os2;
	$msoffice = $_POST['msoffice'];
	$antivirus = $_POST['antivirus'];
	$iperius = $_POST['iperius'];

	date_default_timezone_set("Asia/Kolkata");
  	$mydate = date('Y-m-d');

  	$timdu = $warnty*365;
  	$effDate = date('Y-m-d', strtotime("+$timdu days", strtotime($shipdate)));

  	$sql = "INSERT INTO `dis_server`(`dis_servername`, `dis_ipdetails`, `dis_serialnum`, `dis_make`, `dis_model1`, `dis_model2`, `dis_servicestag`, `dis_building`, `dis_location`, `dis_branch`, `dis_shipmentdate`, `dis_warranty`, `dis_exprydate`, `dis_phardisk1`, `dis_phardisk2`, `dis_shardisk1`, `dis_shardisk2`, `dis_ram`, `dis_processor`, `dis_core`, `dis_bios`, `dis_os`, `dis_msoffice`, `dis_antivirus`, `dis_iperius`, `dis_status`, `dis_uploadon`, `dis_uploadby`) VALUES ('$srvname','$ipdetail','$serialno','$make','$model1','$model2','$servicetag','$build','$location','$branch','$shipdate','$warnty','$effDate','$hardisk1','$hardisk2','$shardisk1','$shardisk2','$ram','$prodetal','$core','$bios','$os','$msoffice','$antivirus','$iperius','1','$mydate','$uname')";
  	$res = mysqli_query($conn,$sql);
  	if($res == true)
  	{
  		header('Location:server.php?adl=add');
  	}



}

?>
<?php
	if(isset($_GET['del']))
	{
		$del = $_GET['del'];
		$dsql = "UPDATE `dis_server` SET dis_status='0' WHERE dis_sno='$del'";
		$dres = mysqli_query($conn,$dsql);
		if($dres == true)
		{
			header('Location:server.php?adl=add');
		}

	}
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>Server Inventory</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="server.php?adl=add" class="navlink">Server Entry <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="server.php?adl=detail" class="navlink">Server Details <i class="	fa fa-angle-double-right"></i></a></li>

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
					
				</div>

			</div>
			
					
						<?php
						if(isset($_GET['adl']))
						{
							$adl = $_GET['adl'];
							switch($adl)
							{
								case"add":
								?>
								<div class="server-entry">
									<form class="" method="POST">
										<div class="form-group row">
											<div class="col-lg-3 col-md-3">
												<label>Server Name</label>
												<input type="text" name="srvname" class="form-control" required placeholder="Server Name...">
											</div>
											<div class="col-lg-3 col-md-3">
												<label>IP details</label>
												<input type="text" name="ipdetail" class="form-control" required placeholder="IP Details...">
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Serial Number</label>
												<input type="text" name="serialno" class="form-control" required placeholder="Serial Number...">
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Make</label>
												<select class="form-control" name="make" required>
													<option value="" disabled="" selected="">Make</option>
													<option value="Dell">Dell</option>
													<option value="HP">HP</option>
													<option value="Lenovo">Lenovo</option>
												</select>
											</div>
											
										</div>
										<div class="form-group row">
											<div class="col-lg-3 col-md-3">
												<label>Model</label>
												<div class="row no-mp">
													<div class="col-lg-6 col-md-6 no-mp">
														<select class="form-control" name="model1" required>
															<option value="" disabled="" selected="">Model</option>
															<option value="Power-Edge">Power Edge</option>
															<option value="Dell-NX">Dell NX</option>
															<option value="Lenovo">Lenovo</option>
															<option value="HP-ProLiant">HP ProLiant</option>
															
														</select>
													</div>
													<div class="col-lg-6 col-md-6 no-mp">
														<input type="text" name="model2" class="form-control" required placeholder="....">
													</div>

													
												
												</div>
												
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Silaris Service Tag</label>
												<input type="text" name="servicetag" class="form-control" required placeholder="Service Tag...">
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Building</label>
												<select class="form-control" name="build" required>
													<option value="" disabled="" selected="">Building</option>
													<option value="A-1">A-1</option>
													<option value="A-6">A-6</option>
													<option value="A-7">A-7</option>
													<option value="14/1">14/1</option>
													<option value="14/2">14/2</option>
													<option value="14/3">14/3</option>
													<option value="other">other</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Location</label>
												<select class="form-control" name="location" required>
													<option value="" disabled="" selected="">Location</option>
													
													<option value="Groundfloor">Groundfloor</option>
													<option value="Firstfloor">Firstfloor</option>
													<option value="Secondfloor">Secondfloor</option>
													<option value="Gurugram">Gururgram</option>
													<option value="Pune">Pune</option>
													<option value="Mumbai">Mumbai</option>
													
												</select>
											</div>
											
										</div>
										<div class="form-group row">
											<div class="col-lg-3 col-md-3">
												<label>Branch</label>
												<select class="form-control" name="branch" required>
													<option value="" disabled="" selected="">Branch</option>
													
													<option value="New-Delhi">New Delhi</option>
													<option value="Gurugram">Gururgram</option>
													<option value="Pune">Pune</option>
													<option value="Mumbai">Mumbai</option>
													
												</select>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Shipment Date</label>
												<input type="date" name="shipdate" class="form-control" required>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Warranty</label>
												<select class="form-control" name="warnty" required>
													<option value="" disabled="" selected="">Warranty</option>
												<?php
													for($i=1;$i<=9;$i++)
													{
														?>
														<option value="<?php echo $i;?>"><?php echo $i;?>yr</option>
														<?php
													}
												?>
												
												</select>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>RAM</label>
												<select class="form-control" name="ram" required>
													<option value="" disabled="" selected="">Select Ram</option>
													<option value="08 GB">08 GB</option>
													<option value="12 GB">12 GB</option>
													<option value="16 GB">16 GB</option>
													<option value="32 GB">32 GB</option>
													<option value="64 GB">64 GB</option>
													<option value="72 GB">72 GB</option>
													<option value="96 GB">96 GB</option>
													<option value="128 GB">128 GB</option>
													<option value="256 GB">256 GB</option>
												</select>
											</div>
											
										</div>
										
										<div class="form-group row">
											<div class="col-lg-3 col-md-3">
												<label>Hard Disk <small class="text-danger">Primary Space</small></label>
												<div class="row no-mp">
													<div class="col-lg-6 col-md-6 no-mp">
														<select class="form-control" name="hardisk1" required>
													<option value="" disabled="" selected="">Hard Disk</option>
													<option value="300 GB">300 GB</option>
													<option value="600 GB">600 GB</option>
													<option value="900 GB">900 GB</option>
													<option value="1 TB">1 TB</option>
													<option value="1.2 TB">1.2 TB</option>
													<option value="1.5 TB">1.5 TB</option>
													<option value="1.7 TB">1.7 TB</option>
													<option value="2 TB">2 TB</option>
													<option value="5 TB">5 TB</option>
													<option value="10 TB">10 TB</option>
												</select>
													</div>
													<div class="col-lg-6 col-md-6 no-mp">
														<input type="number" name="hardisk2" class="form-control" required placeholder="X">
													</div>

													
												
												</div>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Hard Disk <small class="text-success">Secondry Space</small></label>
												<div class="row no-mp">
													<div class="col-lg-6 col-md-6 no-mp">
														<select class="form-control" name="shardisk1">
													<option value="" disabled="" selected="">Hard Disk</option>
													<option value="300 GB">300 GB</option>
													<option value="600 GB">600 GB</option>
													<option value="900 GB">900 GB</option>
													<option value="1 TB">1 TB</option>
													<option value="1.2 TB">1.2 TB</option>
													<option value="1.5 TB">1.5 TB</option>
													<option value="1.7 TB">1.7 TB</option>
													<option value="2 TB">2 TB</option>
													<option value="5 TB">5 TB</option>
													<option value="10 TB">10 TB</option>
												</select>
													</div>
													<div class="col-lg-6 col-md-6 no-mp">
														<input type="number" name="shardisk2" class="form-control" placeholder="X">
													</div>

													
												
												</div>
											</div>
											<div class="col-lg-6 col-md-6">
												<label>Processor with Details</label>
												<input type="text" name="prodetal" class="form-control" required placeholder="Processor with details....">
											</div>
											
											
										</div>
										<div class="form-group row">
											<div class="col-lg-3 col-md-3">
												<label>Core</label>
												<select class="form-control" name="core" required>
													<option value="" disabled="" selected="">Core</option>
													<?php
														for($j=1;$j<=10;$j++)
														{
															?>
							<option value="<?php echo 2*$j;?> Core"><?php echo 2*$j;?> Core</option>
															<?php
														}
													?>
													
													
												</select>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>BIOS</label>
												<input type="text" name="bios" class="form-control" required placeholder="system details...">
											</div>
											<div class="col-lg-6 col-md-6">
												<label>Operating System</label>
												<div class="row no-mp">
													<div class="col-lg-6 col-md-6 no-mp">
														<select class="form-control" name="os1" required>
															<option value="" disabled="" selected="">Operating System</option>
															<option value="Linux">Linux</option>
															<option value="VM ESXI">VM ESXI</option>
															<option value="Microsoft Windows Server">Microsoft Windows Server</option>
															<option value="Ubuntu">Ubuntu</option>
															<option value="Cent_OS">Cent_OS</option>
															<option value="Redhat">Redhat</option>
														</select>
													</div>
													<div class="col-lg-6 col-md-6 no-mp">
														<input type="text" name="os2" class="form-control" required placeholder="....">
													</div>

													
												
												</div>
												
											</div>
											
											
										</div>
										<div class="form-group row">
											<div class="col-lg-3 col-md-3">
												<label>MS Office</label>
												<select class="form-control" name="msoffice" required>
													<option value="" disabled="" selected="">Select Office</option>
													<option value="Microsoft Office Standard 2010">Microsoft Office Standard 2010</option>
													<option value="Microsoft Office Standard 2014">Microsoft Office Standard 2014</option>
													<option value="Microsoft Office Standard 2016">Microsoft Office Standard 2016</option>
													<option value="Microsoft Office Standard 2019">Microsoft Office Standard 2019</option>
													<option value="Not Installed">Not Installed</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Antivirus</label>
												<select class="form-control" name="antivirus" required>
													<option value="" disabled="" selected="">Select Antivirus</option>
													<option value="Symantec">Symantec</option>
													<option value="McAfee">McAfee</option>
													<option value="Not Installed">Not Installed</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>Iperius</label>
												<select class="form-control" name="iperius" required>
													<option value="" disabled="" selected="">Select Iperius</option>
													<option value="Iperius">Iperius</option>
													<option value="Not Installed">Not Installed</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-3">
												<label>.</label>
												<input type="submit" name="serversub" class="form-control btn-dark" value="Submit">
											</div>
										</div>
										
									</form>
								</div>
								<?php
								break;
								case"detail":
								?>
								<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
								<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Server_Name</th>
									<th class="sticky-top">IP_details</th>
									<th class="sticky-top">Serial_Number</th>
									<th class="sticky-top">Make</th>
									<th class="sticky-top">Model</th>
									<th class="sticky-top">Silaris_Service_Tag</th>
									<th class="sticky-top">Building</th>
									<th class="sticky-top">Location</th>
									<th class="sticky-top">Branch</th>
									<th class="sticky-top">Shipment_Date</th>
									<th class="sticky-top">Duration</th>
									<th class="sticky-top">Warranty_/_AMC_Status</th>
									<th class="sticky-top">Age_<small>year_month_days</small></th>
									<th class="sticky-top">Older_than_5_years</th>
									<th class="sticky-top">Hard_Disk <small>Primary</small></th>
									<th class="sticky-top">Hard_Disk <small>Secondary</small></th>
									<th class="sticky-top">Ram</th>
									<th class="sticky-top">Processor</th>
									<th class="sticky-top">Core</th>
									<th class="sticky-top">Bios</th>
									<th class="sticky-top">Operating_System</th>
									<th class="sticky-top">MS_Office</th>
									<th class="sticky-top">Antivirus</th>
									<th class="sticky-top">Iperius</th>
									<th class="sticky-top">Status</th>
									<th class="sticky-top">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$nums = 1;
								$mvql = "SELECT * FROM `dis_server` WHERE dis_status='1'";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
								<tr>
									<td><?php echo $nums;?></td>
										<td><?php echo $mrow['dis_servername'];?></td>
										<td><?php echo $mrow['dis_ipdetails'];?></td>
										<td><?php echo $mrow['dis_serialnum'];?></td>
										<td><?php echo $mrow['dis_make'];?></td>
										<td><?php echo $mrow['dis_model1'];?> <?php echo $mrow['dis_model2'];?></td>
										
										<td><?php echo $mrow['dis_servicestag'];?></td>
										<td><?php echo $mrow['dis_building'];?></td>
										<td><?php echo $mrow['dis_location'];?></td>
										
										<td><?php echo $mrow['dis_branch'];?></td>
										<td><?php echo $mrow['dis_shipmentdate'];?></td>
										<td><?php echo $mrow['dis_warranty'];?></td>
										<td><?php echo $mrow['dis_exprydate'];?></td>
										<td><?php
											$ship = $mrow['dis_shipmentdate'];
											$bday = new DateTime($ship); // Your date of birth
											$today = new Datetime(date('Y-m-d'));
											$diff = $today->diff($bday);

										 printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);


										?></td>
										<td><?php 
										$aage =	$mrow['dis_warranty'];
										if($aage >=5)
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										

										?></td>
										<td><?php echo $mrow['dis_phardisk1'];?> <?php echo $mrow['dis_phardisk2'];?>_HDD</td>
										<td><?php echo $mrow['dis_shardisk1'];?> <?php echo $mrow['dis_shardisk2'];?></td>
										
										<td><?php echo $mrow['dis_ram'];?></td>
										<td><?php echo $mrow['dis_processor'];?></td>
										<td><?php echo $mrow['dis_core'];?></td>
										
										<td><?php echo $mrow['dis_bios'];?></td>
										<td><?php echo $mrow['dis_os'];?></td>
										<td><?php echo $mrow['dis_msoffice'];?></td>
										<td><?php echo $mrow['dis_antivirus'];?></td>
										<td><?php echo $mrow['dis_iperius'];?></td>
										<td><?php 
										
											
  											$date1 = $mrow['dis_exprydate'];
  											$date2 = date('Y-m-d');
  											$dateDiff = dateDiffInDays($date1, $date2);
  											
											if($dateDiff <=30)
											{
												echo "<span class='nblink'>expiry soon</span>";
											}
											else
											{
												echo "Rest Days ".$dateDiff;
											}

										

										?></td>
										<td><a href="server.php?del=<?php echo $mrow['dis_sno'];?>" class="delt" onclick="return confirm('Are you Sure?')">Delete</a></td>
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
									<th class="sticky-top">Server_Name</th>
									<th class="sticky-top">IP_details</th>
									<th class="sticky-top">Serial_Number</th>
									<th class="sticky-top">Make</th>
									<th class="sticky-top">Model</th>
									<th class="sticky-top">Silaris_Service_Tag</th>
									<th class="sticky-top">Building</th>
									<th class="sticky-top">Location</th>
									<th class="sticky-top">Branch</th>
									<th class="sticky-top">Shipment_Date</th>
									<th class="sticky-top">Duration</th>
									<th class="sticky-top">Warranty_/_AMC_Status</th>
									<th class="sticky-top">Age_<small>year_month_days</small></th>
									<th class="sticky-top">Older_than_5_years</th>
									<th class="sticky-top">Hard_Disk <small>Primary</small></th>
									<th class="sticky-top">Hard_Disk <small>Secondary</small></th>
									<th class="sticky-top">Ram</th>
									<th class="sticky-top">Processor</th>
									<th class="sticky-top">Core</th>
									<th class="sticky-top">Bios</th>
									<th class="sticky-top">Operating_System</th>
									<th class="sticky-top">MS_Office</th>
									<th class="sticky-top">Antivirus</th>
									<th class="sticky-top">Iperius</th>
									<th class="sticky-top">Status</th>
									<th class="sticky-top">Action</th>

									
									</tr>
								</thead>
								<tbody>
									<?php
								$nums = 1;
								$mvql = "SELECT * FROM `dis_server` WHERE dis_status='1'";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
								<tr>
									<td><?php echo $nums;?></td>
										<td><?php echo $mrow['dis_servername'];?></td>
										<td><?php echo $mrow['dis_ipdetails'];?></td>
										<td><?php echo $mrow['dis_serialnum'];?></td>
										<td><?php echo $mrow['dis_make'];?></td>
										<td><?php echo $mrow['dis_model1'];?> <?php echo $mrow['dis_model2'];?></td>
										
										<td><?php echo $mrow['dis_servicestag'];?></td>
										<td><?php echo $mrow['dis_building'];?></td>
										<td><?php echo $mrow['dis_location'];?></td>
										
										<td><?php echo $mrow['dis_branch'];?></td>
										<td><?php echo $mrow['dis_shipmentdate'];?></td>
										<td><?php echo $mrow['dis_warranty'];?></td>
										<td><?php echo $mrow['dis_exprydate'];?></td>
										<td><?php
											$ship = $mrow['dis_shipmentdate'];
											$bday = new DateTime($ship); // Your date of birth
											$today = new Datetime(date('Y-m-d'));
											$diff = $today->diff($bday);

										 printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);


										?></td>
										<td><?php 
										$aage =	$mrow['dis_warranty'];
										if($aage >=5)
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										

										?></td>
										<td><?php echo $mrow['dis_phardisk1'];?> <?php echo $mrow['dis_phardisk2'];?></td>
										<td><?php echo $mrow['dis_shardisk1'];?> <?php echo $mrow['dis_shardisk2'];?></td>
										
										<td><?php echo $mrow['dis_ram'];?></td>
										<td><?php echo $mrow['dis_processor'];?></td>
										<td><?php echo $mrow['dis_core'];?></td>
										
										<td><?php echo $mrow['dis_bios'];?></td>
										<td><?php echo $mrow['dis_os'];?></td>
										<td><?php echo $mrow['dis_msoffice'];?></td>
										<td><?php echo $mrow['dis_antivirus'];?></td>
										<td><?php echo $mrow['dis_iperius'];?></td>
										<td><?php 
										
											
  											
											if($dateDiff <=30)
											{
												echo "<span class='nblink'>expiry soon</span>";
											}
											else
											{
												echo "Rest Days ".$dateDiff;
											}

										

										?></td>
										<td><a href="server.php?del=<?php echo $mrow['dis_sno'];?>" class="delt" onclick="return confirm('Are you Sure?')">Delete</a></td>
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
							<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
							<thead class="bgsky">
									<tr>
									<th class="sticky-top">S.No.</th>
									<th class="sticky-top">Server_Name</th>
									<th class="sticky-top">IP_details</th>
									<th class="sticky-top">Serial_Number</th>
									<th class="sticky-top">Make</th>
									<th class="sticky-top">Model</th>
									<th class="sticky-top">Silaris_Service_Tag</th>
									<th class="sticky-top">Building</th>
									<th class="sticky-top">Location</th>
									<th class="sticky-top">Branch</th>
									<th class="sticky-top">Shipment_Date</th>
									<th class="sticky-top">Duration</th>
									<th class="sticky-top">Warranty_/_AMC_Status</th>
									<th class="sticky-top">Age_<small>year_month_days</small></th>
									<th class="sticky-top">Older_than_5_years</th>
									<th class="sticky-top">Hard_Disk <small>Primary</small></th>
									<th class="sticky-top">Hard_Disk <small>Secondary</small></th>
									<th class="sticky-top">Ram</th>
									<th class="sticky-top">Processor</th>
									<th class="sticky-top">Core</th>
									<th class="sticky-top">Bios</th>
									<th class="sticky-top">Operating_System</th>
									<th class="sticky-top">MS_Office</th>
									<th class="sticky-top">Antivirus</th>
									<th class="sticky-top">Iperius</th>
									<th class="sticky-top">Status</th>
									<th class="sticky-top">Action</th>
									</tr>
							</thead>
							<tbody>
								<?php
								$nums = 1;
								$mvql = "SELECT * FROM `dis_server` WHERE dis_status='1'";
								$mvres = mysqli_query($conn,$mvql);
								while($mrow = mysqli_fetch_array($mvres))
								{
									?>
									<tr>
									<td><?php echo $nums;?></td>
										<td><?php echo $mrow['dis_servername'];?></td>
										<td><?php echo $mrow['dis_ipdetails'];?></td>
										<td><?php echo $mrow['dis_serialnum'];?></td>
										<td><?php echo $mrow['dis_make'];?></td>
										<td><?php echo $mrow['dis_model1'];?> <?php echo $mrow['dis_model2'];?></td>
										
										<td><?php echo $mrow['dis_servicestag'];?></td>
										<td><?php echo $mrow['dis_building'];?></td>
										<td><?php echo $mrow['dis_location'];?></td>
										
										<td><?php echo $mrow['dis_branch'];?></td>
										<td><?php echo $mrow['dis_shipmentdate'];?></td>
										<td><?php echo $mrow['dis_warranty'];?></td>
										<td><?php echo $mrow['dis_exprydate'];?></td>
										<td><?php
											$ship = $mrow['dis_shipmentdate'];
											$bday = new DateTime($ship); // Your date of birth
											$today = new Datetime(date('Y-m-d'));
											$diff = $today->diff($bday);

										 printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);


										?></td>
										<td><?php 
										$aage =	$mrow['dis_warranty'];
										if($aage >=5)
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										

										?></td>
										<td><?php echo $mrow['dis_phardisk1'];?> <?php echo $mrow['dis_phardisk2'];?></td>
										<td><?php echo $mrow['dis_shardisk1'];?> <?php echo $mrow['dis_shardisk2'];?></td>
										
										<td><?php echo $mrow['dis_ram'];?></td>
										<td><?php echo $mrow['dis_processor'];?></td>
										<td><?php echo $mrow['dis_core'];?></td>
										
										<td><?php echo $mrow['dis_bios'];?></td>
										<td><?php echo $mrow['dis_os'];?></td>
										<td><?php echo $mrow['dis_msoffice'];?></td>
										<td><?php echo $mrow['dis_antivirus'];?></td>
										<td><?php echo $mrow['dis_iperius'];?></td>
										<td><?php 
										
											
  											$date1 = $mrow['dis_exprydate'];
  											$date2 = date('Y-m-d');
  											$dateDiff = dateDiffInDays($date1, $date2);
  											
											if($dateDiff <=30)
											{
												echo "<span class='nblink'>expiry soon</span>";
											}
											else
											{
												echo "Rest Days ".$dateDiff;
											}

										

										?></td>
										<td><a href="server.php?del=<?php echo $mrow['dis_sno'];?>" class="delt" onclick="return confirm('Are you Sure?')">Delete</a></td>
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