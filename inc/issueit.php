<?php
include('header.php');
?>

<?php
if(isset($_POST['sublop']))
{
	$id = $_GET['id'];
	$empnam = $_POST['empnam'];
	$empid = $_POST['empid'];
	$emppro = $_POST['emppro'];
	$empdesg = $_POST['empdesg'];
	//$lapbrand = $_POST['lapbrand'];
	//$lapfeatur = $_POST['lapfeatur'];
	//$lapserial = $_POST['lapserial'];
	$issue = $_POST['issue'];
	$remarks = $_POST['remarks'];

	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');

	
	$tsql = "UPDATE `dis_laptop` SET `dis_empname`='$empnam',`dis_empid`='$empid',`dis_process`='$emppro',`dis_issuedate`='$issue',`dis_remarks`='$remarks',`dis_designation`='$empdesg',`dis_status`='2' WHERE `dis_barcode`='$id'";
	
	$tres = mysqli_query($conn,$tsql);
	if($tres == true)
	{
		
		echo "<script>window.location.href='laptop.php?adl=edd';</script>";
	}

}
?>
<?php
if(isset($_POST['sublopt']))
{
	$ids = $_GET['ids'];
	$empnam = $_POST['empnam'];
	$empid = $_POST['empid'];
	$emppro = $_POST['emppro'];
	$empdesg = $_POST['empdesg'];
	//$lapbrand = $_POST['lapbrand'];
	//$lapfeatur = $_POST['lapfeatur'];
	//$lapserial = $_POST['lapserial'];
	$issue = $_POST['issue'];
	$remarks = $_POST['remarks'];

	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d h:i:s');

	
	$tsql = "UPDATE `dis_laptop` SET `dis_empname`='$empnam',`dis_empid`='$empid',`dis_process`='$emppro',`dis_issuedate`='$issue',`dis_remarks`='$remarks',`dis_designation`='$empdesg',`dis_status`='2' WHERE `dis_barcode`='$ids'";
	
	$tres = mysqli_query($conn,$tsql);
	if($tres == true)
	{
		
		echo "<script>alert('Data Update Successfully!');window.location.href='laptop.php?adl=detail';</script>";
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
							// $sql = "SELECT * FROM `dis_laptop` WHERE dis_barcode='$id'";
							// $res = mysqli_query($conn,$sql);
							// $row = mysqli_fetch_array($res);
							// $qnt = $row['dis_quantity'];
							// $cnt = $row['dis_counter'];
							
								?>
								<form class="" method="POST" action="">
									<h4><?php echo "Laptop No: ".$id?></h4>
									<div class="form-group row">
										<div class="col-lg-6 col-md-6">
											<label>Employee Name :</label>
											<input type="text" name="empnam" class="form-control" required>
										</div>
										<div class="col-lg-6 col-md-6">
											<label>Employee ID :</label>
											<input type="text" name="empid" class="form-control" required>
										</div>

										
									</div>
									<div class="form-group row">
										<div class="col-lg-6 col-md-6">
											<label>Process :</label>
											<input type="text" name="emppro" class="form-control" required>
										</div>
										<div class="col-lg-6 col-md-6">
											<label>Designation :</label>
											<input type="text" name="empdesg" class="form-control" required>
										</div>

										
									</div>
									
									<div class="form-group row">
										
										<div class="col-lg-12 col-md-12">
											<label>Issue Date :</label>
											<input type="date" name="issue" class="form-control" required>
										</div>

										
									</div>
									<div class="form-group">
										<label>Any Comment :</label>
										<textarea class="form-control" name="remarks"></textarea>
									</div>
									<div class="form-group clearfix">
										<input type="submit" name="sublop" class="float-right btn btn-primary" value="Submit">
									</div>
								</form>
								<?php
							
						}
						else if($_GET['ids'])
                        {
                        	$ids = $_GET['ids'];
                        	$sql = "SELECT * FROM `dis_laptop` WHERE dis_barcode='$ids'";
							$res = mysqli_query($conn,$sql);
							$row = mysqli_fetch_array($res);
							
                        	?>
                            <form class="" method="POST" action="">
									<h4><?php echo "Laptop No: ".$ids?></h4>
									<div class="form-group row">
										<div class="col-lg-6 col-md-6">
											<label>Employee Name :</label>
											<input type="text" name="empnam" class="form-control" value="<?php echo $row['dis_empname'];?>">
										</div>
										<div class="col-lg-6 col-md-6">
											<label>Employee ID :</label>
											<input type="text" name="empid" class="form-control" value="<?php echo $row['dis_empid'];?>">
										</div>

										
									</div>
									<div class="form-group row">
										<div class="col-lg-6 col-md-6">
											<label>Process :</label>
											<input type="text" name="emppro" class="form-control" value="<?php echo $row['dis_process'];?>">
										</div>
										<div class="col-lg-6 col-md-6">
											<label>Designation :</label>
											<input type="text" name="empdesg" class="form-control" value="<?php echo $row['dis_designation'];?>">
										</div>

										
									</div>
									
									<div class="form-group row">
										
										<div class="col-lg-12 col-md-12">
											<label>Issue Date :</label>
											<input type="text" name="issue" class="form-control" value="<?php echo $row['dis_issuedate'];?>">
										</div>

										
									</div>
									<div class="form-group">
										<label>Any Comment :</label>
										<textarea class="form-control" name="remarks"></textarea>
									</div>
									<div class="form-group clearfix">
										<input type="submit" name="sublopt" class="float-right btn btn-primary" value="Submit">
									</div>
								</form>
                            <?php
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