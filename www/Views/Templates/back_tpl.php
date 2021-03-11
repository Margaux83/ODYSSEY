<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Odyssey - </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("main.css")?>>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <script src=<?php App\Core\View::getAssets("menu.js")?>></script>
    <script src=<?php App\Core\View::getAssets("libraries/chart.js")?>></script>
    <script src=<?php App\Core\View::getAssets("libraries/sweetalert2Library.js")?>></script>
    <script src=<?php App\Core\View::getAssets("libraries/sweetalert2LibraryAll.min.js")?>></script>
    <script src=<?php App\Core\View::getAssets("libraries/jquery-3.5.1.min.js")?>></script>

    <link rel="stylesheet" href="../../Trumbowyg/dist/ui/trumbowyg.min.css">
   <link rel="stylesheet" href="../../Trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css">

</head>
<body>

<header>
    <img src=<?php App\Core\View::getAssets("logos/odyssey_logo_v2.svg")?> alt="Odyssey" class="back-mainPage-header-logo">
    <p class="back-mainPage-header-websiteName">Mon projet annuel Web</p>
    <div class="back-mainPage-header-actionContainer">
        <button id="cantSeeWebsite" class="fullButton"><img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="Accès au site" class="iconWhite"></button>
        <button onclick="toggleMenu('back-mainPage-menuResponsive')" class="fullButton d-inline-block d-lg-none"><img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="Menu" class="iconWhite"></button>
        <button id="cantSeeWebsite" class="fullButton"><img src=<?php App\Core\View::getAssets("icons/icon_web.png")?> alt="Accès au site" class="iconWhite"></button>
        <button onclick="toggleMenu('back-mainPage-menuResponsive')" class="fullButton d-inline-block d-lg-none"><img src=<?php App\Core\View::getAssets("icons/icon_menu.png")?> alt="Menu" class="iconWhite"></button>
    </div>
</header>
<nav id="back-mainPage-menu" class="d-none d-lg-flex">
    <?php  App\Core\MenuBuilder::createMenu($menuData, $actualUri); ?>
</nav>
<nav id="back-mainPage-menuResponsive" class="d-block d-lg-none hidden">
    <?php  App\Core\MenuBuilder::createMenu($menuData, $actualUri); ?>
</nav>
<main id="back-mainPage-mainContent">
    <div id="back-manPage-gridContent" class="d-flex-wrap d-lg-grid">
        <?php include $this->view ?>

    </div>
</main>
<script src="../../Trumbowyg/dist/trumbowyg.min.js"></script>
</body>
<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>

</html>