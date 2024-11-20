<?php
include('header.php');
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu mb-4">
				<p>Data Filter</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="dashboard.php" class="navlink">All Computer <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="laptop.php" class="navlink">Laptop <i class="	fa fa-angle-double-right"></i></a></li>
						<?php
							$sql = "SELECT * FROM `dis_alldata` GROUP BY dis_pname";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="dashboard.php?p=<?php echo $row['dis_pname'];?>" class="navlink"><?php echo $row['dis_pname'];?> <i class="	fa fa-angle-double-right"></i></a></li>
							<?php
						}
						?>
						
					</ul>
			</div>
			
			<div class="fistmenu">
				<p>Others Links</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="repair.php" class="navlink">Repairing 
								<?php
								$ysql = "SELECT * FROM `dis_alldata` WHERE dis_status='3'";
								$yres = mysqli_query($conn,$ysql);
								$ynum = mysqli_num_rows($yres);
							?>
							<i class="fa fa-angle-double-right"></i><span class="badge badge-danger"><?php echo $ynum;?></span></a></li>
						<!-- <li class="navitem"><a href="request.php" class="navlink">Assets Request 
							<?php
								$qsql = "SELECT * FROM `dis_repair` WHERE dis_status='1'";
								$qres = mysqli_query($conn,$qsql);
								$qnum = mysqli_num_rows($qres);
							?>

							<i class="fa fa-angle-double-right"></i> <span class="badge badge-danger"><?php echo $qnum;?></span></a></li>
						<li class="navitem"><a href="accept.php" class="navlink">Accept Request 
							<?php
								$qsql = "SELECT * FROM `dis_alldata` WHERE dis_status='7'";
								$qres = mysqli_query($conn,$qsql);
								$qnum = mysqli_num_rows($qres);
							?>

							<i class="fa fa-angle-double-right"></i> <span class="badge badge-danger"><?php echo $qnum;?></span></a></li> -->
						
						<li class="navitem"><a href="repaired.php" class="navlink">Repaired Set 
							<?php
								$mmsql = "SELECT * FROM `dis_alldata` WHERE dis_status='5'";
								$mmres = mysqli_query($conn,$mmsql);
								$mmnum = mysqli_num_rows($mmres);
							?>

							<i class="fa fa-angle-double-right"></i> <span class="badge badge-danger"><?php echo $mmnum;?></span></a></li>
                            <li class="navitem"><a href="receipt-scrap.php" class="navlink">Scrap With Details <i class="fa fa-angle-double-right"></i></a></li>
							<li class="navitem"><a href="scrap.php" class="navlink">Scrap Non Details <i class="fa fa-angle-double-right"></i></a></li>
							
						
					</ul>
			</div>
		</div>
	</div>
	<div class="mainbar">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 mt-4">
					<table class="table table-bordered mb-5">
						<?php
						$osql = "SELECT * FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status IN('1','2','3','5','11')";
					$ores = mysqli_query($conn,$osql);
					$onum = mysqli_num_rows($ores);

					$dsql = "SELECT * FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status='2'";
					$dres = mysqli_query($conn,$dsql);
					$dnum = mysqli_num_rows($dres);

					$dsqt = "SELECT * FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status='1'";
					$dret = mysqli_query($conn,$dsqt);
					$ttblan = mysqli_num_rows($dret);

					$osqll = "SELECT * FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status IN('3','5')";
					$oress = mysqli_query($conn,$osqll);
					$onumm = mysqli_num_rows($oress);

					$cosqll = "SELECT * FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status='11'";
					$coress = mysqli_query($conn,$cosqll);
					$conumm = mysqli_num_rows($coress);

					
					

					$pi = @$_GET['p'];
					$pint = "SELECT * FROM `dis_alldata` WHERE dis_pname='$pi' AND dis_status IN ('1','2','3','5','11')";
					$pintre = mysqli_query($conn,$pint);
					$pintnum = mysqli_num_rows($pintre);

					$spl = "SELECT * FROM `dis_alldata` WHERE dis_pname='$pi' AND dis_status='2'";
					$ospl = mysqli_query($conn,$spl);
					$osnum = mysqli_num_rows($ospl);

					$balq = "SELECT * FROM `dis_alldata` WHERE dis_pname='$pi' AND dis_status='1'";
					$balrs = mysqli_query($conn,$balq);
					$balnm = mysqli_num_rows($balrs);

					$rpql = "SELECT * FROM `dis_alldata` WHERE dis_pname='$pi' AND dis_status IN('3','5')";
					$rprs = mysqli_query($conn,$rpql);
					$rpnm = mysqli_num_rows($rprs);

					$rcpql = "SELECT * FROM `dis_alldata` WHERE dis_pname='$pi' AND dis_status='11'";
					$rcprs = mysqli_query($conn,$rcpql);
					$rcpnm = mysqli_num_rows($rcprs);


						?>
		            	<tr>
                	<td colspan="10" class="text-center bg-dark text-white font-weight-bold"><?php if(isset($_GET['p'])){ echo $_GET['p'];}else{ echo "All Computer";}?> Inventory Summary</td>
            	</tr>
				<tr>
					<td class="bg-info font-weight-bold text-white">Inventory</td>
					<td class="bg-info font-weight-bold text-white"><?php if(isset($_GET['p'])){ echo $pintnum;}else{ echo $onum;}?></td>
					<td class="bg-warning font-weight-bold">Supply </td>
					<td class="bg-warning font-weight-bold"><a href="data.php" class="text-dark"><?php if(isset($_GET['p'])){ echo $osnum;}else{echo $dnum;}?> </a></td>
                	<td class="bg-success font-weight-bold text-white">Balance</td>
					<td class="bg-success font-weight-bold text-white"><?php if(isset($_GET['p'])){ echo $balnm;}else{ echo $ttblan;}?></td>
					<td class="bg-primary font-weight-bold text-white">Reparing</td>
					<td class="bg-primary font-weight-bold text-white"><?php if(isset($_GET['p'])){ echo $rpnm;}else{ echo $onumm;}?></td>
                    <td class="bg-danger font-weight-bold text-white">Scrap</td>
					<td class="bg-danger font-weight-bold text-white"><?php if(isset($_GET['p'])){ echo $rcpnm;}else{ echo $conumm;}?></td>
					
				</tr>
				<?php
					if(isset($_GET['p']))
					{
						$idp = $_GET['p'];
						switch($idp)
						{
							case "Software":
							$isql = "SELECT 'For_2' as newColumn, count(dis_psubname) as subname,dis_psubname FROM `dis_alldata` WHERE dis_pname='Software' AND dis_status='2' GROUP BY dis_psubname UNION SELECT 'For_3' as newColumn, count(dis_psubname) as subname, dis_psubname FROM `dis_alldata` WHERE dis_pname='Software' AND dis_status='1' GROUP BY dis_psubname;";
							// $isql = "SELECT count(dis_psubname) as subname,dis_psubname FROM `dis_alldata` WHERE dis_pname='$idp' GROUP BY dis_psubname";
							$ires = mysqli_query($conn,$isql);
							while($irow = mysqli_fetch_array($ires))
							{
								?>
								<tr>
									<td><?php echo $irow['dis_psubname']?></td>
									<td><?php echo $irow['subname']?></td>
									<td><?php echo $irow['subname']?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<?php
							}
							break;
						}
					}
				?>
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
						if(isset($_GET['p']))
						{
							$pi = @$_GET['p'];

							switch($pi)
							{
								case "New Computer Set":
								$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_branch FROM dis_alldata WHERE dis_pname='New Computer Set' AND dis_status='2' GROUP BY dis_branch";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="branch.php?pro=<?php echo $mrow['dis_branch'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Old Computer Set":
							$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_branch FROM `dis_alldata` WHERE dis_pname='Old Computer Set' AND dis_status='2' GROUP BY dis_branch";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="branch.php?pro=<?php echo $mrow['dis_branch'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Software":
							$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_branch FROM `dis_alldata` WHERE dis_pname='Software' AND dis_status='2' GROUP BY dis_branch";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="branch.php?pro=<?php echo $mrow['dis_branch'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							default:
							?>
							<tr>
								<td colspan="6" class="text-center">No Data</td>
							</tr>
							<?php
							}
						}
						else
						{
							$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums,dis_branch FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status='2' GROUP by dis_branch";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="branch.php?pro=<?php echo $mrow['dis_branch'];?>" class="tdlink"><?php echo $mrow['dis_branch'];?></td>
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
						if(isset($_GET['p']))
						{
							$pi = @$_GET['p'];
							 
							switch($pi)
							{
								case "New Computer Set":
								$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_location FROM dis_alldata WHERE dis_pname='New Computer Set' AND dis_status='2' GROUP BY dis_location";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="location.php?pro=<?php echo $mrow['dis_location'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Software":
								$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_location FROM dis_alldata WHERE dis_pname='Software' AND dis_status='2' GROUP BY dis_location";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="location.php?pro=<?php echo $mrow['dis_location'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Old Computer Set":
							$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_location FROM dis_alldata WHERE dis_pname='Old Computer Set' AND dis_status='2' GROUP BY dis_location";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="location.php?pro=<?php echo $mrow['dis_location'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							default:
							?>
							<tr>
								<td colspan="6" class="text-center">No Data</td>
							</tr>
							<?php
							}
						}
						else
						{
							$tnum=1;

							$mtsql = "SELECT COUNT(dis_issueto) AS nums,dis_location FROM `dis_alldata` WHERE dis_pname IN ('New Computer Set','Old Computer Set') AND dis_status='2' GROUP BY dis_location";
							$mtres = mysqli_query($conn,$mtsql);
							while($mtrow = mysqli_fetch_array($mtres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="location.php?pro=<?php echo $mtrow['dis_location'];?>" class="tdlink"><?php echo $mtrow['dis_location'];?></td>
								<td><?php echo $mtrow['nums'];?></td>
								
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
					<tbody>
						<?php
						if(isset($_GET['p']))
						{
							$pi = @$_GET['p'];

							switch($pi)
							{
								case "New Computer Set":
								$tnum=1;

							$msql = "SELECT COUNT(dis_building) AS nums, dis_building FROM dis_alldata WHERE dis_pname='New Computer Set' AND dis_status='2' GROUP BY dis_building";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="building.php?pro=<?php echo $mrow['dis_building'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Software":
								$tnum=1;

							$msql = "SELECT COUNT(dis_building) AS nums, dis_building FROM dis_alldata WHERE dis_pname='Software' AND dis_status='2' GROUP BY dis_building";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="building.php?pro=<?php echo $mrow['dis_building'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Old Computer Set":
							$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_building FROM `dis_alldata` WHERE dis_pname='Old Computer Set' AND dis_status='2' GROUP BY dis_building";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="building.php?pro=<?php echo $mrow['dis_building'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							default:
							?>
							<tr>
								<td colspan="6" class="text-center">No Data</td>
							</tr>
							<?php
							}
						}
						else
						{
							$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums,dis_building FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status='2' GROUP by dis_building";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="building.php?pro=<?php echo $mrow['dis_building'];?>" class="tdlink"><?php echo $mrow['dis_building'];?></td>
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
					
					
				</div>
				<div class="col-lg-6 col-md-6 mt-4">
					
					<div class="firstable">
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
						if(isset($_GET['p']))
						{
							$pi = @$_GET['p'];

							switch($pi)
							{
								case "New Computer Set":
								$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_issueto FROM dis_alldata WHERE dis_pname='New Computer Set' AND dis_status='2' GROUP BY dis_issueto";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="process.php?pro=<?php echo $mrow['dis_issueto'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Software":
								$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_issueto FROM dis_alldata WHERE dis_pname='Software' AND dis_status='2' GROUP BY dis_issueto";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="process.php?pro=<?php echo $mrow['dis_issueto'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							case "Old Computer Set":
							$tnum=1;

							$msql = "SELECT COUNT(dis_issueto) AS nums, dis_issueto FROM `dis_alldata` WHERE dis_pname='Old Computer Set' AND dis_status='2' GROUP BY dis_issueto";
							$mres = mysqli_query($conn,$msql);
							while($mrow = mysqli_fetch_array($mres))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="process.php?pro=<?php echo $mrow['dis_issueto'];?><?php if(isset($_GET['p'])){ echo '&pd='.$_GET['p'];}?>" class="tdlink"><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['nums'];?></td>
								
							</tr>
								<?php

								$tnum++;
							}
							break;
							default:
							?>
							<tr>
								<td colspan="6" class="text-center">No Data</td>
							</tr>
							<?php
							}
						}
						else
						{
							$tnum=1;
							$msqll = "SELECT COUNT(dis_issueto) AS nums,dis_issueto FROM `dis_alldata` where dis_pname in ('New Computer Set','Old Computer Set') AND dis_status='2' GROUP by dis_issueto";

							
							$mresl = mysqli_query($conn,$msqll);
							while($mrowl = mysqli_fetch_array($mresl))
							{
								?>
								<tr>
								<td><?php echo $tnum;?></td>
								<td><a href="process.php?pro=<?php echo $mrowl['dis_issueto'];?>" class="tdlink"><?php echo $mrowl['dis_issueto'];?></a> </td>
								<td><?php echo $mrowl['nums'];?></td>
								
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

			</div>
		</div>
	</div>

</div>


<?php
include('footer.php');
?>