<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>
<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_pages" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Titre et description</th>
            <th>Créateur</th>
            <th>Statut</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach($allPages as $page) { ?>
            <tr class="text-center">
                <td>
                    <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($page["creationDate"])) ?></p>
                    <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($page["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($page["updateDate"])) ?></p>
                </td>
                <td>
                    <p class="listItem-cpt"><b><?= $page["title"] ?></b><br><?= $page["description"] ?></p>
                </td>
                <td><?= $page["firstname"]." ".$page["lastname"] ?></td>
                <td>
                    <?php //Mettre le statut de l'article
                    switch ($page["status"]) {
                        case 1:
                            echo "Brouillon";
                            break;
                        case 2:
                            echo "Créé";
                            break;
                        case 3:
                            echo "En attente de validation";
                            break;
                        case 4:
                            echo "Validé et posté";
                            break;
                    }
                    ?>
                </td>
                <td class="action-btn">
                    <div class="listItem-cpt listActions">
                        <a href="<?= $page["uri"] ?>" target="_blank" id="showPage">
                            <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <a href="#" id="editPage" onclick="editPage(this)" data-id="<?= $page["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <a href="#" id="deletePage" onclick="deletePage(this)" data-id="<?= $page["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

<section class="col-12" style="grid-column: 1 / 7; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex"><img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">Mes pages</h1>
    </div>
    <ul class="listItemBasic limit-height-450">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>

            </div>
            <div>
                <p class="listItem-cpt"><b>Ceci est une page</b><br>Messi vs Ronaldo</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Louis M.</b><br>Rôle éditeur</p>
            </div>
            <div>
                <p class="listItem-cpt">En cours de création</p>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                <img class="openModalConfirmDeleteComment" data-target="ModalConfirmDeleteComment" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
    </ul>
</section>
<div id="hidden_form_container" style="display:none;"></div>

<section class="col-12" style="grid-column: 7 / 13; grid-row: 2;">
    <h1>Données du site</h1>
    <canvas id="dataChart" width="200" height="200"></canvas>
</section>

<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("jquery.redirect.js")?>></script>
<script src=<?php App\Core\View::getAssets("pages.js")?>></script>