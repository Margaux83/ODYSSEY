<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>
<section class="col-12" style="grid-column: 1/ 7; grid-row: 1;">
<h1>Ajouter une catégorie</h1>
    <?php  App\Core\Form::showForm($formCategory); ?>
</section>
<section class="col-12" style="grid-column: 7/ 13; grid-row: 1;">
    <table id="table_all_categories" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Catégorie</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($listCategories)){

            foreach ($listCategories as $category){

            ?>
        <tr class="text-center">
            <td>
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($category["creationDate"])) ?></p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($category["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($category["updateDate"])) ?></p>
            </td>
            <td>
                <p class="listItem-cpt"><b><?= $category["label"] ?></p>
            </td>
            <td class="action-btn">
                <div class="listItem-cpt listActions">
                <?php if($category['id'] !== "1") { ?>
                    <a href="#" id="editCategory" onclick="editCategory(this)" data-id="<?= $category["id"] ?>">
                        <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                    </a>
                    <a href="#" id="deleteCategory" onclick="deleteCategory(this)" data-id="<?= $category["id"] ?>">
                        <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                    </a>
                <?php } ?>
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
     * Affiche le datatable pour la liste de toutes les catégories
     */
    $(document).ready(function() {
        $('#table_all_categories').DataTable({

        });
    });

    /**
     * Fonction pour modifier la catégorie en fonction de son id, redirige sur la page edit-category
     * @param e
     */
    function editCategory(e) {
        let id= $(e).attr("data-id");
        $.redirect('edit-category', {'id': id});
    }

    /**
     * Fonction pour supprimer une catégorie en fonction de son id, envoie l'id dans l'action "categories" du controller Article
     * @param e
     */
    function deleteCategory(e) {
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
                    'Votre catégorie a bien été supprimée.',
                    'success'
                ).then(function() {
                    $.post( "delete-category", { id_category: id, deleteCategory: "true" })
                        .done(function( data ) {
                            location.reload();
                        });
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Annulé',
                    'Votre catégorie n\'a pas été supprimée',
                    'error'
                )
            }
        })
    }
</script>
