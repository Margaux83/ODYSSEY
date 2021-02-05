<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Back Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("main.css")?>>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script>
        function toggleMenu(){
            document.getElementById('back-mainPage-menuResponsive').classList.toggle('hidden');
        }
    </script>
</head>
<body>
    <header>
        <img src=<?php App\Core\View::getAssets("odyssey_logo_v2.svg")?> alt="Odyssey" class="back-mainPage-header-logo">
        <p class="back-mainPage-header-websiteName">Mon projet annuel Web</p>
        <div class="back-mainPage-header-actionContainer">
            <button onclick="alert('Accès au site non disponible')" class="fullButton"><img src=<?php App\Core\View::getAssets("icon_web.png")?> alt="Accès au site" class="iconWhite"></button>
            <button onclick="toggleMenu()" class="fullButton d-inline-block d-lg-none"><img src=<?php App\Core\View::getAssets("icon_menu.png")?> alt="Menu" class="iconWhite"></button>
        </div>
    </header>
    <nav id="back-mainPage-menu" class="d-none d-lg-flex">
        <ul>
            <li class="selected"><a href="#tableau-de-bord"><img src=<?php App\Core\View::getAssets("icon_home.png")?> alt="" class="icon iconWhite">Tableau de bord</a></li>
            <li><a href="#articles"><img src=<?php App\Core\View::getAssets("icon_page.png")?> alt="" class="icon iconWhite">Articles</a></li>
            <li><a href="#utilisateurs"><img src=<?php App\Core\View::getAssets("icon_user.png")?> alt="" class="icon iconWhite">Utilisateurs</a></li>
            <li><a href="#commentaires"><img src=<?php App\Core\View::getAssets("icon_comment.png")?> alt="" class="icon iconWhite">Commentaires</a></li>
        </ul>
        <ul>
            <li><a href="#templates"><img src=<?php App\Core\View::getAssets("icon_page.png")?> alt="" class="icon iconWhite">Templates</a></li>
            <li><a href="#gestion-menu"><img src=<?php App\Core\View::getAssets("icon_menu.png")?> alt="" class="icon iconWhite">Gestion du menu</a></li>
            <li><a href="#newsletter"><img src=<?php App\Core\View::getAssets("icon_newsletter.png")?> alt="" class="icon iconWhite">Newsletter</a></li>
        </ul>
        <ul>
            <li><a href="#acces-site"><img src=<?php App\Core\View::getAssets("icon_web.png")?> alt="" class="icon iconWhite">Accès au site</a></li>
            <li><a href="#parametres"><img src=<?php App\Core\View::getAssets("icon_settings.png")?> alt="" class="icon iconWhite">Paramètres</a></li>
        </ul>
    </nav>
    <nav id="back-mainPage-menuResponsive" class="d-block d-lg-none hidden">
        <ul>
            <li class="selected"><a href="#tableau-de-bord"><img src=<?php App\Core\View::getAssets("icon_home.png")?> alt="" class="icon iconWhite">Tableau de bord</a></li>
            <li><a href="#articles"><img src=<?php App\Core\View::getAssets("icon_page.png")?> alt="" class="icon iconWhite">Articles</a></li>
            <li><a href="#utilisateurs"><img src=<?php App\Core\View::getAssets("icon_user.png")?> alt="" class="icon iconWhite">Utilisateurs</a></li>
            <li><a href="#commentaires"><img src=<?php App\Core\View::getAssets("icon_comment.png")?> alt="" class="icon iconWhite">Commentaires</a></li>
        </ul>
        <ul>
            <li><a href="#templates"><img src=<?php App\Core\View::getAssets("icon_page.png")?> alt="" class="icon iconWhite">Templates</a></li>
            <li><a href="#gestion-menu"><img src=<?php App\Core\View::getAssets("icon_menu.png")?> alt="" class="icon iconWhite">Gestion du menu</a></li>
            <li><a href="#newsletter"><img src=<?php App\Core\View::getAssets("icon_newsletter.png")?> alt="" class="icon iconWhite">Newsletter</a></li>
        </ul>
        <ul>
            <li><a href="#acces-site"><img src=<?php App\Core\View::getAssets("icon_web.png")?> alt="" class="icon iconWhite">Accès au site</a></li>
            <li><a href="#parametres"><img src=<?php App\Core\View::getAssets("icon_settings.png")?> alt="" class="icon iconWhite">Paramètres</a></li>
        </ul>
    </nav>
    <main id="back-mainPage-mainContent">
        <div id="back-manPage-gridContent" class="d-flex-wrap d-lg-grid">
			<?php include $this->view ?>
        </div>
    </main>
</body>
</html>