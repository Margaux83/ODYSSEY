<section id="dashboard-section-statistics" class="col-6" style="grid-column: 1 / 9; grid-row: 1;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_stat.png")?> alt="">Statistiques</h1>
    <div class="d-flex-wrap statisticsBasicContainer" id="dashboard-section-statisticsContainer">
        <?php foreach ($statistics as $key => $statistic) {
            echo $statistic;
        } ?>
    </div>
</section>

<!-- Line 2
<section class="col-6" style="grid-column: 7 / 13; grid-row: 1;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_alert.png")?> alt="">Alertes</h1>
    <ul class="listItemComplete limit-height-125"  style="min-height: 80%;">
        <li class="legend">
            <p class="flex-weight-1">Libellé</p>
            <p class="flex-weight-1">Niveau</p>
            <p class="flex-weight-2">Description</p>
            <p></p>
        </li>
        <li class="listItem">
            <p class="flex-weight-1">Contact</p>
            <p class="flex-weight-1 status-color-important">Affichage</p>
            <p class="flex-weight-2">Description</p>
            <p></p>
        </li>
        <li class="listItem">
            <p class="flex-weight-1">Hôtel de Marseille</p>
            <p class="flex-weight-1 status-color-normal">Réservation</p>
            <p class="flex-weight-2">Description</p>
            <p></p>
        </li>
        <li class="listItem">
            <p class="flex-weight-1">Accueil</p>
            <p class="flex-weight-1 status-color-moyen">Affichage</p>
            <p class="flex-weight-2">Description</p>
            <p></p>
        </li>
        <li class="listItem">
            <p class="flex-weight-1">Configuration URL</p>
            <p class="flex-weight-1 status-color-important">Configuration</p>
            <p class="flex-weight-2">Description</p>
            <p></p>
        </li>
    </ul>
</section>-->

<section class="col-8 multipleSectionContainer" style="grid-column: 1 / 9; grid-row: 2;">
    <div class="multipleSection">
        <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="">Utilisateurs</h1>
        <ul class="listItemBasic limit-height-300">
            <?php foreach ($users as $key => $user) {
                echo $user;
            }?>
        </ul>
    </div>
    <div class="multipleSection">
        <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">Pages</h1>
        <ul class="listItemBasic limit-height-300">
            <?php foreach ($pages as $key => $page) {
                echo $page;
            }?>
        </ul>
    </div>
    <div class="multipleSection">
        <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">Articles</h1>
        <ul class="listItemBasic limit-height-300">
            <?php foreach ($articles as $key => $article) {
                echo $article;
            }?>
        </ul>
    </div>
</section>

<section class="col-12" style="grid-column: 9 / 13; grid-row: 1 / 4;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_comment.png")?> alt="">Commentaires</h1>
    <ul class="listItemComplete limit-height-375"  style="min-height: 80%;">
        <?php foreach ($comments as $key => $comment) {
                echo $comment;
            }?>
    </ul>
</section>

<!-- Line 3 -->
<section class="col-8" style="grid-column: 1 / 9; grid-row: 3;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_quick_access.png")?> alt="">Accès rapides</h1>
    <ul class="quickAccessContainer">
        <li onclick="window.location.assign('/admin/pages')">
            <p class="quickAccessTitle">Pages</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">
        </li>
        <li onclick="window.location.assign('/admin/articles')">
            <p class="quickAccessTitle" >Articles</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_book.png")?> alt="">
        </li>
        <li onclick="window.location.assign('/admin/comments')">
            <p class="quickAccessTitle">Commentaires</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_comment.png")?> alt="">
        </li>
        <li onclick="window.location.assign('/admin/medias')">
            <p class="quickAccessTitle">Média</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_media.png")?> alt="">
        </li>
        <li onclick="window.location.assign('/admin/roles')">
            <p class="quickAccessTitle">Rôles</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_menu.png")?> alt="">
        </li>
        <li onclick="window.location.assign('/admin/template')">
            <p class="quickAccessTitle">Templates</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">
        </li>
        <li onclick="window.location.assign('/admin/menu-management')">
            <p class="quickAccessTitle">Menu</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_menu.png")?> alt="">
        </li>
        <li onclick="window.location.assign('/admin/users')">
            <p class="quickAccessTitle">Utilisateurs</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="">
        </li>
    </ul>
</section>