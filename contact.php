<body class="bg-dark">
<div class="container">
    <div class="mb-0 mt-4">
        <i class="fa fa-newspaper-o"></i> İletişim</div>
    <hr class="mt-2">
    <?php

    if(isset($_POST["submit"])){
        ?>
        <div class="card card-register mx-auto breadcrumb"><font color="green">Mesajınız Başarıyla Alınmıştır!</font></div>
        <?php
    }

    ?>
    <div class="row">
        <div class="col-md-6">
            <form action="index.php?task=contact" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Adınız Soyadınız*</label>
                    <input name="namesurname" class="form-control" type="text" aria-describedby="textHelp" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email Adresiniz*</label>
                    <input class="form-control" type="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mesajınız*</label>
                    <input class="form-control" type="text" placeholder="">
                </div>
                <button name="submit" class="btn btn-primary btn-block" href="index.php?task=contact">Gönder</button>
            </form>
        </div>
        <div class="col-md-6">
            <label>Size Yardımcı Olmaya Hazırız</label><br>
            <label>Soru, öneri ve bilgilendirme için yandaki iletişim formunu kullanarak bize mesaj gönderebilirsiniz. İlgili birimimiz mümkün olan en kısa sürede size dönüş yapacaktır.</label><br>
        </div>
    </div>
</div>