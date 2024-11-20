<?php
include('header.php');
?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			
		</div>
	</div>
	<div class="mainbar">
		<div class="container mt-5">
			<div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
					<thead class="bgsky">
						<tr>
						<th class="sticky-top">S.No.</th>
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
						<th class="sticky-top">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET['id']) AND isset($_GET['set']))
						{

				$id = $_GET['id'];
				$set = $_GET['set'];

				$nums = 1;
				$mvql = "SELECT * FROM `dis_alldata` WHERE dis_code='$id' AND dis_pname='$set'";
				$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
								<tr>
									<td><?php echo $nums;?></td>
									<td><?php echo $mrow['dis_pdate'];?></td>
									<?php
									$netv = $mrow['dis_status'];
									switch($netv)
									{
										case "1":
										echo '<td class="bg-success text-white text-center">'.$mrow['dis_comcode'].'</td>';
										break;
										case "2":
										echo '<td class="bg-danger text-white text-center">'.$mrow['dis_comcode'].'</td>';
										break;
										case "5":
										echo '<td class="bg-warning text-center">'.$mrow['dis_comcode'].'</td>';
										break;
                                    	case "3":
										echo '<td class="bg-warning text-center">'.$mrow['dis_comcode'].'</td>';
										break;
                                    	case "11":
										echo '<td class="bg-dark text-center text-white">'.$mrow['dis_comcode'].'</td>';
										break;
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
									<?php
									$netv = $mrow['dis_status'];
									switch($netv)
									{
										case "1":
										echo '<td class="bg-success text-white text-center">Balance</td>';
										break;
										case "2":
										echo '<td class="bg-danger text-white text-center">ON Floor</td>';
										break;
										case "5":
										echo '<td class="bg-warning text-center">Repairing</td>';
										break;
                                    	case "3":
										echo '<td class="bg-warning text-center">Repairing</td>';
										break;
                                    	case "11":
										echo '<td class="bg-dark text-center text-white">Dump</td>';
										break;
									}
									

									?>

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
</div>
<?php
include('footer.php');
?>