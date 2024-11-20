<?php
include('header.php');
?>
<?php
if(isset($_POST['submitdata']))
{
	$assets = $_POST['assets'];
	$asstqnty = $_POST['asstqnty'];
	$remarks = $_POST['remarks'];

	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');
	$mydated = date('Y-m-d h:i:s');


	for($i=1;$i<=$asstqnty;$i++)
	{
		$sql = "INSERT INTO `dis_scrab`(`dis_pdate`, `dis_remarks`, `dis_repairby`,`dis_repairon`, `dis_pname`, `dis_status`) VALUES ('$mydate','$remarks','$uname','$mydated','$assets','1')";
		$res = mysqli_query($conn,$sql);
		if($res == true)
		{
			header('Location:scrap.php');
		}
	}


}

?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu mb-4">
				<p>Summary</p>
					<ul class="nav flex-column">
						<?php
							$tst = "SELECT * FROM `dis_scrab`";
							$tres = mysqli_query($conn,$tst);
							$tnum = mysqli_num_rows($tres);
						?>
						<li class="navitem"><a href="scrap.php" class="navlink"><span class="navlink">All Scrap <span class="badge badge-danger"><?php echo $tnum;?></span></a></li>
						<?php
							$sql = "SELECT COUNT(dis_sno) AS anum, dis_pname FROM `dis_scrab` GROUP BY dis_pname";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="scrap.php?add=<?php echo $row['dis_pname'];?>" class="navlink"><span class="navlink"><?php echo $row['dis_pname'];?></span> <span class="badge badge-danger"><?php echo $row['anum'];?></span></a></li>
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
						<button class="btn btn-primary float-right" onclick="document.getElementById('stockinvnt').style.display='block'"><i class="fa fa-plus"></i> Scrap Entry</button>
					</div>
				</div>

			</div>

			<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						<th class="sticky-top">Asset</th>
						<th class="sticky-top">Date</th>
						<th class="sticky-top">System Code</th>
						<th class="sticky-top">Expiry Date</th>
						<th class="sticky-top">Warranty</th>
						<th class="sticky-top">Process</th>
						<th class="sticky-top">Building</th>
						<th class="sticky-top">Location</th>
						<th class="sticky-top">Branch</th>
						<th class="sticky-top">Issue Date</th>
						<th class="sticky-top">Repair No</th>
						<th class="sticky-top">Repair IN</th>
						<th class="sticky-top">Repair OUT</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET['add']))
						{
							$add = $_GET['add'];
							$nums = 1;
					$mvql = "SELECT * FROM `dis_scrab` WHERE dis_pname='$add'";
					$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
								<tr>
									<td><?php echo $nums;?></td>
									<td><?php echo $mrow['dis_pname'];?></td>
									<td><?php echo $mrow['dis_pdate'];?></td>
									<?php
									$netv = $mrow['dis_issueto'];
									if($netv == "")
									{
										echo '<td class="bg-success text-white text-center">'.$mrow['dis_comcode'].'</td>';
									}
									else
									{
									 	echo '<td class="bg-danger text-white text-center">'.$mrow['dis_comcode'].'</td>';
									
									}

									?>
									<td><?php echo $mrow['dis_expridate'];?></td>
									<td><?php echo $mrow['dis_duration']."yrs";?></td>
									<td><?php echo $mrow['dis_issueto'];?></td>
									<td><?php echo $mrow['dis_building'];?></td>
									<td><?php echo $mrow['dis_location'];?></td>
									<td><?php echo $mrow['dis_branch'];?></td>
									<td><?php echo $mrow['dis_issuedate'];?></td>
									<td><?php echo $mrow['dis_counter'];?></td>
									<td><?php echo $mrow['dis_repairon'];?></td>
									<td><?php echo $mrow['dis_duck'];?></td>


								</tr>
								<?php
								$nums++;
							}
						}
						else
						{
							$nums = 1;
					$mvql = "SELECT * FROM `dis_scrab`";
					$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
								<tr>
									<td><?php echo $nums;?></td>
									<td><?php echo $mrow['dis_pname'];?></td>
									<td><?php echo $mrow['dis_pdate'];?></td>
									<?php
									$netv = $mrow['dis_issueto'];
									if($netv == "")
									{
										echo '<td class="bg-success text-white text-center">'.$mrow['dis_comcode'].'</td>';
									}
									else
									{
									 	echo '<td class="bg-danger text-white text-center">'.$mrow['dis_comcode'].'</td>';
									
									}

									?>
									<td><?php echo $mrow['dis_expridate'];?></td>
									<td><?php echo $mrow['dis_duration']."yrs";?></td>
									<td><?php echo $mrow['dis_issueto'];?></td>
									<td><?php echo $mrow['dis_building'];?></td>
									<td><?php echo $mrow['dis_location'];?></td>
									<td><?php echo $mrow['dis_branch'];?></td>
									<td><?php echo $mrow['dis_issuedate'];?></td>
									<td><?php echo $mrow['dis_counter'];?></td>
									<td><?php echo $mrow['dis_repairon'];?></td>
									<td><?php echo $mrow['dis_duck'];?></td>


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
			<h5 class="stocktxt">Purchase Inventory</h5>
			<form class="" method="post" action="">
							<div class="form-group row">
								
								<div class="col-md-6">
									<label for="">Select Assets : </label>
									<select class="form-control" name="assets" required>
										<option value="" disabled="" selected="">Select Assets</option>
										<option value="New Computer Set">New Computer Set</option>
										<option value="Old Computer Set">Old Computer Set</option>
										<?php
											$sql = "SELECT * FROM `dis_products` GROUP BY dis_proname";
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
								<div class="col-md-6">
									<label for="">Assets Quantity </label>
									<input type="number" name="asstqnty" class="form-control" required>
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