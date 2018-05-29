<?php

if(isset($_GET["approve"])){
    $conn->query("UPDATE yearbook_apps_enrolls SET status='".YEARBOOK_ENROLL_APPROVED."' WHERE yearbook_app_id='".$_GET["yearBookId"]."' AND creator_id='".$_GET["approve"]."'")
    ?>
    <div class="card card-register mx-auto breadcrumb"><font color='green'>Başarıyla Onaylandı!</font></div>
    <?php
}else if(isset($_GET["reject"])){
    $conn->query("UPDATE yearbook_apps_enrolls SET status='".YEARBOOK_ENROLL_REJECTED."' WHERE yearbook_app_id='".$_GET["yearBookId"]."' AND creator_id='".$_GET["reject"]."'")
    ?>
    <div class="card card-register mx-auto breadcrumb"><font color='red'>Başarıyla Reddedildi!</font></div>
    <?php
}

if(isset($_GET["finalize"])){
    $conn->query("UPDATE yearbooks SET end_date='".date("Y-m-d H:i:s")."' WHERE id='".$_GET["yearBookId"]."'");
    echo $conn->error;
    ?>
    <div class="card card-register mx-auto breadcrumb"><font color='green'>Yıllık Başarıyla Bitirildi!</font></div>
    <?php
}

$enrolledUsers = $conn->query("SELECT * FROM yearbook_apps_enrolls WHERE yearbook_app_id='".$_GET["yearBookId"]."'");

if(isset($_GET["userId"])){
    if($_GET["userId"] == $_SESSION["id"])
        echo "Its me!";
    else
        echo "Its another person";
}



?>

<div class="container-fluid">
    <div class="card mb-12">
        <div class="card-header">
            <i class="fa fa-table"></i> Yıllığa Kayıtlı Başvurular Listeleniyor!</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Isim - Soyisim</th>
                        <th>Email</th>
                        <th>Onayla / Reddet</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Isim - Soyisim</th>
                        <th>Email</th>
                        <th>Onayla / Reddet</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                    while($row = $enrolledUsers->fetch_assoc()){
                        $enrolledUser = $conn->query("SELECT * FROM users WHERE id='".$row["creator_id"]."'")->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $enrolledUser["namee"]." ".$enrolledUser["surname"]; ?></td>
                            <td><?php echo $enrolledUser["email"]; ?></td>
                            <td>
                                <?php
                                if($row["status"] == YEARBOOK_ENROLL_WAITING){
                                    $yearBook = $conn->query("SELECT * FROM yearbooks WHERE id='".$_GET["yearBookId"]."' LIMIT 1")->fetch_assoc();
                                    if($yearBook["end_date"] == null)
                                        echo "<a href='index.php?task=yearBooks&subTask=manageYearBook&yearBookId=".$_GET["yearBookId"]."&approve=".$enrolledUser["id"]."'>Onayla</a> / <a href='index.php?task=yearBooks&subTask=manageYearBook&yearBookId=".$_GET["yearBookId"]."&reject=".$enrolledUser["id"]."'>Reddet</a>";
                                    else
                                        echo "Bu Yıllık Bitirildi!";
                                }else
                                    if($row["status"] == YEARBOOK_ENROLL_APPROVED)
                                        echo "<font color='green'>Onaylandı!</font>";
                                    else
                                        echo "<font color='red'>Reddedildi!</font>";
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
        <?php
        $yearBook = $conn->query("SELECT * FROM yearbooks WHERE id='".$_GET["yearBookId"]."' LIMIT 1")->fetch_assoc();
            if($yearBook["end_date"] == null){
                ?>
                <font color="red">Dikkat: Bu işlem gerçekleştirildiği zaman, yıllık kullanıcıları profilleri okuyabilecek ve artık yeni kullanıcı eklenemeyecek. <b>Bu İşlem Geri Alınamaz!</b></font>
                <a name="update" class="btn btn-primary btn-block" href="index.php?task=yearBooks&subTask=manageYearBook&yearBookId=<?php echo $_GET["yearBookId"]; ?>&finalize">Yıllığı Bitir!</a>
                <?php
            }
        ?>
    </div>
</div>
