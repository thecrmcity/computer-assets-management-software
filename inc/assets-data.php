<?php
include('header.php');
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu">
				<p>Resources</p>
					<ul class="nav flex-column">
						
						<li class="navitem"><a href="assets-data.php?show=New Computer Set" class="navlink">New Computer <i class="	fa fa-angle-double-right"></i></a></li>
						<li class="navitem"><a href="assets-data.php?show=Old Computer Set" class="navlink">Old Computer <i class="	fa fa-angle-double-right"></i></a></li>
						<?php
							$sql = "SELECT * FROM `dis_products` GROUP BY dis_proname";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="assets-data.php?show=<?php echo $row['dis_proname'];?>" class="navlink"><?php echo $row['dis_proname'];?> <i class="	fa fa-angle-double-right"></i></a></li>
							<?php
						}
						?>
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
						if(isset($_GET['show']))
						{
							$show = $_GET['show'];
						$nums = 1;
						$mvql = "SELECT * FROM `dis_alldata` WHERE dis_pname='$show' AND dis_status='2'";
						$mvres = mysqli_query($conn,$mvql);
						while($mrow = mysqli_fetch_array($mvres))
						{
							?>
							<tr>
								<td><?php echo $nums;?></td>
								
								<td><?php echo $mrow['dis_comcode'];?></td>
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
											echo '<span class="wefire">Repairing</span>';
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
						$mvql = "SELECT * FROM `dis_alldata` WHERE dis_status='2'";
						$mvres = mysqli_query($conn,$mvql);
						while($mrow = mysqli_fetch_array($mvres))
						{

						?>	
						<tr>
								<td><?php echo $nums;?></td>
								
								<td><?php echo $mrow['dis_comcode'];?></td>
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
											echo '<span class="wefire">Repairing</span>';
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
			
		</form>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		  $(".chk_all").click(function(){
		    $(".chk_me").prop('checked', this.checked);
		  });
		  
		  
		});
	</script>

</div>
<?php
include('footer.php');
?>