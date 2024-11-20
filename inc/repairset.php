<?php
include('header.php');
?>
<?php
if(isset($_POST['picsub']))
{
	$setno = $_POST['setno'];
	$piece = $_POST['piece'];
	$fixture = $_POST['fixture'];
	$piext = $_POST['piext'];
	date_default_timezone_set("Asia/Kolkata");
	$mydate = date('Y-m-d');

	$mysql = "SELECT * FROM dis_alldata WHERE dis_comcode='$setno'";
	$myres = mysqli_query($conn,$mysql);
	$myrow = mysqli_fetch_array($myres);
	$mynam = $myrow['dis_pname'];
	$myissu = $myrow['dis_issueto'];
	$myloc = $myrow['dis_location'];
	$mybra = $myrow['dis_branch'];
	$mybil = $myrow['dis_building'];
	$myiday = $myrow['dis_issuedate'];
	$mycont = $myrow['dis_counter'];
	$myrep = $myrow['dis_repairon'];

	if($piece == "other")
	{
		$sql = "INSERT INTO `dis_repair`(`dis_barcode`, `dis_pname`, `dis_issueto`, `dis_building`, `dis_location`, `dis_branch`, `dis_issuedate`, `dis_counter`, `dis_requiredset`, `dis_comment`, `dis_reparirby`, `dis_reprairon`, `dis_status`) VALUES ('$setno','$mynam','$myissu','$mybil','$myloc','$mybra','$myiday','$mycont','$fixture','$piext','$uname','$myrep','1')";

		
		$res = mysqli_query($conn,$sql);
		$tmp = "UPDATE `dis_alldata` SET dis_status='4' WHERE dis_comcode='$setno'";
		mysqli_query($conn,$tmp);
		if($res == true)
		{
			header('Location:repair.php');
		}
	}
	else
	{
		$sql = "INSERT INTO `dis_repair`(`dis_barcode`, `dis_pname`, `dis_issueto`, `dis_building`, `dis_location`, `dis_branch`, `dis_issuedate`, `dis_counter`, `dis_requiredset`, `dis_comment`, `dis_reparirby`, `dis_reprairon`, `dis_status`) VALUES ('$setno','$mynam','$myissu','$mybil','$myloc','$mybra','$myiday','$mycont','$piece','$piext','$uname','$myrep','1')";
		
		$res = mysqli_query($conn,$sql);
		$tmp = "UPDATE `dis_alldata` SET dis_status='4' WHERE dis_comcode='$setno'";
		mysqli_query($conn,$tmp);
		if($res == true)
		{
			header('Location:repair.php');
		}
	}
	

}
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>Repairing Set</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="repair.php" class="navlink">Dashboard <i class="fa fa-angle-double-right" ></i></a></li>
						<?php
							$sql = "SELECT * FROM `dis_computer` WHERE dis_assets IN('New Computer Set','Old Computer Set') GROUP BY dis_assets";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="repair.php?p=<?php echo $row['dis_assets'];?>" class="navlink"><?php echo $row['dis_assets'];?> <i class="	fa fa-angle-double-right"></i></a></li>
							<?php
						}
						?>
						
					</ul>
			</div>
		</div>
	</div>
	<div class="mainbar">
		
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 mt-5">
					<?php
						if(isset($_GET['rep']))
						{
							$rep = $_GET['rep'];
							?>
							<form class="" method="POST" action="">
								<div class="form-group row">
									<div class="col-md-6 col-lg-6">
										<label></label>
										<h5 class="text-danger font-weight-bold"><?php echo $rep;?></h5>
									<input type="hidden" name="setno" value="<?php echo $rep;?>">
									</div>
									<div class="col-lg-6 col-md-6">
										<label>Damage Piece</label>
									<select class="form-control" name="piece" required>
									<option value="" disabled="" selected="">Select Piece</option>
											<option value="Hard Disk">Hard Disk</option>
											<option value="RAM">RAM</option>
											<option value="SMPS">SMPS</option>
											<option value="Processor FAN">Processor FAN</option>
											<option value="VGA Cable">VGA Cable</option>
											<option value="Power Cable">Power Cable</option>
											<option value="Keyboard">Keyboard</option>
											<option value="Mouse">Mouse</option>
											<option value="Cabinet">Cabinet</option>
											<option value="TFT">TFT</option>
											<option value="Mother Board">Mother Board</option>
											<option value="other">Other</option>
										</select>
									</div>
									
								</div>
								<div class="form-group">
									<label>Any Comment <small>For Other (optional)</small></label>
									<input type="text" class="form-control" name="fixture" placeholder="Other Assets...">
								</div>
								<div class="form-group">
									<label>Any Comment</label>
									<textarea class="form-control" name="piext" placeholder="Any Comment..."></textarea>
								</div>
								<div class="form-group">
									<input type="submit" name="picsub" value="Submit" class="btn btn-primary">
								</div>
							</form>
							<?php
						}
					?>
				</div>
				<div class="col-lg-6 col-md-6"></div>

			</div>
		</div>
	</div>

</div>

<?php
include('footer.php');
?>