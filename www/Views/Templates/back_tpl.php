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

    <script src=<?php App\Core\View::getAssets("menu.js")?>></script>
</head>
<body>
    <header>
        <img src=<?php App\Core\View::getAssets("logos/odyssey_logo_v2.svg")?> alt="Odyssey" class="back-mainPage-header-logo">
        <p class="back-mainPage-header-websiteName">Mon projet annuel Web</p>
        <div class="back-mainPage-header-actionContainer">
            <button onclick="alert('Accès au site non disponible')" class="fullButton"><img src=<?php App\Core\View::getAssets("icons/icon_web.png")?> alt="Accès au site" class="iconWhite"></button>
            <button onclick="toggleMenu('back-mainPage-menuResponsive')" class="fullButton d-inline-block d-lg-none"><img src=<?php App\Core\View::getAssets("icons/icon_menu.png")?> alt="Menu" class="iconWhite"></button>
        </div>
    </header>
    <?php 
        $menuBuilder = App\Core\MenuBuilder::getInstance();
        $menuBuilder::createMenu(); 
    ?>
    <main id="back-mainPage-mainContent">
        <div id="back-manPage-gridContent" class="d-flex-wrap d-lg-grid">
			<?php include $this->view ?>
        </div>
    </main>
</body>
</html>