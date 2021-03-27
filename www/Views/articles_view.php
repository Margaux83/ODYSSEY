
<h1 class="titleOfPage">Pages des Articles</h1><br>

<form action="ajouter-article">
    <button type="submit" class="buttonComponent d-flex"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> height="15" width="15">Ajouter article</button>
</form>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex"><img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">Liste des articles</h1>
        <h1 id="modalButton" class="searchButtonSection d-flex">Rechercher<img class="colorSearchButton" src=<?php App\Core\View::getAssets("icons/search-solid.svg")?> alt="" ></h1>
    </div>
    <ul class="listItemBasic limit-height-900">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <?php for ($i=0;$i<6;$i++){?>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp; 12/12/2021</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Titre de l'article</b> - Ceci est la description de l’article, elle permet à un utilisateur de savoir rapidement si le contenu
                    est intéressant ou non, il faut donc être concis et précis dans la réalisation de cette partie...</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Prénom NOM</b><br>Rôle Editeur</p>
            </div>
            <div>
                <p class="listItem-cpt">En attente de validation</p>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/tag-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="20" width="20">
                <img class="openModalConfirmDeleteArticle" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
        <?php } ?>
    </ul>
</section>

<section class="col-12" style="grid-column: 1 / 7; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex">Mes articles</h1>
    </div>
    <ul class="listItemBasic limit-height-900">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <?php for ($i=0;$i<4;$i++){?>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp; 12/12/2021</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Titre de l'article</b></p>
            </div>
            <div>
                <p class="listItem-cpt">En attente de validation</p>
            </div>
            <div class="statsBasic">
                <div class="statisticsBasic listItem-cpt">
                    <h2 class="numberStat numberStat-positive">28</h2>
                    <p>Cette semaine</p>
                </div>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/tag-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                <img class="openModalConfirmDeleteArticle" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
        <?php } ?>
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
                        <option value="Voyage">Voyage</option>
                        <option value="Nature">Nature</option>
                        <option value="Culture">Culture</option>
                        <option value="Pays">Pays</option>
                    </select>
                    <br>
                    <label for="page" class="labelModal d-flex">Page</label>
                    <select name="page" id="">
                        <option value="Accueil">Accueil</option>
                        <option value="Voyages">Voyages</option>
                        <option value="Réservations">Réservations</option>
                        <option value="Contact">Contact</option>
                    </select>
                </div>
                <br>

                <div class="d-flex divformModal d-flex-wrap">
                    <label for="publication" class="labelModal d-flex">Publication</label>
                    <select name="publication" id="">
                        <option value="Tout de suite">Tout de suite</option>
                        <option value="Dans 5 minutes">Dans 5 minutes</option>
                        <option value="Dans 30 minutes">Dans 30 minutes</option>
                        <option value="Dans 1 heure">Dans 1 heure</option>
                    </select>
                    <br>
                    <label for="status" class="labelModal d-flex">Statut</label>
                    <select name="status" id="">
                        <option value="Validé et posté">Validé et posté</option>
                        <option value="En attente de validation">En attente de validation</option>
                        <option value="Brouillon">Brouillon</option>
                        <option value="Créé">Créé</option>
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

                &emsp;
                <button class="buttonComponent">Oui, je supprime</button>
                &emsp;
                <button class="buttonComponent-alert closeModalDelete">Annuler</button>
            </div>
        </div>
</div>