<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Anasayfa">
        <a class="nav-link" href="index.php?task=mainPage">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Anasayfa</span>
        </a>
    </li>

    <?php

    if(isset($_SESSION["login"])){
        
    }

    ?>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Hakkımızda">
        <a class="nav-link" href="index.php?task=aboutUs">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Hakkımızda</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Galeri">
        <a class="nav-link" href="index.php?task=gallery">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Galeri</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="İletişim">
        <a class="nav-link" href="index.php?task=contact">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">İletişim</span>
        </a>
    </li>
</ul>

<ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
        </a>
    </li>
</ul>