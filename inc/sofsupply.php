<?php
include('header.php');
?>
<?php
if(isset($_POST['submitt']))
{
	$id = $_GET['id'];
	$set = $_GET['set'];
	$fstock = $_POST['fstock'];
	$lstock = $_POST['lstock'];
	$process = $_POST['process'];
	$loc = $_POST['loc'];
	$build = $_POST['build'];
	$branch = $_POST['branch'];
	$issuedate = $_POST['issuedate'];

	switch($set)
	{
		case "Software":
		$fstok	= substr($fstock, +4);
		$lstok = substr($lstock,+4);

		$eval = $lstok-$fstok+1;

		$metl = "SELECT dis_counter FROM dis_computer WHERE dis_code='$id'";
		$mres = mysqli_query($conn,$metl);
		$mtrow = mysqli_fetch_array($mres);
		$mtel = $mtrow['dis_counter'];

		$sm = $mtel+$eval;

		for($i=$fstok;$i<=$lstok;$i++)
		{
			$val = "SOF-".$i; 
			$sqll = "UPDATE dis_alldata SET dis_issueto='$process', dis_building='$build', dis_location='$loc', dis_branch='$branch', dis_issuedate='$issuedate', dis_status='2' WHERE dis_comcode='$val'";
			mysqli_query($conn,$sqll);

		}
		$tms = "UPDATE `dis_computer` SET dis_counter='$sm' WHERE dis_code='$id'";
		$trs = mysqli_query($conn,$tms);
		if($mres == true AND $trs == true)
		{
			header('Location:software.php');
		}
		break;
		
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
			<div class="row">
			<div class="col-lg-8 col-md-8 mt-5">
				
				<?php
					if(isset($_GET['id']) AND isset($_GET['set']))
					{
						$id = $_GET['id'];
						$set = $_GET['set'];

				$ysql="SELECT * FROM dis_computer WHERE dis_code='$id' AND dis_assets='$set' AND dis_status='1'";
						$yres = mysqli_query($conn,$ysql);
						$yrow = mysqli_fetch_array($yres);
						$ys = $yrow['dis_quantity'];
						$yp = $yrow['dis_counter'];
						if($ys == $yp)
						{
							echo '<h3>No Stock! Select another stock.</h3>';
						}
						else
						{
								?>
							
								<form class="mt-5" method="POST">
								<div class="form-group row">
								<div class="col-lg-6 col-md-6">

									<label>From</label>
									<select name="fstock" class="form-control">
									<?php
									if(isset($_GET['id']) AND isset($_GET['set']))
									{

										$id = $_GET['id'];
										$set = $_GET['set'];

										$tsql="SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$id' AND dis_pname='$set' AND dis_status='1'";
										$tres = mysqli_query($conn,$tsql);
										while($trow = mysqli_fetch_array($tres))
										{
											echo '<option value="'.$trow['dis_comcode'].'">'.$trow['dis_comcode'].'</option>';
										}
									}
									?>
									
								</select>
								</div>
								<div class="col-lg-6 col-md-6">
									<label>To</label>
									<select name="lstock" class="form-control">
									<?php
									if(isset($_GET['id']) AND isset($_GET['set']))
									{

										$id = $_GET['id'];
										$set = $_GET['set'];

										$tsql="SELECT dis_comcode FROM `dis_alldata` WHERE dis_code='$id' AND dis_pname='$set' AND dis_status='1'";
										$tres = mysqli_query($conn,$tsql);
										while($trow = mysqli_fetch_array($tres))
										{
											echo '<option value="'.$trow['dis_comcode'].'">'.$trow['dis_comcode'].'</option>';
										}
									}
									?>
									
								</select>
								</div>

								
							</div>
							<div class="form-group row">
								<div class="col-lg-6 col-md-6">
								<label for="">Process / Sub-process* </label>
									<select name="process" class="form-control" required>
									<option value="" disabled="" selected>Select Process</option>
                                    <?php
                                    $psql = "SELECT * FROM `dis_process`";
                                    $pres = mysqli_query($conn,$psql);
                                    while($prow = mysqli_fetch_array($pres))
                                    {
                                    	?>
                                    	<option value="<?php echo $prow['dis_proname'];?>"><?php echo $prow['dis_proname'];?></option>
                                    	<?php
                                    }
                                    ?>
									</select>
								</div>
								<div class="col-lg-6 col-md-6">
								<label>Building No</label>
								
								<select class="form-control" name="build" required>
									<option value="" selected="" disabled="">Select Building</option>
									<option value="14/1">14/1</option>
									<option value="14/2">14/2</option>
									<option value="14/3">14/3</option>
									<option value="A-6">A-6</option>
									<option value="Other">Other</option>

								</select>
								</div>

								
							</div>
							<div class="form-group">
								<label>Location</label>
								<select class="form-control" name="loc">
									<option value="" selected="" disabled="">Select Location</option>
									<option value="Basement">Basement</option>
									<option value="Ground Floor">Ground Floor</option>
									<option value="First Floor">First Floor</option>
									<option value="Second Floor">Second Floor</option>
									<option value="Third Floor">Third Floor</option>
									<option value="Fourth Floor">Fourth Floor</option>
								</select>
							</div>
							<div class="form-group row">
								<div class="col-lg-6 col-md-6">
									<label>Branch*</label>
								<select class="form-control" name="branch" required>
									<option value="" selected="" disabled="">Select Location</option>
									<option value="New Delhi">New Delhi</option>
									<option value="Gurugram">Gurugram</option>
									<option value="Noida">Noida</option>
									<option value="Pune">Pune</option>
									<option value="Mumbai">Mumbai</option>
								</select>
								</div>
								<div class="col-lg-6 col-md-6">
									<label>Issue Date*</label>
								<input type="date" name="issuedate" class="form-control" required>
								</div>

								
							</div>
							<div class="form-group clearfix">
								
								<input type="submit" name="submitt" class="float-right btn btn-primary" value="Submit">
							</div>
						</form>

								<?php
								}
							}

						?>
						
							
							

							
							
						
			</div>
			<div class="col-lg-4 col-md-4 mt-5">
				
			</div>
		</div>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>