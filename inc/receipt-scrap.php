<?php
include('header.php');
?>
<?php
if(isset($_GET['mi']) AND isset($_GET['pi']))
{
	  $trash = $_GET['mi'];
	  $sik = $_GET['pi'];
	  date_default_timezone_set("Asia/Kolkata");
  	  $mydate = date('Y-m-d');
	  $tip = "SELECT dis_counter FROM `dis_computer` WHERE dis_code='$sik'";
      $rip = mysqli_query($conn,$tip);
      $prw = mysqli_fetch_array($rip);
      $pct = $prw['dis_counter'];
      $dict = $pct-1;

      
        $sql = "UPDATE `dis_alldata` SET  dis_issueto='',dis_building='',dis_location='',dis_branch='', dis_repairon='$mydate', dis_status='1' WHERE dis_code='$sik' AND dis_comcode='$trash'";
        mysqli_query($conn,$sql);
        $tips = "UPDATE `dis_computer` SET dis_counter='$dict' WHERE dis_code='$sik'";
        if(mysqli_query($conn,$tips) == true)
        {
          header('Location:receipt-scrap.php');
        }

}

?>
<?php
if(isset($_GET['lap']))
{
	  $trash = $_GET['lap'];
	  $sik = $_GET['pi'];
	  date_default_timezone_set("Asia/Kolkata");
  	  $mydate = date('Y-m-d');
	  $tip = "SELECT dis_counter FROM `dis_lapreciept` WHERE dis_code='$sik'";
      $rip = mysqli_query($conn,$tip);
      $prw = mysqli_fetch_array($rip);
      $pct = $prw['dis_quantity'];
      $dict = $pct+1;

      
        $sql = "UPDATE `dis_laptop` SET  dis_returndate='$mydate', dis_status='1' WHERE dis_code='$sik' AND dis_barcode='$trash'";
        mysqli_query($conn,$sql);
        $tips = "UPDATE `dis_lapreciept` SET dis_quantity='$dict' WHERE dis_code='$sik'";
        if(mysqli_query($conn,$tips) == true)
        {
          header('Location:receipt-scrap.php');
        }

}

?>
<div class="main-cont">
	<div class="sidebar">
		<div class="sidebar-set">
			<div class="fistmenu mb-4">
				<p>Computer Set</p>
					<ul class="nav flex-column">
						
						<?php
							$sql = "SELECT COUNT(dis_sno) AS anum, dis_pname,dis_psubname FROM `dis_alldata` WHERE dis_status IN('11','12') AND (dis_pname='New Computer Set' OR dis_pname='Old Computer Set') GROUP BY dis_pname";
						$res = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res))
						{
							?>
							<li class="navitem"><a href="receipt-scrap.php?add=<?php echo $row['dis_pname']; ?>" class="navlink"><span class="navlink"><?php echo $row['dis_pname'];?></span> <span class="badge badge-danger"><?php echo $row['anum'];?></span></a></li>
							<?php
						}
						?>
						
						
					</ul>
			</div>
                        <div class="fistmenu mb-4">
				<p>Other Hardware</p>
					<ul class="nav flex-column">
						
						<?php
							$sqlv = "SELECT COUNT(dis_sno) AS anumv, dis_pname FROM `dis_alldata` WHERE dis_status='11' AND dis_pname!='New Computer Set' AND dis_pname!='Old Computer Set' GROUP BY dis_pname";
						$resv = mysqli_query($conn,$sqlv);
						while($rowv = mysqli_fetch_array($resv))
						{
							?>
							<li class="navitem"><a href="receipt-scrap.php?add=<?php  echo $rowv['dis_pname'];?>" class="navlink"><span class="navlink"><?php echo $rowv['dis_pname'];?></span> <span class="badge badge-danger"><?php echo $rowv['anumv'];?></span></a></li>
							<?php
						}
						?>
						
						
					</ul>
			</div>
                        <div class="fistmenu mb-4">
				<p>Laptop</p>
					<ul class="nav flex-column">
						
						<?php
							$sqlv = "SELECT COUNT(dis_sno) AS lapnum FROM `dis_laptop` WHERE dis_status IN ('11','12')";
						$resv = mysqli_query($conn,$sqlv);
						while($rowv = mysqli_fetch_array($resv))
						{
							?>
							<li class="navitem"><a href="receipt-scrap.php?add=laptop" class="navlink"><span class="navlink"> Laptop </span> <span class="badge badge-danger"><?php echo $rowv['lapnum'];?></span></a></li>
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
					
				</div>

			</div>

			
					
						<?php
						if(isset($_GET['add']))
						{
							$add = $_GET['add'];
                        	switch($add)
                            {
                            case "Old Computer Set":
                            ?>
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
                        <th class="sticky-top">Action</th>
                        <th class="sticky-top">Working Parts</th>
						</tr>
					</thead>
					<tbody>
                            <?php
                            $nums = 1;
							$mvql = "SELECT * FROM `dis_alldata` WHERE (dis_psubname='$add' OR dis_pname='$add') AND dis_status IN ('11','12')";
							$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
								<tr>
									<td><?php echo $nums;?></td>
									<td><?php echo $add;?></td>
									<td><?php echo $mrow['dis_pdate'];?></td>
                                    <td class='bg-dark text-white text-center'><?php echo $mrow['dis_comcode'];?></td>
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
									<td><a href="?mi=<?php echo $mrow['dis_comcode'];?>&pi=<?php echo $mrow['dis_code'];?>" class="suppbnt">In Stock</a></td>
									<td>
                                    <?php if($mrow['dis_status'] == '11')
                                    		{
                                    			?>
                                                <a href="working-parts.php?mi=<?php echo $mrow['dis_comcode'];?>&pi=<?php echo $mrow['dis_code'];?>" class="histbnt">Input <i class="fa fa-arrow-right"></i></a>
                                                <?php
                                    		}
                            				else
                                            {
                                            	echo "";
                                            }
                                    
                                    ?>
                                    </td>
                                    </tr>
								<?php
								$nums++;
							}
                            ?>
                            </tbody>
				</table>
			</div>
                            <?php
                           	break;
                            case "New Computer Set":
                            ?>
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
                        <th class="sticky-top">Action</th>
                        <th class="sticky-top">Working Parts</th>
						</tr>
					</thead>
					<tbody>
                            <?php
                            $nums = 1;
							$mvql = "SELECT * FROM `dis_alldata` WHERE (dis_psubname='$add' OR dis_pname='$add') AND dis_status IN ('11','12')";
							$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
								<tr>
									<td><?php echo $nums;?></td>
									<td><?php echo $add;?></td>
									<td><?php echo $mrow['dis_pdate'];?></td>
									 <td class='bg-dark text-white text-center'><?php echo $mrow['dis_comcode'];?></td>
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
									<td><a href="?mi=<?php echo $mrow['dis_comcode'];?>&pi=<?php echo $mrow['dis_code'];?>" class="suppbnt">Back to Stock</a></td>
									<td>
                                    <?php if($mrow['dis_status'] == '11')
                                    		{
                                    			?>
                                                <a href="working-parts.php?mi=<?php echo $mrow['dis_comcode'];?>&pi=<?php echo $mrow['dis_code'];?>" class="histbnt">Input <i class="fa fa-arrow-right"></i></a>
                                                <?php
                                    		}
                            				else
                                            {
                                            	echo "";
                                            }
                                    
                                    ?>
                                    </td>
								</tr>
								<?php
								$nums++;
							}
                            ?>
                            </tbody>
				</table>
			</div>
                            <?php
                            break;
                            case "laptop":
                            ?>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered table-striped table-hover">
                            <thead class="bgsky">
                        <tr>
                        <th class="sticky-top">S.No.</th>
                        <th class="sticky-top">Laptop Code</th>
                        <th class="sticky-top">Employee ID</th>
                        <th class="sticky-top">Full Name</th>
                        <th class="sticky-top">Process</th>
                        <th class="sticky-top">Designation</th>
                        <th class="sticky-top">Laptop Brand</th>
                        <th class="sticky-top">Features</th>
                        <th class="sticky-top">Serial No</th>
                        <th class="sticky-top">Issue Date</th>
                        <th class="sticky-top">Return Date</th>
                        <th class="sticky-top">Action</th>
                       	<th class="sticky-top">Working Parts</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $nums = 1;
					$mvql = "SELECT * FROM `dis_laptop` WHERE dis_status IN('11','12')";
					$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
                                <td><?php echo $nums;?></td>
                                <td><?php echo $mrow['dis_barcode'];?></td>
                                <td><?php echo $mrow['dis_empid'];?></td>
                                <td><?php echo $mrow['dis_empname'];?></td>
                                <td><?php echo $mrow['dis_process'];?></td>
                                <td><?php echo $mrow['dis_designation'];?></td>
                                <td><?php echo $mrow['dis_lapname'];?></td>
                                <td><?php echo $mrow['dis_lapfeature'];?></td>
                                <td><?php echo $mrow['dis_serialno'];?></td>
                                <td><?php echo $mrow['dis_issuedate'];?></td>
                                <td><?php echo $mrow['dis_returndate'];?></td>
                                
                                <td><a href="?lap=<?php echo $mrow['dis_barcode'];?>&pi=<?php echo $mrow['dis_code'];?>" class="suppbnt">Back to Stock</a></td>
                                <td>
                                		<?php
                                		if($mrow['dis_status'] == '12')
                                		{
                                				echo "";
                                		}
                                		else
                                		{
                                			?>
                                			<a href="working-parts.php?lap=<?php echo $mrow['dis_barcode'];?>&pi=<?php echo $mrow['dis_code'];?>" class="histbnt">Input <i class="fa fa-arrow-right"></i></a>
                                			<?php
                                		}
                                		?>
                                	</td>
                                <?php
                                $nums++;
                            }
                            ?>
                            </tbody>
				</table>
			</div>
                            <?php
                            break;
                            default:
                            ?>
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
                        <th class="sticky-top">Action</th>
						</tr>
					</thead>
					<tbody>
                            <?php
                            $nums = 1;
					$mvql = "SELECT * FROM `dis_alldata` WHERE dis_pname NOT IN('Old Computer Set','New Computer Set','Software') AND dis_status IN ('11','12')";
					$mvres = mysqli_query($conn,$mvql);
							while($mrow = mysqli_fetch_array($mvres))
							{
								?>
								<tr>
									<td><?php echo $nums;?></td>
									<td><?php echo $mrow['dis_pname'];?></td>
									<td><?php echo $mrow['dis_pdate'];?></td>
									<?php
									$netv = $mrow['dis_status'];
									if($netv == "11")
									{
										echo '<td class="bg-dark text-white text-center">'.$mrow['dis_comcode'].'</td>';
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
									<td><a href="?mi=<?php echo $mrow['dis_comcode'];?>&pi=<?php echo $mrow['dis_code'];?>" class="suppbnt">Back to Stock</a></td>

								</tr>
								<?php
								$nums++;
							}
                            ?>
                            </tbody>
				</table>
			</div>
                            <?php
                            break;
                            }
							
                        }
						else
                        {
                        	?>
                            <div class="row">
                            	<div class="col-lg-6 col-md-6 mt-4">
                            <?php
                            	$sql = "SELECT * FROM dis_alldata WHERE dis_pname IN('Old Computer Set','New Computer Set') AND dis_status IN('11','12')";
                        		$res = mysqli_query($conn,$sql);
                        		$cont = mysqli_num_rows($res);
                        
                        		$sqle = "SELECT * FROM dis_alldata WHERE dis_pname IN('Old Computer Set','New Computer Set') AND dis_status='12'";
                        		$rese = mysqli_query($conn,$sqle);
                        		$conte = mysqli_num_rows($rese);
                        		
                        		$sqld = "SELECT * FROM dis_alldata WHERE dis_pname IN('Old Computer Set','New Computer Set') AND dis_status='5'";
                        		$resd = mysqli_query($conn,$sqld);
                        		$contd = mysqli_num_rows($resd);
                            ?>
					<table class="table table-bordered mb-5">
								            	<tbody><tr>
                	<td colspan="10" class="text-center bg-dark text-white font-weight-bold">All Scrap Computer Summary</td>
            	</tr>
				<tr>
					<td class="bg-info font-weight-bold text-white">Scrap Stock</td>
					<td class="bg-info font-weight-bold text-white"><?php echo $cont;?></td>
					<td class="bg-warning font-weight-bold">Supply Scrap</td>
					<td class="bg-warning font-weight-bold"></td>
                	<td class="bg-success font-weight-bold text-white">Balance Scrap</td>
					<td class="bg-success font-weight-bold text-white"></td>
					<td class="bg-primary font-weight-bold text-white">Repair Item</td>
					<td class="bg-primary font-weight-bold text-white"></td>
                    <td class="bg-danger font-weight-bold text-white">Dead</td>
					<td class="bg-danger font-weight-bold text-white"><?php echo $conte;?></td>
					
				</tr>
									</tbody>
                            </table>
					
					
					
				</div>
                            <div class="col-lg-6 col-md-6 mt-4">
                            <table class="table table-bordered mb-5">
                    <?php
                    	$lapsql = "SELECT * FROM `dis_laptop` WHERE dis_status IN ('11','12')";
                        $lapres = mysqli_query($conn,$lapsql);
                        $lapnum = mysqli_num_rows($lapres);
                        
                        $dapsql = "SELECT * FROM `dis_laptop` WHERE dis_status IN ('12')";
                        $dapres = mysqli_query($conn,$dapsql);
                        $dapnum = mysqli_num_rows($dapres);
                    ?>
								            	<tbody><tr>
                	<td colspan="10" class="text-center bg-dark text-white font-weight-bold">All Scrap Laptop Summary</td>
            	</tr>
				<tr>
					<td class="bg-info font-weight-bold text-white">Scrap Stock</td>
					<td class="bg-info font-weight-bold text-white"><?php echo $lapnum;?></td>
					<td class="bg-warning font-weight-bold">Supply Scrap</td>
					<td class="bg-warning font-weight-bold"></td>
                	<td class="bg-success font-weight-bold text-white">Balance Scrap</td>
					<td class="bg-success font-weight-bold text-white"></td>
					<td class="bg-primary font-weight-bold text-white">Repair Item</td>
					<td class="bg-primary font-weight-bold text-white"></td>
                    <td class="bg-danger font-weight-bold text-white">Dead</td>
					<td class="bg-danger font-weight-bold text-white"><?php  echo $dapnum;?></td>
					
				</tr>
									</tbody>
                            </table>
                            </div>
                            </div>
                            
                            
                            <?php
                        }
						
						?>	
					
		</div>
	</div>

</div>
<?php
include('footer.php');
?>