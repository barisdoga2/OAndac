<?php

include_once "dbConnect.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Start Bootstrap Template</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <?php
            include "logo.php";
        ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <?php
                include "leftPane.php";
                include "topPane.php";
            ?>
        </div>
    </nav>

    <div class="content-wrapper">

        <!-- Content -->
        <?php

            if(isset($_GET["task"])){
                switch ($_GET["task"]){

                    case "homepage":
                        include "mainPage.php";
                        break;

                    case "login":
                        include "login.php";
                        break;

                    case "register":
                        include "register.php";
                        break;

                    case "gallery":
                        include "gallery.php";
                        break;

                    case "aboutUs":
                        include "aboutUs.php";
                        break;

                    case "contact":
                        include "contact.php";
                        break;

                    default:
                        include "mainPage.php";
                        break;
                }
            }else{
                include "mainPage.php";
            }

            include "footer.php";
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
