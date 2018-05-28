<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
session_start();
include_once "dbConnect.php";


$errorMsg = "";
if(isset($_POST["login"])){
    if($conn->query("SELECT * FROM users WHERE email='".$_POST["email"]."' AND password='".md5($_POST["password"])."' LIMIT 1")->num_rows != 0) {
        $userRow = $conn->query("SELECT * FROM users WHERE email='" . $_POST["email"] . "' LIMIT 1")->fetch_assoc();
        $_SESSION["login"] = true;
        $_SESSION["id"] = $userRow["id"];
        $_SESSION["namee"] = $userRow["namee"];
        $_SESSION["surname"] = $userRow["surname"];
        $_SESSION["email"] = $userRow["email"];
        header("Location: index.php");
    }else{
        $errorMsg = "Kullanıcı Adı ve/veya Şifre Hatalı";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-Andaç</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <?php
    include_once "logo.php";
    ?>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <?php
        include_once "leftPane.php";
        ?>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <?php
        include_once "topPane.php";
        ?>
    </div>
</nav>
    <div class="content-wrapper">
        <?php
        if($errorMsg != ""){
            ?>
            <div class="card card-register mx-auto breadcrumb"><?php echo $errorMsg; ?></div>
            <?php
        }
        ?>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Giriş Yap</div>
            <div class="card-body">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Parola</label>
                        <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Parola">
                    </div>

                    <button name="login" class="btn btn-primary btn-block" href="login.php">Login</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="register.php">Kayıt Ol</a>
                    <a class="d-block small" href="forgotPassword.php">Parolamı Unuttum?</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "footer.php";
    ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin.min.js"></script>
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
</div>
</body>

</html>
