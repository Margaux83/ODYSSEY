
<section class="col-6" style="grid-column: 1 / 3; grid-row: 1 ;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="">Utilisateurs</h1>
    <div class="d-flex-wrap statisticsBasicContainer" id="dashboard-section-statisticsContainer">
        <article class="statisticsBasic">
            <h1>Utilisateurs</h1>
            <div>
                <h2 class="numberStat numberStat-negative">20</h2>
                <p>Depuis hier</p>
            </div>
        </article>
        <article class="statisticsBasic">
            <h1>Connectés</h1>
            <div>
                <h2 class="numberStat numberStat-positive">13</h2>
                <p>Depuis hier</p>
            </div>
        </article class="statisticsBasic">
        <article class="statisticsBasic">
            <h1>Augmentation inscriptions</h1>
            <div>
                <h2 class="numberStat numberStat-positive">15%</h2>
                <p>Depuis la semaine dernière</p>
            </div>
        </article>
    </div>
</section>


<section class="col-12" style="grid-column: 3 / 13; grid-row: 1">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_comment.png")?> alt="">Liste des utilisateurs</h1>
    <ul class="listItemBasic limit-height-900">
        <li class="legend">
            <p class="flex-weight-1">Nom</p>
            <p class="flex-weight-1">Prénom</p>
            <p class="flex-weight-1">Email</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Rôle</p>
            <p class="flex-weight-1">Date d'inscription</p>
            <p class="flex-weight-1">Dernière connexion</p>
            <p class="flex-weight-1">Action</p>
        </li>
        <?php for ($i=0;$i<7;$i++){?>
            <li class="listItem">
                <div class="listItem-cpt">
                    <p>Martin</p>
                </div>
                <div class="listItem-cpt">
                    <p>Jean</p>
                </div>
                <div class="listItem-cpt">
                    <p>martin.jean@gmail.com</p>
                </div>
                <div class="listItem-cpt">
                    <p>Connecté</p>
                </div>
                <div class="listItem-cpt">
                    <p>Inscrit</p>
                </div>
                <div class="listItem-cpt">
                    <p>12/02/2021</p>
                </div>
                <div class="listItem-cpt">
                    <p>15/02/2021</p>
                </div>
                <div class="listItem-cpt listActions">
                    <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                    <img class="deleteArticle" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                    <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">

                </div>
            </li>
        <?php } ?>
    </ul>
</section>


<section class="col-8" style="grid-column: 1 / 7; grid-row: 2;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_stat.png")?> alt="">Evolution du nombre de connexion</h1>
    <canvas id="bar-chart" width="775" height="400"></canvas>
</section>

<section class="col-8" style="grid-column: 7 / 13; grid-row: 2;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_stat.png")?> alt="">Evolution des inscriptions</h1>
    <canvas id="line-chart" width="775" height="400"></canvas>
</section>