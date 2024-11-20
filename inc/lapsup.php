<?php
include('header.php');
?>

<?php
if(isset($_POST['sublop']))
{
	$id = $_GET['id'];

	$fstock = $_POST['fstock'];
	$lstock = $_POST['lstock'];

	$fstok	= substr($fstock,+2);
	$lstok = substr($lstock,+2);

	$eval = $lstok-$fstok+1;

	$metl = "SELECT dis_counter FROM `dis_lapreciept` WHERE dis_code='$id'";
	$mres = mysqli_query($conn,$metl);
	$mtrow = mysqli_fetch_array($mres);
	$mtel = @$mtrow['dis_counter'];
	$sm = $mtel+$eval;
	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');
	for($i=$fstok;$i<=$lstok;$i++)
	{
		$val = "L-".$i; 
		$sqll = "UPDATE `dis_laptop` SET dis_empname='Sunny-IT', dis_issuedate='$mydate', dis_status='3' WHERE dis_barcode='$val'";
		mysqli_query($conn,$sqll);

	}

	$tms = "UPDATE `dis_lapreciept` SET dis_counter='$sm' WHERE dis_code='$id'";
	$tres = mysqli_query($conn,$tms);
	

	if($tres == true)
	{
		echo "<script>window.location.href='laptop.php?adl=add';</script>";
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
						if(isset($_GET['id']))
						{
							$id = $_GET['id'];
							$sql = "SELECT * FROM `dis_lapreciept` WHERE dis_code='$id'";
							$res = mysqli_query($conn,$sql);
							$row = mysqli_fetch_array($res);
							$qnt = $row['dis_quantity'];
							$cnt = $row['dis_counter'];
							if($qnt == $cnt)
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
									if(isset($_GET['id']))
									{

										$id = $_GET['id'];
										

										$tsql="SELECT dis_barcode FROM `dis_laptop` WHERE dis_code='$id' AND dis_status='1'";
										$tres = mysqli_query($conn,$tsql);
										while($trow = mysqli_fetch_array($tres))
										{
											echo '<option value="'.$trow['dis_barcode'].'">'.$trow['dis_barcode'].'</option>';
										}
									}
									?>
									
								</select>
								</div>
								<div class="col-lg-6 col-md-6">
									<label>To</label>
									<select name="lstock" class="form-control">
									<?php
									if(isset($_GET['id']))
									{

										$id = $_GET['id'];
										

										$tsql="SELECT dis_barcode FROM `dis_laptop` WHERE dis_code='$id' AND dis_status='1'";
										$tres = mysqli_query($conn,$tsql);
										while($trow = mysqli_fetch_array($tres))
										{
											echo '<option value="'.$trow['dis_barcode'].'">'.$trow['dis_barcode'].'</option>';
										}
									}
									?>
									
								</select>
								</div>

								
							</div>
							
							
							
							<div class="form-group clearfix">
								
								<input type="submit" name="sublop" class="float-right btn btn-primary" value="Submit">
							</div>
						</form>
								<?php
							}
						}
					?>
				</div>
				<div class="col-lg-4 col-md-4 mt-5"></div>

			</div>
			
	
		</div>
	</div>
	

</div>
<?php
include('footer.php');
?>