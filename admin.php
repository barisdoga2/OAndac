<?php
session_start();
include_once "dbConnect.php";
include_once "config.php";
$infMsg = "";

if(isset($_GET["logout"])){
    session_destroy();
    header("Location: admin.php");
}

if(isset($_POST["submit"])){
    if(strcmp($_POST["password"], "9875123") == 0)
        $_SESSION["admin"] = true;
    else
        $infMsg = $infMsg."Admin Parolası Yalnış!<br>";
}

if(isset($_GET["approve"])){
    $yearbookApp = $conn->query("SELECT * FROM yearbook_apps WHERE id='".$_GET["approve"]."'")->fetch_assoc();
    if($yearbookApp["status"] == YEARBOOK_APP_WAITING){
        $conn->query("UPDATE yearbook_apps SET status='".YEARBOOK_APP_APPROVED."' WHERE id='".$_GET["approve"]."'");
        $yearbookApp = $conn->query("SELECT * FROM yearbook_apps WHERE id='".$_GET["approve"]."'")->fetch_assoc();

        $dateTime = date("Y-m-d H:i:s");
        $conn->query("INSERT INTO yearbooks (creator_id, title, school, start_date) VALUES ('".$yearbookApp["creator_id"]."', '".$yearbookApp["title"]."', '".$yearbookApp["school"]."', '".$dateTime."')");
        $yearbook = $conn->query("SELECT * FROM yearbooks WHERE start_date='".$dateTime."'")->fetch_assoc();

        $conn->query("INSERT INTO yearbook_apps_enrolls (creator_id, yearbook_app_id, status) VALUES ('".$yearbookApp["creator_id"]."', '".$yearbook["id"]."', '".YEARBOOK_ENROLL_APPROVED."')");
        $infMsg = $infMsg."Başarıyla Onaylandı!<br>";
    }
}else if(isset($_GET["reject"])){
    $conn->query("UPDATE yearbook_apps SET status='".YEARBOOK_APP_REJECTED."' WHERE id='".$_GET["reject"]."'");
    $infMsg = $infMsg."Başarıyla Reddedildi!<br>";
}


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
    <a class="navbar-brand" href="admin.php">E-Andaç</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <?php

        if(isset($_SESSION["admin"])){
            ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Logout">
                <a class="nav-link" href="admin.php?logout">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Çıkış Yap</span>
                </a>
            </li>
            <?php
        }

        ?>
        </ul>
    </div>
</nav>


<?php

if(isset($_SESSION["admin"])){
    ?>

    <div class="content-wrapper">
        <?php
        if($infMsg != ""){
            ?>
            <div class="card card-register mx-auto breadcrumb"><?php echo $infMsg; ?></div>
            <?php
        }
        ?>
        <div class="container">
            <div class="container-fluid">
                <div class="card mb-12">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Sistemdeki Bütün Yıllık Başvuruları Listeleniyor</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Oluşturan</th>
                                    <th>Başlık</th>
                                    <th>Okul</th>
                                    <th>Detaylar</th>
                                    <th>Onayla / Reddet</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Oluşturan</th>
                                    <th>Başlık</th>
                                    <th>Okul</th>
                                    <th>Detaylar</th>
                                    <th>Onayla / Reddet</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <?php

                                $sql = $conn->query("SELECT * FROM yearbook_apps");
                                while($row = $sql->fetch_assoc()){
                                    $creator = $conn->query("SELECT * FROM users WHERE id='".$row["creator_id"]."'")->fetch_assoc();
                                    ?>
                                    <tr>
                                        <td><?php echo $creator["namee"]." ".$creator["surname"]; ?></td>
                                        <td><?php echo $row["title"]; ?></td>
                                        <td><?php echo $row["school"]; ?></td>
                                        <td><?php echo $row["detailed_explanation"]; ?></td>
                                        <td>
                                            <?php
                                                if($row["status"] == YEARBOOK_APP_WAITING){
                                                    echo "<a href='admin.php?approve=".$row["id"]."'>Onayla</a> / <a href='admin.php?reject=".$row["id"]."'>Reddet</a>";
                                                }else if($row["status"] == YEARBOOK_APP_APPROVED){
                                                    echo "<font color='green'>Onaylandı!</font>";
                                                }else if($row["status"] == YEARBOOK_APP_REJECTED){
                                                    echo "<font color='red'>Reddedildi!</font>";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }

                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <?php
        include "footer.php";
        ?>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>
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

    <?php
}else{
    ?>

    <div class="content-wrapper">
        <?php
        if($infMsg != ""){
            ?>
            <div class="card card-register mx-auto breadcrumb"><?php echo $infMsg; ?></div>
            <?php
        }
        ?>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Admin Girişi</div>
            <div class="card-body">
                <form action="admin.php" method="post">
                    <div class="form-group">
                        <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Admin Parolası">
                    </div>

                    <button name="submit" class="btn btn-primary btn-block" href="admin.php">Giriş</button>
                </form>
            </div>
        </div>
    </div>

    <?php
}


?>

</body>

</html>
