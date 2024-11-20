<?php
session_start();
include('../config.php');
$uname = $_SESSION['uname'];
$uemail = $_SESSION['uemail'];
$upost = $_SESSION['post'];
if(!isset($_SESSION['uname']))
{
  header('Location:../logout.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Silaris IT Inventory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="icon" type="image/gif" href="../assets/img/fevicon.png">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/Chart.min.js"></script>
    
</head>
<body>
  <div class="top-nav-menu">
    <nav class="navbar navbar-expand-md mynavcolor">
    <!-- Brand -->
    <a class="navbar-brand navmt" href="dashboard.php"><img src="../assets/img/logo.png"></a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <?php
        if(isset($_SESSION['post']))
        {
          $upost = $_SESSION['post'];
          switch($upost)
          {
            case "IT":
            ?>
            <ul class="navbar-nav ml-5">
            <li class="nav-item">
                <a class="nav-link dashb" href="dashboard.php">Dashboard</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="software.php">Software</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="server.php">Server</a>
              </li> -->
            
            <li class="nav-item">
              <a class="nav-link" href="user.php"><i class="fa fa-user"></i> <?php echo $uname;?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link logto" href="../logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </li>
          </ul>
            <?php
            break;
            case "User":
            ?>
            <ul class="navbar-nav ml-5">
              <li class="nav-item">
                <a class="nav-link dashb" href="dashboard.php">Dashboard</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Assets</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="assets.php">Assets Creation</a>
                  <a class="dropdown-item" href="receipt.php">Assets Receipt</a>
                  <a class="dropdown-item" href="assets-data.php?show=New%20Computer%20Set">Assets Data</a>
                  
            
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transfer.php">Transfer</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="laptop.php?adl=add">Laptop</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="email-report.php">Email Report</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="user.php"><i class="fa fa-user"></i> <?php echo $uname;?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link logto" href="../logout.php"><i class="fa fa-power-off"></i> Logout</a>
              </li>
            </ul>
            <?php
            break;
            default:
            ?>
            <ul class="navbar-nav ml-5">
        <li class="nav-item">
          <a class="nav-link dashb" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Assets</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="assets.php">Assets Creation</a>
            <a class="dropdown-item" href="receipt.php">Assets Receipt</a>
            <a class="dropdown-item" href="assets-data.php?show=New%20Computer%20Set">Assets Data</a>
            <a class="dropdown-item" href="receipt-scrap.php">Scrap Assets</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transfer.php">Transfer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="software.php">Software</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="laptop.php?adl=add">Laptop</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="server.php?adl=add">Server</a>
              </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Admin Assets</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="electronic.php">Electronics</a>
            <a class="dropdown-item" href="non-electronic.php">Non-Electronics</a>
            
          </div>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="user.php"><i class="fa fa-user"></i> <?php echo $uname;?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link logto" href="../logout.php"><i class="fa fa-power-off"></i> Logout</a>
        </li>
      </ul>
            <?php
            break;

          }
        }
      ?>
      
    </div>
  </nav>
  </div>