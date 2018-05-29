<div class="container-fluid">
    <div class="card mb-12">
        <div class="card-header">
            <i class="fa fa-table"></i> Sizin Oluşturduğunuz Yıllıklar Listeleniyor</div>
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
                        <th>Yönet</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Başlık</th>
                        <th>Okul</th>
                        <th>Oluşturan</th>
                        <th>Başlangıç Tarihi</th>
                        <th>Bitiş Tarihi</th>
                        <th>Yönet</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                        $sql = $conn->query("SELECT * FROM yearbooks WHERE creator_id='".$_SESSION["id"]."'");

                        while($row = $sql->fetch_assoc()){
                            $creator = $conn->query("SELECT * FROM users WHERE id='".$row["creator_id"]."' LIMIT 1")->fetch_assoc();
                            ?>
                            <tr>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["school"]; ?></td>
                                <td><?php echo $creator["namee"]." ".$creator["surname"]; ?></td>
                                <td><?php echo $row["start_date"]; ?></td>
                                <td><?php echo $row["end_date"]; ?></td>
                                <td><?php echo "<a href='index.php?task=yearBooks&subTask=manageYearBook&yearBookId=".$row["id"]."'>Yönet</a>"; ?></td>
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