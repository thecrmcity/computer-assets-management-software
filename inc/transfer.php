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
					
						<?php
							$sql = "SELECT * FROM `dis_products` GROUP BY dis_proname";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="transfer.php?add=<?php echo $row['dis_proname'];?>" class="navlink"><?php echo $row['dis_proname'];?> <i class="	fa fa-angle-double-right"></i></a></li>
							<?php
						}
						?>
						
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
			
			<form class="" method="POST" action="functions.php">
			<div class="table-wrapper-scroll-y my-custom-scrollbar mt-5">
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
						if(isset($_GET['add']))
						{
							$add = $_GET['add'];
							$nums = 1;
							$mvql = "SELECT * FROM `dis_alldata` WHERE dis_pname ='$add' AND dis_status='2'";
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

						$nums = 1;
						$mvql = "SELECT * FROM `dis_alldata` WHERE dis_pname='New Computer Set' AND dis_status='2'";
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
				
					<select class="form-control" name="tsname">
						<option value="" disabled="" selected="">Select Transfer For...</option>
						<option value="Repairing">For Repairing</option>
						<option value="Stock">To Stock</option>
						<option value="Scrap">To Scrap</option>
					</select>
					<input type="submit" name="savetab" class="btn btn-primary ml-4">
				
			</div>
			</form>
		</div>
	</div>

</div>
<script type="text/javascript">
	<?php
		if(isset($_GET['add']))
		{
        	$add = $_GET['add'];
        	
        	$mvql = "SELECT * FROM `dis_alldata` WHERE dis_pname='$add' AND dis_status='2'";
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
        }
		else
        {
        $mvql = "SELECT * FROM `dis_alldata` WHERE dis_pname='New Computer Set' AND dis_status='2'";
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
        }
	?>
	

	
</script>
<?php
include('footer.php');
?>