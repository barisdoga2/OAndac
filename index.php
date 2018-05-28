<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
session_start();
include_once "dbConnect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>E-Andaç</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <?php
  include_once "logo.php";
  ?>
   <div class="collapse navbar-collapse" id="navbarResponsive">
        <?php
        include_once "leftPane.php";
        ?>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <?php
      include_once "topPane.php";
      ?>
    </div>
  </nav>
  <div class="content-wrapper">

    <?php

        if(isset($_GET["task"])){
            switch ($_GET["task"]){

                case "mainPage":
                    include_once "mainPage.php";
                    break;

                case "aboutUs":
                    include_once "aboutUs.php";
                    break;

                case "profile":
                    include_once "profile.php";
                    break;

                case "gallery":
                    include_once "gallery.php";
                    break;

                case "contact":
                    include_once "contact.php";
                    break;

                default:
                    include_once "mainPage.php";
            }
        }else{
            include_once "mainPage.php";
        }

    include_once "footer.php";
    ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin.min.js"></script>
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
