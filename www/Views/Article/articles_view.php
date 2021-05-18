

<form action="addarticle">
    <button type="submit" class="buttonComponent d-flex"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> height="15" width="15">Ajouter article</button>
</form>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex"><img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">Liste des articles</h1>
        <h1 id="modalButton" class="searchButtonSection d-flex">Rechercher<img class="colorSearchButton" src=<?php App\Core\View::getAssets("icons/search-solid.svg")?> alt="" ></h1>
    </div>
    <ul class="listItemBasic limit-height-450">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <?php
        if(!empty($infoArticles)){

            foreach ($infoArticles as $article){

            ?>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= $article["creationDate"] ?></p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?php
                    if($article["updateDate"] != NULL){
                        echo $article["updateDate"];
                    }
                    else{
                        echo "Cet article n'a pas été modifié";
                    }?></p>
            </div>
            <div>
                <p class="listItem-cpt"><b><?= $article["title"] ?></b><?= $article["description"] ?></p>
            </div>
            <div>
                <p class="listItem-cpt"><b><?= $article["firstname"]." ".$article["lastname"] ?></b><br><?= "Rôle ". $article["role"] ?></p>
            </div>
            <div>
                <p class="listItem-cpt"><?php //Mettre le statut de l'article
                    switch ($article["status"]) {
                        case 1:
                            echo "Validé et posté";
                            break;
                        case 2:
                            echo "En attente de validation";
                            break;
                        case 3:
                            echo "Brouillon";
                            break;
                        case 4:
                            echo "Créé";
                            break;
                    }
                    ?></p>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <form action="editarticle" method="post"><button class="editarticleButton" name="edit_article" type="submit"><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20"><input
                                type="hidden" name="id_article" value="<?= $article["id"] ?>"></button></form>
                <img class="openModalConfirmDeleteComment" data-target="ModalConfirmDeleteComment" data-id="<?= $article["id"] ?>"  src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>
</section>

<section class="col-12" style="grid-column: 1 / 7; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex">Mes articles</h1>
    </div>
    <ul class="listItemBasic limit-height-450">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <?php
        if(!empty($infoArticlesByUser)){

        foreach ($infoArticlesByUser as $articleByUser){

            ?>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= $articleByUser["creationDate"] ?></p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?php
                    if($articleByUser["updateDate"] != NULL){
                        echo $articleByUser["updateDate"];
                    }
                    else{
                        echo "Cet article n'a pas été modifié";
                    }?></p>
            </div>
            <div>
                <p class="listItem-cpt"><b><?= $articleByUser["title"] ?></b></p>
            </div>
            <div>
                <p class="listItem-cpt"><b><?= $article["firstname"]." ".$article["lastname"] ?></b><br><?= "Rôle ". $article["role"] ?></p>
            </div>
            <div>
                <p class="listItem-cpt"><?php //Mettre le statut de l'article
                    switch ($articleByUser["status"]) {
                        case 1:
                            echo "Validé et posté";
                            break;
                        case 2:
                            echo "En attente de validation";
                            break;
                        case 3:
                            echo "Brouillon";
                            break;
                        case 4:
                            echo "Créé";
                            break;
                    }
                    ?></p>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                <img class="openModalConfirmDeleteComment" data-target="ModalConfirmDeleteComment" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
        <?php }
        } ?>
    </ul>
</section>


<section class="col-12" style="grid-column: 7 / 13; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex">Evolution du nombre de vues par articles</h1>
    </div>
    <canvas id="viewPerChart" width="775" height="400"></canvas>
</section>



<div id="myModal" class="col-12 modal">

    <!-- Modal content -->
    <div class="modal-content-Article d-flex-wrap" style="flex-grow: 1">
        <div>
            <div class="headerForModalSearch d-flex">
                <h1 class="titleModal d-flex">Recherche d'article</h1>
                <span class="close d-flex">&times;</span>
            </div>
            <br><br>

            <form class="d-flex d-flex-wrap">
                <div class="d-flex divformModal d-flex-wrap">
                    <label for="title"  class="labelModal ">Titre</label>
                    <input type="text" name="title">
                    <br>
                    <label for="creator" class="labelModal ">Créateur</label>
                    <input type="text" name="creator">
                    <br>
                    <label for="dateCreation" class="labelModal">Date de création</label>
                    <input id="dateCreationArticle" type="date" name="dateCreation">
                </div>
                <div class="d-flex divformModal d-flex-wrap">
                    <label for="category" class="labelModal d-flex">Catégorie</label>
                    <select name="category" id="">
                        <option value="1">Voyage</option>
                        <option value="2">Nature</option>
                        <option value="3">Culture</option>
                        <option value="4">Pays</option>
                    </select>
                    <br>
                    <label for="page" class="labelModal d-flex">Page</label>
                    <select name="page" id="">
                        <option value="1">Accueil</option>
                        <option value="2">Voyages</option>
                        <option value="3">Réservations</option>
                        <option value="4">Contact</option>
                    </select>
                </div>
                <br>

                <div class="d-flex divformModal d-flex-wrap">
                    <label for="publication" class="labelModal d-flex">Publication</label>
                    <select name="publication" id="">
                        <option value="1">Tout de suite</option>
                        <option value="2">Dans 5 minutes</option>
                        <option value="3">Dans 30 minutes</option>
                        <option value="4">Dans 1 heure</option>
                    </select>
                    <br>
                    <label for="status" class="labelModal d-flex">Statut</label>
                    <select name="status" id="">
                        <option value="1">Validé et posté</option>
                        <option value="2">En attente de validation</option>
                        <option value="3">Brouillon</option>
                        <option value="4">Créé</option>
                    </select>
                </div>

                <button type="submit" class="buttonComponent d-flex" id="searchModalButton">Rechercher</button>
            </form>
        </div>
    </div>
</div>


<div id="ModalConfirmDeleteComment" class="col-12 modal">
        <div class="modal-deleteArticle d-flex-wrap d-flex">
            <div class="success-checkmark d-flex">
                <div class="check-icon d-flex">
                    <img src=<?php App\Core\View::getAssets("icons/exclamation-solid.svg")?> alt="" height="50" width="50">
                </div>
            </div>
            <div class="deleteConfirmation d-flex d-flex-wrap">
                <p>Etes-vous sûr(e) de vouloir supprimer cet article ?</p>
            </div>
            <br>

            <div class="footerDeleteArticleModal d-flex d-flex-wrap">

                <form method="post">
                &emsp;  <input type="hidden" id="id_article_delete" name="id_delete_article" value="">
                    <button type="submit" class="buttonComponent" name="submit_delete_article" id="deleteArticleFromIndexArticle">Oui, je supprime</button>
                &emsp;</form>
                <button class="buttonComponent-alert closeModalDelete">Annuler</button>
            </div>
        </div>
</div>

<script src=<?php App\Core\View::getAssets("article.js")?>></script>
<script src=<?php App\Core\View::getAssets("charts.js")?>></script>
<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>