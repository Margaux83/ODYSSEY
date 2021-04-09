<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex"><img src=<?php App\Core\View::getAssets("icons/icon_comment.png")?> alt="">Liste des commentaires</h1>
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
                    <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                    <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                    <img class="openModalConfirmDeleteComment" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                </div>
            </li>
        <?php } ?>
    </ul>
</section>


<div id="ModalConfirmDeleteComment" class="col-12 modal">
    <div class="modal-deleteArticle d-flex-wrap d-flex">
        <div class="success-checkmark d-flex">
            <div class="check-icon d-flex">
                <img src=<?php App\Core\View::getAssets("icons/exclamation-solid.svg")?> alt="" height="50" width="50">
            </div>
        </div>
        <div class="deleteConfirmation d-flex d-flex-wrap">
            <p>Etes-vous sûr(e) de vouloir supprimer ce commentaire ?</p>
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
<script src=<?php App\Core\View::getAssets("charts.js")?>></script>
<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>