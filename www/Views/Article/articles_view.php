<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>

<form action="add-article">
    <button type="submit" class="buttonComponent d-flex"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> height="15" width="15">Ajouter article</button>
</form>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_articles" class="table thead-dark">
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
        if(!empty($infoArticles)){

            foreach ($infoArticles as $article){

            ?>
        <tr class="text-center">
            <td>
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($article["creationDate"])) ?></p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($article["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($article["updateDate"])) ?></p>
            </td>
            <td>
                <p class="listItem-cpt"><b><?= $article["title"] ?></b><br><?= $article["description"] ?></p>
            </td>
            <td><?= $article["firstname"]." ".$article["lastname"] ?></td>
            <td>
                <?php //Mettre le statut de l'article
                switch ($article["status"]) {
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
                    <a href="<?= $article["uri"] ?>" target="_blank" id="showPage">
                        <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                    </a>
                    <a href="#" id="editArticle" onclick="editArticle(this)" data-id="<?= $article["id"] ?>">
                        <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                    </a>
                    <a href="#" id="deleteArticle" onclick="deleteArticle(this)" data-id="<?= $article["id"] ?>">
                        <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                    </a>
                </div>
            </td>

        </tr>
        <?php } ?>
        <?php } ?>

        </tbody>
    </table>
</section>

<section class="col-12" style="grid-column: 1 / 7; grid-row: 2;">
    <table id="table_all_articles_user" class="table thead-dark">
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
        if(!empty($infoArticlesByUser)){

            foreach ($infoArticlesByUser as $articleByUser){

                ?>
                <tr class="text-center">
                    <td>
                        <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($articleByUser["creationDate"])) ?></p>
                        <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($articleByUser["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($articleByUser["updateDate"])) ?></p>
                    </td>
                    <td>
                        <p class="listItem-cpt"><b><?= $articleByUser["title"] ?></b><br><?= $articleByUser["description"] ?></p>
                    </td>
                    <td><?= $articleByUser["firstname"]." ".$articleByUser["lastname"] ?></td>
                    <td>
                        <?php //Mettre le statut de l'article
                        switch ($articleByUser["status"]) {
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
                            <a href="<?= $articleByUser["uri"] ?>" target="_blank" id="showPage">
                                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                            </a>
                            <a href="#" id="editArticle" onclick="editArticle(this)" data-id="<?= $articleByUser["id"] ?>">
                                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                            </a>
                            <a href="#" id="deleteArticle" onclick="deleteArticle(this)" data-id="<?= $articleByUser["id"] ?>">
                                <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                            </a>
                        </div>
                    </td>

                </tr>
            <?php } ?>
        <?php } ?>

        </tbody>
    </table>
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


<div id="ModalConfirmDeleteArticle" class="col-12 modal">
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

                <?php  App\Core\Form::showForm($form); ?>
                <button class="buttonComponent-alert closeModalDelete">Annuler</button>
            </div>
        </div>
</div>

<div id="ModalConfirmDeleteArticleUser" class="col-12 modal">
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

            <?php  App\Core\Form::showForm($formDeleteArticleOfUser); ?>
            <button class="buttonComponent-alert closeModalDelete">Annuler</button>
        </div>
    </div>
</div>


<script src=<?php App\Core\View::getAssets("article.js")?>></script>
<script src=<?php App\Core\View::getAssets("charts.js")?>></script>
<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>

<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("jquery.redirect.js")?>></script>