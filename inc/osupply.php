<?php
include('header.php');
?>
<?php
if(isset($_POST['subold']))
{
	$id = $_GET['id'];
	$set = $_GET['set'];
	$asst = $_POST['asst'];
	$sct = $_POST['ncom'];
	

	date_default_timezone_set("Asia/Kolkata");
  $mydate = date('Y-m-d');
	
	

	
      	$ctn = "SELECT dis_code, dis_comcode, dis_counter FROM `dis_alldata` WHERE dis_comcode ='$asst' AND dis_status='1'";
	      $crs = mysqli_query($conn,$ctn);
	      $crw = mysqli_fetch_array($crs);
	      $dcnt = $crw['dis_counter'];
	      $dnd = $crw['dis_comcode'];
	      $dcd = $crw['dis_code'];
	      $ccnt = $dcnt+1;

	      
					$tip = "SELECT dis_counter FROM `dis_computer` WHERE dis_code='$id'";
			      $rip = mysqli_query($conn,$tip);
			      $prw = mysqli_fetch_array($rip);
			      $pct = $prw['dis_counter'];
			      $dict = $pct+1;

			      if($dcnt = "")
			      {
			        $sql = "UPDATE `dis_alldata` SET dis_issueto='$sct', dis_counter='1', dis_repairon='$mydate', dis_status='2' WHERE dis_comcode='$asst'";
			        mysqli_query($conn,$sql);
			        $tips = "UPDATE `dis_computer` SET dis_counter='$dict' WHERE dis_code='$id'";
			        if(mysqli_query($conn,$tips) == true)
			        {
			          header('Location:othereciept.php?add=Hard%20Disk');
			        }
			      }
			      else
			      {
			        $sql = "UPDATE `dis_alldata` SET dis_issueto='$sct', dis_counter='1', dis_repairon='$mydate', dis_status='2' WHERE dis_comcode='$asst'";
			        mysqli_query($conn,$sql);
			        $tips = "UPDATE `dis_computer` SET dis_counter='$dict' WHERE dis_code='$id'";
			        if(mysqli_query($conn,$tips) == true)
			        {
			          header('Location:othereciept.php?add=Hard%20Disk');
			        }
			      }
					
				

}

?>
<?php
if(isset($_POST['subnew']))
{
	$id = $_GET['id'];
	$set = $_GET['set'];
	$asst = $_POST['asst'];
	$sct = $_POST['ncom'];
	

	date_default_timezone_set("Asia/Kolkata");
  $mydate = date('Y-m-d');
	
	

	
      	$ctn = "SELECT dis_code, dis_comcode, dis_counter FROM `dis_alldata` WHERE dis_comcode ='$asst' AND dis_status='1'";
	      $crs = mysqli_query($conn,$ctn);
	      $crw = mysqli_fetch_array($crs);
	      $dcnt = $crw['dis_counter'];
	      $dnd = $crw['dis_comcode'];
	      $dcd = $crw['dis_code'];
	      $ccnt = $dcnt+1;

	      
					$tip = "SELECT dis_counter FROM `dis_computer` WHERE dis_code='$id'";
			      $rip = mysqli_query($conn,$tip);
			      $prw = mysqli_fetch_array($rip);
			      $pct = $prw['dis_counter'];
			      $dict = $pct+1;

			      if($dcnt = "")
			      {
			        $sql = "UPDATE `dis_alldata` SET dis_issueto='$sct', dis_counter='1', dis_repairon='$mydate', dis_status='2' WHERE dis_comcode='$asst'";
			        mysqli_query($conn,$sql);
			        $tips = "UPDATE `dis_computer` SET dis_counter='$dict' WHERE dis_code='$id'";
			        if(mysqli_query($conn,$tips) == true)
			        {
			          header('Location:othereciept.php?add=Hard%20Disk');
			        }
			      }
			      else
			      {
			        $sql = "UPDATE `dis_alldata` SET dis_issueto='$sct', dis_counter='1', dis_repairon='$mydate', dis_status='2' WHERE dis_comcode='$asst'";
			        mysqli_query($conn,$sql);
			        $tips = "UPDATE `dis_computer` SET dis_counter='$dict' WHERE dis_code='$id'";
			        if(mysqli_query($conn,$tips) == true)
			        {
			          header('Location:othereciept.php?add=Hard%20Disk');
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
			<div class="row">
			<div class="col-lg-12 col-md-12 mt-5">
				
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
							<div class="row">
								<div class="col-lg-12 col-md-12 pb-5">
									<button class="btn btn-primary" id="oldset">Old Computer Set</button>
									<button class="btn btn-danger ml-3" id="newset">New Computer Set</button>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="computer" id="newcomputer">
										<h5 class="text-center">New Computer Set</h5>
										<form class="" method="POST" action="">
											<div class="form-group row">
												<div class="col-lg-6 col-md-6">
													<label>No of <?php echo $_GET['set']?></label>
												
												<select class="form-control" name="asst">
													<?php
													$est = $_GET['set'];
														$tmst = "SELECT * FROM `dis_alldata` WHERE dis_pname='$est' AND dis_status='1' LIMIT 1";
														$tres = mysqli_query($conn,$tmst);
														while($trow = mysqli_fetch_array($tres))
														{
															?>
															<option value="<?php echo $trow['dis_comcode']?>"><?php echo $trow['dis_comcode']?></option>
															<?php
														}
													?>
													
												</select>
												</div>
												<div class="col-lg-6 col-md-6">
													<label>Computer Barcode</label>
													<select class="form-control" name="ncom">
													<?php
													$est = $_GET['set'];
														$tmst = "SELECT * FROM `dis_alldata` WHERE dis_pname='New Computer Set' AND dis_status='2'";
														$tres = mysqli_query($conn,$tmst);
														while($trow = mysqli_fetch_array($tres))
														{
															?>
															<option value="<?php echo $trow['dis_comcode']?>"><?php echo $trow['dis_comcode']?></option>
															<?php
														}
													?>
													
												</select>
													
													
													
												</div>

												
											</div>
											<div class="form-group clearfix">
								
								<input type="submit" name="subnew" class="float-right btn btn-danger" value="Submit">
							</div>
										</form>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="computer oldted" id="oldcomputer">
									<h5 class="text-center">Old Computer Set</h5>
										<form class="" method="POST" action="">
											
											<div class="form-group row">
												<div class="col-lg-6 col-md-6">
													<label>No of <?php echo $_GET['set']?></label>
												<select class="form-control" name="asst">
													<?php
													$est = $_GET['set'];
														$tmst = "SELECT * FROM `dis_alldata` WHERE dis_pname='$est' AND dis_status='1' LIMIT 1";
														$tres = mysqli_query($conn,$tmst);
														while($trow = mysqli_fetch_array($tres))
														{
															?>
															<option value="<?php echo $trow['dis_comcode']?>"><?php echo $trow['dis_comcode']?></option>
															<?php
														}
													?>
													
												</select>
												</div>
												<div class="col-lg-6 col-md-6">
													<label>Computer Barcode</label>
													<select class="form-control" name="ncom">
													<?php
													$est = $_GET['set'];
														$tmst = "SELECT * FROM `dis_alldata` WHERE dis_pname='Old Computer Set' AND dis_status='2'";
														$tres = mysqli_query($conn,$tmst);
														while($trow = mysqli_fetch_array($tres))
														{
															?>
															<option value="<?php echo $trow['dis_comcode']?>"><?php echo $trow['dis_comcode']?></option>
															<?php
														}
													?>
													
												</select>
													
													
												</div>

												
											</div>
											<div class="form-group clearfix">
								
								<input type="submit" name="subold" class="float-right btn btn-primary" value="Submit">
							</div>
										</form>
									</div>
								</div>
								
							</div>

								
								
							
						

								<?php
								}
							}

						?>
						
							
							

							
							
						
			</div>
			
		</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#oldset').click(function(){
			$('#newcomputer').hide();
			$('#oldcomputer').show();
		});
		$('#newset').click(function(){
			$('#newcomputer').show();
			$('#oldcomputer').hide();
		});
	});
</script>
<?php
include('footer.php');
?>