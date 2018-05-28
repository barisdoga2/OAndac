<ul class="navbar-nav ml-auto">
    <?php
    if(isset($_SESSION["login"])){
        ?>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fa fa-fw fa-sign-out"></i>Çıkış Yap</a>
        </li>
        <?php
    }else{
        ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">
                <i class="fa fa-fw fa-sign-in"></i>Giriş Yap</a>
        </li>
        <?php
    }
    ?>
</ul>