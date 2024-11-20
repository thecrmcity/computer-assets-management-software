<?php
include('header.php');

?>

<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>Transfer</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="transfer.php" class="navlink">New Computer <i class="fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="transfer.php?add=Old Computer Set" class="navlink">Old Computer <i class="fa fa-angle-double-right"></i></a></li>
						
					</ul>
			</div>
		</div>
	<div class="sidebar-set">
			<div class="fistmenu">
				<p>Transfer By Set</p>
					<ul class="nav flex-column">
						<li class="navitem"><a href="transferset.php" class="navlink">New Computer <i class="fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="transfersetold.php" class="navlink">Old Computer <i class="fa fa-angle-double-right"></i></a></li>
						
					</ul>
			</div>
		</div>
	</div>
	<div class="mainbar">
		<div class="container">
<div class="my-3">
			<form method="GET">
				<select name="process" class="" required>
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
                                    <select class="" name="build" required>
									<option value="" selected="" disabled="">Select Building</option>
									<option value="14/1">14/1</option>
									<option value="14/2">14/2</option>
									<option value="14/3">14/3</option>
									<option value="A-6">A-6</option>
                                	<option value="A-7">A-7</option>
                                	<option value="A-1">A-1</option>
                                    <option value="A-21/24">A-21/24</option>
									<option value="Other">Other</option>

								</select>
                                    <select class="" name="loc">
									<option value="" selected="" disabled="">Select Location</option>
									<option value="Basement">Basement</option>
									<option value="Ground Floor">Ground Floor</option>
									<option value="First Floor">First Floor</option>
									<option value="Second Floor">Second Floor</option>
									<option value="Third Floor">Third Floor</option>
									<option value="Fourth Floor">Fourth Floor</option>
								</select>
                                    <button type="submit"><i class="fa fa-search"></i> Find</button>
			</form>
                                    </div>
			<form class="" method="POST" action="functions.php">
			<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
						<th class="sticky-top"><div class="custom-control custom-switch"><input type="checkbox" name="" value="" class="chk_all custom-control-input" id="switch1"><label class="custom-control-label" for="switch1"> </label> </div></th>
						<th class="sticky-top">Barcode</th>
						<th class="sticky-top">Assets Name</th>
						<th class="sticky-top">Process</th>
						<th class="sticky-top">Building</th>
						<th class="sticky-top">Location</th>
						<th class="sticky-top">Branch</th>
						<th class="sticky-top">Issue Date</th>
						<th class="sticky-top">Purchase Date</th>
						<th class="sticky-top">Repair No</th>
						<th class="sticky-top">Repair In</th>
						<th class="sticky-top">Repair Out</th>
						<th class="sticky-top">Status</th>
						
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET['process']) AND isset($_GET['build']) AND isset($_GET['loc']))
                            {
                            $add = "Old Computer Set";
                        	$pro = $_GET['process'];
                        	$buil = $_GET['build'];
                        	$loc = $_GET['loc'];
							$nums = 1;
							$mvql = "SELECT * FROM `dis_alldata` WHERE (dis_issueto ='$pro' AND dis_building ='$buil' AND dis_location ='$loc') AND dis_pname ='$add' AND dis_status='2'";
							$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
							?>
                            <tr>
								<td><?php echo $nums;?></td>
								<td><input type="checkbox" name="cancode[]" class="chk_me" value="<?php echo $mrow['dis_comcode'];?>" id="pid<?php echo $nums;?>"></td>
								<td><?php echo $mrow['dis_comcode'];?><input type="checkbox" name="pcode[]"  class="chk_me" value="<?php echo $mrow['dis_code'].'@'.$nums;?>" id="sid<?php echo $nums;?>" hidden></td>
								<td><?php echo $mrow['dis_pname'];?></td>
								<td><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['dis_issuedate'];?></td>
								<td><?php echo $mrow['dis_pdate'];?></td>
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
											echo '<span class="tefire">Repairing</span>';
											break;
										}
										
									?>
									</td>
									
							</tr>
                                    <?php
							$nums++;
							}
                            }
                        	else
                            {
                            $add = "Old Computer Set";
                        	
							$nums = 1;
							$mvql = "SELECT * FROM `dis_alldata` WHERE  dis_pname ='$add' AND dis_status='2'";
							$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
							?>
                            	<tr>
								<td><?php echo $nums;?></td>
								<td><input type="checkbox" name="cancode[]" class="chk_me" value="<?php echo $mrow['dis_comcode'];?>" id="pid<?php echo $nums;?>"></td>
								<td><?php echo $mrow['dis_comcode'];?><input type="checkbox" name="pcode[]"  class="chk_me" value="<?php echo $mrow['dis_code'].'@'.$nums;?>" id="sid<?php echo $nums;?>" hidden></td>
								<td><?php echo $mrow['dis_pname'];?></td>
								<td><?php echo $mrow['dis_issueto'];?></td>
								<td><?php echo $mrow['dis_building'];?></td>
								<td><?php echo $mrow['dis_location'];?></td>
								<td><?php echo $mrow['dis_branch'];?></td>
								<td><?php echo $mrow['dis_issuedate'];?></td>
								<td><?php echo $mrow['dis_pdate'];?></td>
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
											echo '<span class="tefire">Repairing</span>';
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
			<div class="form-inline clearfix mt-3">
				
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
                                    <select class="form-control mx-3" name="build" required>
									<option value="" selected="" disabled="">Select Building</option>
									<option value="14/1">14/1</option>
									<option value="14/2">14/2</option>
									<option value="14/3">14/3</option>
									<option value="A-6">A-6</option>
                                	<option value="A-7">A-7</option>
                                	<option value="A-1">A-1</option>
                                    <option value="A-21/24">A-21/24</option>
									<option value="Other">Other</option>

								</select>
                                    <select class="form-control mr-3" name="loc">
									<option value="" selected="" disabled="">Select Location</option>
									<option value="Basement">Basement</option>
									<option value="Ground Floor">Ground Floor</option>
									<option value="First Floor">First Floor</option>
									<option value="Second Floor">Second Floor</option>
									<option value="Third Floor">Third Floor</option>
									<option value="Fourth Floor">Fourth Floor</option>
								</select>
                                    <select class="form-control" name="branch" required>
									<option value="" selected="" disabled="">Select Branch</option>
									<option value="New Delhi">New Delhi</option>
									<option value="Gurugram">Gurugram</option>
									<option value="Noida">Noida</option>
									<option value="Pune">Pune</option>
									<option value="Mumbai">Mumbai</option>
                                    <option value="Banglore">Banglore</option>
								</select>
					<input type="submit" name="transeferold" class="btn btn-primary ml-4">
				
			</div>
			</form>
		</div>
	</div>

</div>
<script type="text/javascript">
	<?php
		
        $mvql = "SELECT * FROM `dis_alldata` WHERE dis_pname='Old Computer Set' AND dis_status='2'";
		$mvres = mysqli_query($conn,$mvql);
        $j = mysqli_num_rows($mvres);
        	for($i=1;$i<=$j;$i++)
            {
			?>
			var chke<?php echo $i;?> = $("#pid<?php echo $i;?>");
			var chkf<?php echo $i;?> = $("#sid<?php echo $i;?>");

			chke<?php echo $i;?>.on('change', function(){
		  	chkf<?php echo $i;?>.prop('checked',this.checked);
				});
			<?php
			}
        
	?>
	

	
</script>
<?php
include('footer.php');
?>