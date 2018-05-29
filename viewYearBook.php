<?php

$enrolledUsers = $conn->query("SELECT * FROM yearbook_apps_enrolls WHERE yearbook_app_id='".$_GET["yearBookId"]."' AND status='".YEARBOOK_ENROLL_APPROVED."'");

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
