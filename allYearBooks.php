<div class="container-fluid">
    <div class="card mb-12">
        <div class="card-header">
            <i class="fa fa-table"></i> Sistemdeki Bütün Yıllıklar Listeleniyor</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Başlık</th>
                        <th>Okul</th>
                        <th>Oluşturan</th>
                        <th>Başlangıç Tarihi</th>
                        <th>Bitiş Tarihi</th>
                        <th>Kayıt İsteği Gönder</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Başlık</th>
                        <th>Okul</th>
                        <th>Oluşturan</th>
                        <th>Başlangıç Tarihi</th>
                        <th>Bitiş Tarihi</th>
                        <th>Kayıt İsteği Gönder</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                        $sql = $conn->query("SELECT * FROM yearbooks");

                        while($row = $sql->fetch_assoc()){
                            $creator = $conn->query("SELECT * FROM users WHERE id='".$row["creator_id"]."' LIMIT 1")->fetch_assoc();
                            $enrollRequests = $conn->query("SELECT * FROM yearbook_apps_enrolls WHERE creator_id='".$_SESSION["id"]."' AND yearbook_app_id='".$row["id"]."'");
                            ?>
                            <tr>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["school"]; ?></td>
                                <td><?php echo $creator["namee"]." ".$creator["surname"]; ?></td>
                                <td><?php echo $row["start_date"]; ?></td>
                                <td><?php echo $row["end_date"]; ?></td>
                                <td>
                                    <?php

                                    if($enrollRequests->num_rows > 0){
                                        $enrollRequests = $enrollRequests->fetch_assoc();
                                        if($enrollRequests["status"] == YEARBOOK_ENROLL_WAITING)
                                            echo "Beklemede!";
                                        else if($enrollRequests["status"] == YEARBOOK_ENROLL_REJECTED)
                                            echo "<font color='red'>Reddedildi!</font>";
                                        else if($enrollRequests["status"] == YEARBOOK_ENROLL_APPROVED)
                                            echo "<font color='green'>Onaylandı!</font>";
                                    }else{
                                        if($row["end_date"] != null) {
                                            echo "Bu Yıllık Bitti!";
                                        }else{
                                            echo "<a href='index.php?task=yearBooks&subTask=enrollToYearBook&yearBookId=".$row["id"]."'>Kayıt İsteği Gönder</a>";
                                        }
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
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>