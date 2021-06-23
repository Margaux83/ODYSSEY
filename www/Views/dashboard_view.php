<section id="dashboard-section-statistics" class="col-6" style="grid-column: 1 / 7; grid-row: 1;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_stat.png")?> alt="">Statistiques</h1>
    <div class="d-flex-wrap statisticsBasicContainer" id="dashboard-section-statisticsContainer">
        <?php foreach ($statistics as $key => $statistic) {
            echo $statistic;
        } ?>
    </div>
</section>

<!-- Line 2 -->
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
</section>

<section class="col-8 multipleSectionContainer" style="grid-column: 1 / 9; grid-row: 2;">
    <div class="multipleSection">
        <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_plane.png")?> alt="">Voyages</h1>
        <ul class="listItemBasic limit-height-300">
            <li class="legend"><p>Informations</p><p>Inscrits</p></li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination</h2>
                </div>
                <p class="listItem-cpt">152/245</p>
            </li>
        </ul>
    </div>
    <div class="multipleSection">
        <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_calendar.png")?> alt="">Réservations</h1>
        <ul class="listItemBasic limit-height-300">
            <li class="legend"><p>Informations</p><p>Places</p></li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">1</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">2</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">5</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">1</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">3</p>
            </li>
        </ul>
    </div>
    <div class="multipleSection">
        <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_cancel.png")?> alt="">Annulations</h1>
        <ul class="listItemBasic limit-height-300">
            <li class="legend"><p>Informations</p><p>Places</p></li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">2</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">1</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">1</p>
            </li>
            <li class="listItem">
                <div>
                    <p>12/12/2021</p>
                    <h2>Destination - Nom Prénom</h2>
                </div>
                <p class="listItem-cpt">3</p>
            </li>
        </ul>
    </div>
</section>

<section class="col-12" style="grid-column: 9 / 13; grid-row: 2 / 4;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_comment.png")?> alt="">Commentaires</h1>
    <ul class="listItemComplete limit-height-375"  style="min-height: 80%;">
        <?php foreach ($comments as $key => $comment) {
                echo $comment;
            }?>
        <!--
        <li class="listItem">
            <p class="flex-weight-1">Contact</p>
            <p class="flex-weight-1 status-color-important">Affichage</p>
            <p></p>
        </li>
        -->
    </ul>
    <div class="d-flex callToActionContainer">
        <button class="callToAction-withIcon">
            <img src=<?php App\Core\View::getAssets("icons/icon_pen.png")?> alt="Nouveau Message">
        </button>
    </div>
</section>

<!-- Line 3 -->
<section class="col-8" style="grid-column: 1 / 9; grid-row: 3;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_quick_access.png")?> alt="">Accès rapides</h1>
    <ul class="quickAccessContainer">
        <li>
            <p class="quickAccessTitle">Vols</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_plane.png")?> alt="">
        </li>
        <li>
            <p class="quickAccessTitle">Pages</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">
        </li>
        <li>
            <p class="quickAccessTitle">Articles</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_book.png")?> alt="">
        </li>
        <li>
            <p class="quickAccessTitle">Commentaires</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_comment.png")?> alt="">
        </li>
        <li>
            <p class="quickAccessTitle">Utilisateurs</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="">
        </li>
        <li>
            <p class="quickAccessTitle">Statistiques</p>
            <img src=<?php App\Core\View::getAssets("icons/icon_stat.png")?> alt="">
        </li>
    </ul>
</section>