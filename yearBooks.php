<?php

$totalYearBooks = $conn->query("SELECT * FROM yearbooks")->num_rows;
$totalEnrolledYearBooks = $conn->query("SELECT * FROM yearbook_apps_enrolls WHERE creator_id='".$_SESSION["id"]."'")->num_rows;
$totalOwnedYearBooks = $conn->query("SELECT * FROM yearbooks WHERE creator_id='".$_SESSION["id"]."'")->num_rows;
$totalYearBookApps = $conn->query("SELECT * FROM yearbook_apps WHERE creator_id='".$_SESSION["id"]."'")->num_rows;

?>

<div class="container">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">Sistemde Toplamda <?php echo $totalYearBooks; ?> Yıllık Mevcut!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="index.php?task=yearBooks&subTask=allYearBooks">
                    <span class="float-left">Mevcut Yıllıkları Görüntüle</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>


        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Toplamda <?php echo $totalEnrolledYearBooks; ?> Yıllığa Kaydınız Var</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="index.php?task=yearBooks&subTask=myEnrolledYearBooks">
                    <span class="float-left">Kayıtlı Yıllıklarımı Görüntüle</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Sahip Olduğunuz <?php echo $totalOwnedYearBooks; ?> Yıllığınız Var</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="index.php?task=yearBooks&subTask=myYearBooks">
                    <span class="float-left">Yıllıklarımı Görüntüle ve Yönet</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Mevcut <?php echo $totalYearBookApps; ?> Yıllık Başvurunuz Var</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="index.php?task=yearBooks&subTask=myYearBookApps">
                    <span class="float-left">Yıllık Başvurularımı Görüntüle</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>
    </div>

    <?php


    if(isset($_GET["subTask"]))

        switch ($_GET["subTask"]){

            case "allYearBooks":
                include "allYearBooks.php";
                break;

            case "myYearBooks":
                include "myYearBooks.php";
                break;

            case "myYearBookApps":
                include "myYearBookApps.php";
                break;

            case "myEnrolledYearBooks":
                include "myEnrolledYearBooks.php";
                break;

            case "newYearBookApp":
                include "newYearBookApp.php";
                break;

            case "manageYearBook":
                include "manageYearBook.php";
                break;

            case "viewYearBook":
                include "viewYearBook.php";
                break;

            case "enrollToYearBook":
                $conn->query("INSERT INTO yearbook_apps_enrolls (creator_id, yearbook_app_id, status) VALUES ('".$_SESSION["id"]."', '".$_GET["yearBookId"]."', '".YEARBOOK_ENROLL_WAITING."')");
                ?>
                <div class="card card-register mx-auto breadcrumb">Kayıt İsteğiniz Başarıyla Alınmıştır!</div>
                <?php
                break;

        }

    ?>



</div>

