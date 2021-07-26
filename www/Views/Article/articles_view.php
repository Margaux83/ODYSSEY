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
            <th>Catégorie</th>
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
            <td>
                <p class="listItem-cpt"><b><?php
                    if ($article["isDeleted"] == 0){
                        echo $article["label"];
                    }else{
                        echo "Pas de catégorie";
                    }
                    ?></p>
            </td>
            <td class="action-btn">
                <div class="listItem-cpt listActions">
                    <a href="<?= $article["uri"] ?>" target="_blank" id="showArticle">
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
            <th>Catégorie</th>
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
                    <td>
                        <p class="listItem-cpt"><b><?php
                            if ($articleByUser["isDeleted"] == 0){
                                echo $articleByUser["label"];
                            }else{
                                echo "Pas de catégorie";
                            }
                            ?></p>
                    </td>
                    <td class="action-btn">
                        <div class="listItem-cpt listActions">
                            <a href="<?= $articleByUser["uri"] ?>" target="_blank" id="showArticle">
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

<script src=<?php App\Core\View::getAssets("libraries/datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("libraries/jquery.redirect.js")?>></script>

<script>
    /**
     * Affiche le datatable pour la liste de tous les articles
     */
    $(document).ready(function() {
        $('#table_all_articles').DataTable({

        });
    });

    /**
     * Affiche le datatable pour la liste des articles de l'utilisateur connecté
     */
    $(document).ready(function() {
        $('#table_all_articles_user').DataTable({

        });
    });
    /**
     * Fonction pour modifier l'article en fonction de son id, redirige sur la page edit-article
     * @param e
     */
    function editArticle(e) {
        let id= $(e).attr("data-id");
        $.redirect('edit-article', {'id': id});
    }

    /**
     * Fonction pour supprimer un article en fonction de son id, envoie l'id dans l'action "articles" du controller Article
     * @param e
     */
    function deleteArticle(e) {
        let id = $(e).attr("data-id");

        swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas revenir en arrière",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Non, annuler!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swal.fire(
                    'Supprimé!',
                    'Votre article a bien été supprimé.',
                    'success'
                ).then(function() {
                    $.post( "delete-article", { id_article: id, deleteArticle: "true" })
                        .done(function( data ) {
                            location.reload();
                        });
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Annulé',
                    'Votre article n\'a pas été supprimé',
                    'error'
                )
            }
        })
    }
</script>