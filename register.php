<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
session_start();
include_once "dbConnect.php";
include_once "config.php";

$registerFailed = false;
$infMsg = "";
if(isset($_POST["register"])) {

    if ($conn->query("SELECT * FROM users WHERE email='" . $_POST["email"] . "' LIMIT 1")->num_rows == 0) {
        $infMsg = "";
        if (strlen($_POST["name"]) < 2) {
            $infMsg = $infMsg . "Isminiz 2 Karakterden Küçük Olamaz!</br>";
            $registerFailed = true;
        }
        if (strlen($_POST["surname"]) < 2) {
            $infMsg = $infMsg . "Soyadınız 2 Karakterden Küçük Olamaz!</br>";
            $registerFailed = true;
        }
        if (strlen($_POST["password"]) < 6) {
            $infMsg = $infMsg . "Şifre 6 Karakterden Küçük Olamaz!</br>";
            $registerFailed = true;
        }
        if (strlen($_POST["email"]) < 6) {
            $infMsg = $infMsg . "Email 6 Karakterden Küçük Olamaz!</br>";
            $registerFailed = true;
        }
        if ($_POST["password"] != $_POST["password2"]) {
            $infMsg = $infMsg . "Parolalarınız Eşleşmiyor!</br>";
            $registerFailed = true;
        }

        if (!$registerFailed) {
            $conn->query("INSERT INTO users (email, namee, surname, password, profilepic) VALUES ('" . $_POST["email"] . "', '" . $_POST["name"] . "', '" . $_POST["surname"] . "','" . md5($_POST["password"]) . "', '".DEFAULT_PROFILE_PCITURE_LOCATION."')");
            $userRow = $conn->query("SELECT * FROM users WHERE email='" . $_POST["email"] . "' LIMIT 1")->fetch_assoc();
            $_SESSION["login"] = true;
            $_SESSION["id"] = $userRow["id"];
            $_SESSION["namee"] = $userRow["namee"];
            $_SESSION["surname"] = $userRow["surname"];
            $_SESSION["email"] = $userRow["email"];
            header("Location: index.php");
        }
    } else {
        $registerFailed = true;
        $infMsg = $infMsg."Email Adresiniz Zaten Kullanımda!<a href='index.php?task=forgotPassword'>Şifrenizi mi unuttunuz?</a>";
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
        if($registerFailed){
            ?>
            <div class="card card-register mx-auto breadcrumb"><?php echo $infMsg; ?></div>
            <?php
        }
        ?>
        <div class="container">
            <div class="card card-register mx-auto">

                <div class="card-header">Kayıt Ol</div>
                <div class="card-body">
                    <form method="post" action="register.php">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="exampleInputName">İsim</label>
                                    <input name="name" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="İsim">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputLastName">Soyisim</label>
                                    <input name="surname" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Soyisim">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="exampleInputPassword1">Parola</label>
                                    <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Parola">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleConfirmPassword">Parola</label>
                                    <input name="password2" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Parola">
                                </div>
                            </div>
                        </div>
                        <button name="register" class="btn btn-primary btn-block" href="register.php">Kayıt Ol</button>
                    </form>
                    <div class="text-center">
                        <a class="d-block small mt-3" href="login.php">Giriş Yap</a>
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