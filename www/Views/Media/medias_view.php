<link rel="stylesheet" type="text/css" href=<?php use App\Core\Routing;

App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>

<form action="add-media">
    <button type="submit" class="buttonComponent d-flex"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> height="15" width="15">Ajouter un média</button>
</form>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_medias" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Nom du média</th>
            <th>Média</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if(!empty($mediaInfos)){

        foreach ($mediaInfos as $media){
        ?>
                <tr class="text-center">
                    <td>
                        <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($media["creationDate"])) ?></p>
                        <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($media["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($media["updateDate"])) ?></p>
                    </td>
                    <td>
                        <p class="listItem-cpt"><?= $media["name"] ?></p>
                    </td>
                    <td>
                        <img src="<?php echo Routing::getBaseUrl() . '/public/images/uploads/' . $media['media'] ?>" alt="" height="50" width="50"></p>
                    </td>
                    <td class="action-btn">
                        <div class="listItem-cpt listActions">
                            <a href="javascript: navigator.clipboard.writeText('<?php echo Routing::getBaseUrl() . '/public/images/uploads/' . $media['media']; ?>').then(function() { copyboard() }, function() { alert('Failed'); });">
                                <img src=<?php App\Core\View::getAssets("icons/icon-clipboard.png")?> alt="" height="20" width="20">
                            </a>
                            <a href="#" id="editMedia" onclick="editMedia(this)" data-id="<?= $media["id"] ?>">
                                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                            </a>
                            <a href="#" id="deleteMedia" onclick="deleteMedia(this)" data-id="<?= $media["id"] ?>">
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
     * Affiche le datatable pour la liste de tous les médias
     */
    $(document).ready(function() {
        $('#table_all_medias').DataTable({

        });
    });

    /**
     * Fonction pour modifier l'article en fonction de son id, redirige sur la page edit-article
     * @param e
     */
    function editMedia(e) {
        let id= $(e).attr("data-id");
        $.redirect('edit-medias', {'id': id});
    }

    /**
     * Message de succès pour copier le média dans le presse-papier
     * @param e
     */
    function copyboard() {
        Swal.fire(
            'Succès',
            'Le média a bien été copié dans le presse-papier',
            'success'
        )
    }

    /**
     * Fonction pour supprimer un article en fonction de son id, envoie l'id dans l'action "articles" du controller Article
     * @param e
     */
    function deleteMedia(e) {
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
                    'Le media a bien été supprimé.',
                    'success'
                ).then(function() {
                    $.post( "delete-media", { id_media: id, deleteMedia: "true" })
                        .done(function( data ) {
                            location.reload();
                        });
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Annulé',
                    'Votre média n\'a pas été supprimé',
                    'error'
                )
            }
        })
    }
</script>