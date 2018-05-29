<?php

if(isset($_POST["submit"])){

    if($conn->query("SELECT * FROM yearbook_apps WHERE status='".YEARBOOK_APP_WAITING."' AND creator_id='".$_SESSION["id"]."'")->num_rows > 0){
        ?>
        <div class="card card-register mx-auto breadcrumb">Beklemede en fazla 1 başvurunuz olabilir!</div>
        <?php
    }else{
        if(strlen($_POST["title"]) > 2 && strlen($_POST["school"]) > 2 && strlen($_POST["details"]) > 2){

            $conn->query("INSERT INTO yearbook_apps (creator_id, title, school, status, detailed_explanation) VALUES ('".$_SESSION["id"]."', '".$_POST["title"]."', '".$_POST["school"]."', '".YEARBOOK_APP_WAITING."', '".$_POST["details"]."')");
            ?>
            <div class="card card-register mx-auto breadcrumb"><font color="green">Başvurunuz Başarıyla Alınmıştır!</font></div>
            <?php

        }else{
            ?>
            <div class="card card-register mx-auto breadcrumb">Başlık, Okul ve Detay 2 Harfden Uzun Olmalıdır!</div>
            <?php
        }
    }

}

?>

<div class="card card-register mx-auto">
    <div class="card-header">Yeni Yıllık Başvurusu</div>
    <div class="card-body">
        <form action="index.php?task=yearBooks&subTask=newYearBookApp" method="post">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="exampleInputName">Başlık</label>
                        <input name="title" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Başlık">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="exampleInputName">Okul</label>
                        <input name="school" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Okul">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="exampleInputName">Detaylı Bilgi</label>
                        <input name="details" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Lütfen Detaylı Bilgi Giriniz.">
                    </div>
                </div>
            </div>
            <button name="submit" class="btn btn-primary btn-block" href="index.php?task=yearBooks&subTask=newYearBookApp">Başvuruyu Gönder</button>
        </form>
    </div>
</div>