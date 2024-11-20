<?php
session_start();
include('../config.php');
$uname = $_SESSION['uname'];
$uemail = $_SESSION['uemail'];
if(!isset($_SESSION['uname']))
{
  header('Location:../logout.php');
}
?>
<?php

if(isset($_POST['savetab']))
{
  $tsname = $_POST['tsname'];
  date_default_timezone_set("Asia/Kolkata");
  $mydate = date('Y-m-d');

  $cancode = $_POST['cancode'];
  $pcode = $_POST['pcode'];
  $metlife = array_combine($pcode,$cancode);
	

  switch($tsname)
  {
  	case "Scrap":
   	foreach($metlife as $pid => $trash)
    {
    	$sik = substr($pid,0,strpos($pid,'@'));
    	
    	$sql = "UPDATE `dis_alldata` SET  dis_repairon='$mydate', dis_status='11' WHERE dis_code='$sik' AND dis_comcode='$trash'";
        mysqli_query($conn,$sql);
        if(mysqli_query($conn,$sql) == true)
        {
          header('Location:transfer.php');
        }
    }
   
    break;
    case "Repairing":
    foreach($metlife as $pid => $trash)
    {
    	$sik = substr($pid,0,strpos($pid,'@'));
      $ctn = "SELECT dis_code, dis_counter FROM `dis_alldata` WHERE dis_comcode='$trash'";
      $crs = mysqli_query($conn,$ctn);
      $crw = mysqli_fetch_array($crs);
      $dcnt = $crw['dis_counter'];
      
      $ccnt = $dcnt+1;

      $tip = "SELECT dis_counter FROM `dis_computer` WHERE dis_code='$sik'";
      $rip = mysqli_query($conn,$tip);
      $prw = mysqli_fetch_array($rip);
      $pct = $prw['dis_counter'];
      $dict = $pct-1;
      if($dcnt = "")
      {
        $sql = "UPDATE `dis_alldata` SET  dis_counter='1', dis_repairon='$mydate', dis_status='3' WHERE dis_code='$sik' AND dis_comcode='$trash'";
        mysqli_query($conn,$sql);
        $tips = "UPDATE `dis_computer` SET dis_counter='$dict' WHERE dis_code='$sik'";
        if(mysqli_query($conn,$tips) == true)
        {
          header('Location:transfer.php');
        }
      }
      else
      {
        $sql = "UPDATE `dis_alldata` SET  dis_counter='$ccnt', dis_repairon='$mydate', dis_status='3' WHERE dis_code='$sik' AND dis_comcode='$trash'";
        mysqli_query($conn,$sql);
        $tips = "UPDATE `dis_computer` SET dis_counter='$dict' WHERE dis_code='$sik'";
        if(mysqli_query($conn,$tips) == true)
        {
          header('Location:transfer.php');
        }
      }
      
    }
    break;
    case "Stock":
    foreach($metlife as $pid => $trash)
    {
    	$sik = substr($pid,0,strpos($pid,'@'));
      
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
          header('Location:transfer.php');
        }
      
      
    }
    break;
  	
  }
}
if(isset($_POST['transeferset']))
{
	$process = $_POST['process'];
	$build = $_POST['build'];
	$loc = $_POST['loc'];
	$branch = $_POST['branch'];

	date_default_timezone_set("Asia/Kolkata");
  	$mydate = date('Y-m-d');

  	$cancode = $_POST['cancode'];
  	$pcode = $_POST['pcode'];
  	$metlife = array_combine($pcode,$cancode);

	foreach($metlife as $pid => $trash)
    {
    	$sik = substr($pid,0,strpos($pid,'@'));
    	
    	$sql = "UPDATE `dis_alldata` SET  dis_issueto='$process',dis_building='$build',dis_location='$loc',dis_branch='$branch',dis_issuedate='$mydate' WHERE dis_code='$sik' AND dis_comcode='$trash'";
        $res = mysqli_query($conn,$sql);
        if($res == true)
        {
          header('Location:transferset.php');
        }
    }

}
if(isset($_POST['transeferold']))
{
	$process = $_POST['process'];
	$build = $_POST['build'];
	$loc = $_POST['loc'];
	$branch = $_POST['branch'];

	date_default_timezone_set("Asia/Kolkata");
  	$mydate = date('Y-m-d');

  	$cancode = $_POST['cancode'];
  	$pcode = $_POST['pcode'];
  	$metlife = array_combine($pcode,$cancode);

	foreach($metlife as $pid => $trash)
    {
    	$sik = substr($pid,0,strpos($pid,'@'));
    	
    	$sql = "UPDATE `dis_alldata` SET  dis_issueto='$process',dis_building='$build',dis_location='$loc',dis_branch='$branch',dis_issuedate='$mydate' WHERE dis_code='$sik' AND dis_comcode='$trash'";
        $res = mysqli_query($conn,$sql);
        if($res == true)
        {
          header('Location:transferset.php');
        }
    }

}
?>












