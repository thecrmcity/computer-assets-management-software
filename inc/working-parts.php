<?php
include('header.php');
?>
<?php
if(isset($_POST['saveparts']))
{	
	
	$parts = implode(',',$_POST['parts']);
	$parts = explode(',',$parts);
	$numparts = implode(',',$_POST['numparts']);
	$numparts = explode(',',$numparts);

	$mi = $_GET['mi'];
	$mid = substr($mi,0,3);
	
	$sql = "SELECT dis_sno FROM dis_workingparts ORDER BY dis_sno DESC LIMIT 1";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);

	date_default_timezone_set('Asia/Kolkata');
	$sdate = date('Y-m-d h:i:s');
	
	if(mysqli_num_rows($res) > 0)
    {
    	
		
    	$rowid = @$row['dis_sno'];
		$pid = 'SILPARTS'.$rowid;
    }
	else
    {
    	$pid = 'SILPARTS0';
    }
    	switch($mid)
        {
        case "OLD":
        
        $mergeparts = array_combine($parts,$numparts);
		foreach($mergeparts as $key => $val)
    	{
    		$sql =  "INSERT INTO `dis_workingparts`(`dis_itemid`, `dis_item_name`, `dis_quantity`, `dis_comcode`, `dis_camname`, `dis_status`, `dis_updateon`) VALUES ('$pid','$key','$val','$mi','$mid','1','$sdate')";
        	$res = mysqli_query($conn,$sql);
        	
        	$updata = "UPDATE dis_alldata SET dis_status='12' WHERE dis_comcode='$mi'";
        	mysqli_query($conn,$updata);
        	if($res == true)
            {
            	header('Location:receipt-scrap.php');
            }
        	else
            {
            	echo "<script>alert('Something Went Wrong!');</script>";
            }
    	}
        break;
        default:
         $mergeparts = array_combine($parts,$numparts);
		foreach($mergeparts as $key => $val)
    	{
    		$sql =  "INSERT INTO `dis_workingparts`(`dis_itemid`, `dis_item_name`, `dis_quantity`, `dis_comcode`, `dis_camname`, `dis_status`, `dis_updateon`) VALUES ('$pid','$key','$val','$mi','NEW','1','$sdate')";
        	$res = mysqli_query($conn,$sql);
        
        	$updata = "UPDATE dis_alldata SET dis_status='12' WHERE dis_comcode='$mi'";
        	mysqli_query($conn,$updata);
        	if($res == true)
            {
            	header('Location:receipt-scrap.php');
            }
        	else
            {
            	echo "<script>alert('Something Went Wrong!');</script>";
            }
    	}
        break;
        }
}
    	
    
	


	

?>
<?php
if(isset($_POST['sublopt']))
{	
	
	$parts = implode(',',$_POST['parts']);
	$parts = explode(',',$parts);
	$numparts = implode(',',$_POST['numparts']);
	$numparts = explode(',',$numparts);

	$lap = $_GET['lap'];
	
	
	$sql = "SELECT dis_sno FROM dis_workingparts ORDER BY dis_sno DESC LIMIT 1";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);

	date_default_timezone_set('Asia/Kolkata');
	$sdate = date('Y-m-d h:i:s');
	
	if(mysqli_num_rows($res) > 0)
    {
    	
		
    	$rowid = @$row['dis_sno'];
		$pid = 'SILPARTS'.$rowid;
    }
	else
    {
    	$pid = 'SILPARTS0';
    }
    	echo "<pre>";
        $mergeparts = array_combine($parts,$numparts);
        
		foreach($mergeparts as $key => $val)
    	{
    		$sql =  "INSERT INTO `dis_workingparts`(`dis_itemid`, `dis_item_name`, `dis_quantity`, `dis_comcode`, `dis_camname`, `dis_status`, `dis_updateon`) VALUES ('$pid','$key','$val','$lap','Laptop','1','$sdate')";
        	$res = mysqli_query($conn,$sql);
        	
        	$updata = "UPDATE dis_laptop SET dis_status='12' WHERE dis_barcode='$lap'";
        	mysqli_query($conn,$updata);
        	if($res == true)
            {
            	header('Location:receipt-scrap.php');
            }
        	else
            {
            	echo "<script>alert('Something Went Wrong!');</script>";
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
				<div class="col-lg-6 col-md-6 mt-5">
					<?php
						if(isset($_GET['mi']) AND isset($_GET['pi']))
						{
							$mi = $_GET['mi'];
                        	$pi = $_GET['pi'];
							
							
								?>
								<form class="" method="POST" action="">
                                	<div class="form-group row">
                                		<div class="col-lg-6 col-md-6">
                                			<?php $mi = $_GET['mi'];
												$mid = substr($mi,0,3); 
                        						echo $mi;?>
                                		</div>
                                		<div class="col-lg-6 col-md-6">
                                         <?php switch($mid){ case"OLD":echo "Old Computer Set";break;case"LAP":echo "Laptop";break; default:echo "New Computer Set";}?>   
                                         </div>
                                	</div>
                                	<div class="form-group row">
                                		
                                			
                                    <?php
                                		
                                        $sql = "SELECT DISTINCT dis_assets FROM dis_computer WHERE dis_assets NOT IN ('Old Computer Set','New Computer Set','Software')";
                                        $res = mysqli_query($conn,$sql);
                        				
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            ?>
                                            <div class="col-lg-3">
                                            <span class="font-weight-bold text-primary"><?php echo $row['dis_assets'];?></span>
                                            <input type="hidden" value="<?php echo $row['dis_assets'];?>" name="parts[]">
                                            <input type="number" min="0" max="10" value="0" class="form-control mb-3" name="numparts[]">
                                            </div>
                                            
                                            
                                            <?php
                                            
                                        }
                                    ?>
                                    
                                	</div>
                                    <div class="form-group">
                                    	<input type="submit" value="Submit" class="btn btn-primary float-right" name="saveparts">
                                    </div>
                                	
                                </form>
								<?php
							
						}
						else if($_GET['lap'])
                        {
                        	$lap = $_GET['lap'];
                        	$sql = "SELECT * FROM `dis_laptop` WHERE dis_barcode='$lap'";
							$res = mysqli_query($conn,$sql);
							$row = mysqli_fetch_array($res);
							
                        	?>
                            <form class="" method="POST" action="">
									<h4><?php echo "Laptop No: ".$lap?></h4>
									<br>
									<div class="form-group row">
									<?php
                                		$assets = array('RAM','HDD','FAN','CD-ROM','DISPLAY','BATTERY','CHARGER','INCHES');
                                		
                                        foreach($assets as $aval)
                                        	{
                                            ?>
                                            <div class="col-lg-3">
                                            <span class="font-weight-bold text-primary"><?php echo $aval;?></span>
                                            <input type="hidden" value="<?php echo $aval;?>" name="parts[]">
                                            <input type="number" min="0" max="10" value="0" class="form-control mb-3" name="numparts[]">
                                            </div>
                                            
                                            
                                            <?php
                                            }
                                        
                                    ?>
                                </div>
									<div class="form-group clearfix">
										<input type="submit" name="sublopt" class="float-right btn btn-primary" value="Submit">
									</div>
								</form>
                            <?php
                        }
					?>
				</div>
				<div class="col-lg-6 col-md-6 mt-5"></div>

			</div>
			
	
		</div>
	</div>
	

</div>
<?php
include('footer.php');
?>