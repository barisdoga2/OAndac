<div class="container-fluid">
    <div class="card mb-12">
        <div class="card-header">
            <i class="fa fa-table"></i> Kayıtlı Olduğunuz Yıllıklar Listeleniyor</div>
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
                        <th>Gör</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Başlık</th>
                        <th>Okul</th>
                        <th>Oluşturan</th>
                        <th>Başlangıç Tarihi</th>
                        <th>Bitiş Tarihi</th>
                        <th>Gör</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                        $sql = $conn->query("SELECT * FROM yearbook_apps_enrolls WHERE creator_id='".$_SESSION["id"]."' AND status='".YEARBOOK_ENROLL_APPROVED."'");

                        while($row = $sql->fetch_assoc()){
                            $yearbook = $conn->query("SELECT * FROM yearbooks WHERE id='".$row["id"]."'")->fetch_assoc();
                            $creator = $conn->query("SELECT * FROM users WHERE id='".$yearbook["creator_id"]."' LIMIT 1")->fetch_assoc();
                            ?>
                            <tr>
                                <td><?php echo $yearbook["title"]; ?></td>
                                <td><?php echo $yearbook["school"]; ?></td>
                                <td><?php echo $creator["namee"]." ".$creator["surname"]; ?></td>
                                <td><?php echo $yearbook["start_date"]; ?></td>
                                <td><?php echo $yearbook["end_date"]; ?></td>
                                <td><?php echo "<a href='index.php?task=yearBooks&subTask=viewYearBook&yearBookId=".$yearbook["id"]."'>Gör</a>"; ?></td>
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