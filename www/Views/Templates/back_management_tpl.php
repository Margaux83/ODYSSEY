<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Odyssey - <?= App\Core\View::getActualPageTitle() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("backManagement.css")?>>
    <link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("alert.css")?>>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script src=<?php App\Core\View::getAssets("menu.js")?>></script>
    <script src=<?php App\Core\View::getAssets("chart.js")?>></script>
    <script src=<?php App\Core\View::getAssets("sweetalert2.all.min.js")?>></script>
    <script src=<?php App\Core\View::getAssets("jquery-3.3.1.js")?>></script>

</head>
<body class="preload" style="min-height: 0;">
    <img src=<?php App\Core\View::getAssets("logos/odyssey_logo_withoutText.svg")?> alt="" class="backgroundImg">
    <main>
        <header>
            <h1><img src=<?php App\Core\View::getAssets("logos/odyssey_logo_v2.svg")?> alt="Odyssey"></h1>
            <img src=<?php App\Core\View::getAssets("icons/icon_question.png")?> alt="?" class="iconRightHeader iconBlack">
        </header>
        <!-- Intégration du modal d'affichage de message -->
        <?php $this->addModal("alert"); ?>

        <?php include $this->view ?>
        
    </main>
</body>
</html>