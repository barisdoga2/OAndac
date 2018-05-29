<?php

$enrolledUsers = $conn->query("SELECT * FROM yearbook_apps_enrolls WHERE yearbook_app_id='".$_GET["yearBookId"]."' AND status='".YEARBOOK_ENROLL_APPROVED."'");
$yearBook = $conn->query("SELECT * FROM yearbooks WHERE id='".$_GET["yearBookId"]."'")->fetch_assoc();

$infMsg = "";
if(isset($_GET["userId"])){
    $user = $conn->query("SELECT * FROM users WHERE id='".$_GET["userId"]."'")->fetch_assoc();
    $yearbookCommentOnUser = $conn->query("SELECT * FROM yearbook_comments WHERE  to_yearbook_id='".$_GET["yearBookId"]."' AND to_user_id='".$user["id"]."'");

    if(isset($_POST["update"])){
        if($yearbookCommentOnUser->num_rows == 0)
            $conn->query("INSERT INTO yearbook_comments (creator_id, to_yearbook_id, to_user_id, message, date_time) VALUES ('".$_SESSION["id"]."', '".$yearBook["id"]."', '".$user["id"]."', '".$_POST["message"]."', '".date("Y-m-d H:i:s")."')");
        else
            $conn->query("UPDATE yearbook_comments SET message='".$_POST["message"]."' WHERE id='".$yearbookCommentOnUser->fetch_assoc()["id"]."'");

        $infMsg = $infMsg."Mesajınız Başarıyla Kaydedilmiştir!";
    }

    $yearbookCommentOnUser = $conn->query("SELECT * FROM yearbook_comments WHERE  to_yearbook_id='".$_GET["yearBookId"]."' AND to_user_id='".$user["id"]."'");

    if($infMsg != ""){
        ?>
        <div class="card card-register mx-auto breadcrumb"><?php echo $infMsg; ?></div>
        <?php
    }
    ?>

    <div class="card card-register mx-auto">

        <div class="card-header col-md-12"><font color="blue"><?php echo $user["namee"]." ".$user["surname"]; ?></font> Kullanıcısın <font color="blue"><?php echo $yearBook["title"]; ?></font> Yıllığının Profili</div>
        <div class="card-body">
            <img class="col-md-12" src="<?php echo $user["profilepic"]; ?>">
            <hr class="mt-3">
            <div class='card-footer small text-muted'>
            <?php

            if($yearBook["end_date"] == null){
                echo "Bu Yıllık Bitirilmediği İçin Diğer Kullanıcıların Mesajlarını Göremezsiniz!<hr>";
                if(isset($_GET["userId"])){
                    if($_GET["userId"] == $_SESSION["id"]){
                        echo "Kendi Profilinize Mesaj Bırakamzsınız!<hr>";
                    }else{
                        if($yearbookCommentOnUser->num_rows == 0){
                            $oldMsg = "";
                            echo "<font color='red'>Daha Önce Gönderilmiş Mesajınız Bulunamadı!</font>";
                        }else{
                            echo "<font color='green'>Daha Öncedem Gönderilmiş Mesajınız Bulundu!</font>";
                            $oldMsg = $yearbookCommentOnUser->fetch_assoc()["message"];
                        }
                        ?>
                        <form action="index.php?task=yearBooks&subTask=viewYearBook&yearBookId=<?php echo $_GET["yearBookId"]; ?>&userId=<?php echo $_GET["userId"];?>" method="post">
                            <textarea name="message" class="form-control" rows="4" cols="50"><?php echo $oldMsg; ?></textarea>
                            <button name="update" class="btn btn-primary btn-block" href="index.php?task=yearBooks&subTask=viewYearBook&yearBookId=<?php echo $_GET["yearBookId"]; ?>&userId=<?php echo $_GET["userId"];?>">Güncelle</button>
                        </form>
                        <?php
                    }
                }
            }else{
                echo "Bu Yıllık Bitirildiği İçin Güncelleme Yapamazsınız!";
                $allYearbookCommentsOnUser = $conn->query("SELECT * FROM yearbook_comments WHERE to_user_id='".$user["id"]."' AND to_yearbook_id='".$yearBook["id"]."' ORDER BY date_time DESC");
                while($row = $allYearbookCommentsOnUser->fetch_assoc()){
                    $sender = $conn->query("SELECT * FROM users WHERE id='".$row["creator_id"]."'")->fetch_assoc();
                    ?>
                    <hr>
                    <form>
                        <label for="message">Kullanıcı: <?php echo $sender["namee"]." ".$sender["surname"]; ?><br>Tarih Saat: <?php echo $row["date_time"];?></label>
                        <textarea name="message" disabled="" class="form-control" rows="4" cols="50"><?php echo $row["message"]; ?></textarea>
                    </form>
                    <hr>
                    <?php
                }
            }

            ?>
            </div>
        </div>
    </div>

    <br>
    <hr class="mt-2">
    <br>
    <?php
}


?>

<div class="container-fluid">
    <div class="card mb-12">
        <div class="card-header">
            <i class="fa fa-table"></i> Yıllığa Kayıtlı Kişiler Listeleniyor!</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Isim - Soyisim</th>
                        <th>Email</th>
                        <th>Yıllık Profilini Görüntüle</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Isim - Soyisim</th>
                        <th>Email</th>
                        <th>Yıllık Profilini Görüntüle</th>
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
                            <td><?php echo "<a href='index.php?task=yearBooks&subTask=viewYearBook&yearBookId=".$_GET["yearBookId"]."&userId=".$enrolledUser["id"]."'>Profilini Görüntüle</a>" ?></td>

                        </tr>
                        <?php
                    }

                    ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>
