<?php

$ppErrorMsg = "";
if(isset($_POST["update"])){

    if(@$_FILES["fileToUpload"]["name"]){
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $ppErrorMsg = $ppErrorMsg."Sorry, only JPG, JPEG AND PNG files are allowed.<br>";
                $uploadOk = 0;
            }else{
                if (file_exists($target_file)) {
                    $target_file = $target_dir . generateRandomString(5) .".".pathinfo($target_file, PATHINFO_EXTENSION);
                }
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $conn->query("UPDATE users SET profilepic='".$target_file."' WHERE email='".$_SESSION["email"]."'");
                    $ppErrorMsg = $ppErrorMsg."Avatarınız Başarıyla Güncellendi!<br>";
                } else {
                    $ppErrorMsg = $ppErrorMsg."Sorry, there was an error uploading your file.<br>";
                }
            }
        } else {
            $ppErrorMsg = $ppErrorMsg."File is not an image.<br>";
        }
    }

    if(isset($_POST["npassword"]) && isset($_POST["npassword2"]) && isset($_POST["opassword"])){
        if($_POST["npassword"] != "" && $_POST["npassword2"] != "" && $_POST["opassword"] != "")
            if($_POST["npassword"] == $_POST["npassword2"]){
                if($conn->query("SELECT * FROM users WHERE email='".$_SESSION["email"]."' AND password='".md5($_POST["opassword"])."'")->num_rows > 0){
                    $conn->query("UPDATE users SET password='".md5($_POST["npassword"])."' WHERE email='".$_SESSION["email"]."'");
                    $ppErrorMsg = $ppErrorMsg."Parolanız Güncellendi!<br>";
                }else{
                    $ppErrorMsg = $ppErrorMsg."Güncel Parolanız Yanlış!<br>";
                }
            }else{
                $ppErrorMsg = $ppErrorMsg."Parolalar Eşleşmiyor!<br>";
            }
    }


}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
<?php
if($ppErrorMsg != ""){
    ?>
    <div class="card card-register mx-auto breadcrumb"><?php echo $ppErrorMsg; ?></div>
    <?php
}
?>
<div class="card card-register mx-auto">

    <div class="card-header">Profilim</div>
    <div class="card-body">
        <form method="post" action="index.php?task=profile" enctype="multipart/form-data">
            <div class="form-group">
                <?php
                $userRow = $conn->query("SELECT * FROM users WHERE email='".$_SESSION["email"]."'")->fetch_assoc();
                ?>
                <img class="col-md-12" src=<?php echo $userRow["profilepic"]; ?>
                <hr>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <hr>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" disabled="" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder=<?php echo $_SESSION["email"]; ?>>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputName">İsim</label>
                        <input name="name" disabled="" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder=<?php echo $_SESSION["namee"]; ?>>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputLastName">Soyisim</label>
                        <input name="surname" disabled="" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder=<?php echo $_SESSION["surname"]; ?>>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" disabled="" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder=<?php echo $_SESSION["email"]; ?>>
            </div>
            <hr>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="exampleInputPassword1">Güncel Parola</label>
                        <input name="opassword" class="form-control" id="exampleInputPassword1" type="password" placeholder="Güncel Parola">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleConfirmPassword">Yeni Parola</label>
                        <input name="npassword" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Yeni Parola">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleConfirmPassword">Yeni Parola Tekrarı</label>
                        <input name="npassword2" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Yeni Parola Tekrarı">
                    </div>
                </div>
            </div>
            <button name="update" class="btn btn-primary btn-block" href="index.php?task=profile">Güncelle</button>
        </form>
    </div>
</div>