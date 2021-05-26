<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Odyssey - Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("backManagement.css")?>>
    <link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("error.css")?>>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body class="preload" style="min-height: 0; margin: auto">
<img src=<?php App\Core\View::getAssets("logos/odyssey_logo_withoutText.svg")?> alt="" class="backgroundImg">
<main>
    <?php include $this->view ?>
</main>
</body>
</html>