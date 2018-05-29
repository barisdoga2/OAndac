<div class="container-fluid">
    <div class="card mb-12">
        <div class="card-header">
            <i class="fa fa-table"></i> Yıllık Başvurularınız Listeleniyor</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Başlık</th>
                        <th>Okul</th>
                        <th>Detaylar</th>
                        <th>Kabul Durumu</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Başlık</th>
                        <th>Okul</th>
                        <th>Detaylar</th>
                        <th>Kabul Durumu</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                    $sql = $conn->query("SELECT * FROM yearbook_apps WHERE creator_id='".$_SESSION["id"]."'");

                    while($row = $sql->fetch_assoc()){
                        $creator = $conn->query("SELECT * FROM users WHERE id='".$row["creator_id"]."' LIMIT 1")->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo $row["school"]; ?></td>
                            <td><?php echo $row["detailed_explanation"]; ?></td>
                            <td>
                            <?php
                                if($row["status"] == YEARBOOK_APP_WAITING)
                                    echo "Beklemede";
                                else if($row["status"] == YEARBOOK_APP_REJECTED)
                                    echo "<font color='red'>Reddedildi!</font>";
                                else if($row["status"] == YEARBOOK_APP_APPROVED)
                                    echo "<font color='green'>Onaylandı!</font>";
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
        <a name="update" class="btn btn-primary btn-block" href="index.php?task=yearBooks&subTask=newYearBookApp">Yeni Yıllık Başvurusunda Bulun!</a>
    </div>
</div>