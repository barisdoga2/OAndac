<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Anasayfa">
        <a class="nav-link" href="index.php?task=mainPage">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Anasayfa</span>
        </a>
    </li>

    <?php
        if(!isset($_SESSION["login"])){
            ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Login">
                <a class="nav-link" href="login.php">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Giriş Yap</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Register">
                <a class="nav-link" href="register.php">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Kayıt Ol</span>
                </a>
            </li>
            <?php
        }else{
            ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
                <a class="nav-link" href="index.php?task=profile">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Profil</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="YearBooks">
                <a class="nav-link" href="index.php?task=yearBooks">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Yıllıklar</span>
                </a>
            </li>
            <?php
        }
    ?>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Hakkımızda">
        <a class="nav-link" href="index.php?task=aboutUs">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Hakkımızda</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="İletişim">
        <a class="nav-link" href="index.php?task=contact">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">İletişim</span>
        </a>
    </li>
    <?php
    if(isset($_SESSION["login"])){
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Logout">
            <a class="nav-link" href="logout.php">
                <i class="fa fa-fw fa-area-chart"></i>
                <span class="nav-link-text">Çıkış</span>
            </a>
        </li>
        <?php
    }
    ?>
</ul>