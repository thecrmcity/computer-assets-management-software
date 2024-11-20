<?php
include('../config.php');

if(isset($_POST['transeferold']))
{
  $tsname = $_POST['tsname'];
  date_default_timezone_set("Asia/Kolkata");
  $mydate = date('Y-m-d');

  $cancode = $_POST['cancode'];
  $pcode = $_POST['pcode'];
  $metlife = array_combine($pcode,$cancode);
echo "<pre>";
	print_r($metlife);
	
}
?>
