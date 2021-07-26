<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("comment.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_comments" class="table thead-dark">
        <thead>
        <tr>
            <th>Date et état</th>
            <th>Commentaire</th>
            <th>Créateur</th>
            <th>Titre de l'article</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php
        //Récupération des informations de tous les commentaires
        foreach($allComments as $comment) { ?>
            <tr class="text-center">
                <td>
                    <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($comment["creationDate"])) ?></p>
                    <?php if($comment["isVerified"] == 0) { ?>
                        <p>En attente de vérification</p>

                   <?php }
                        else{
                            ?>
                          <p>Le commentaire a été vérifié</p>
                    <?php    } ?>
                </td>
                <td>
                    <p class="listItem-cpt"><b><?= $comment["content"] ?></p>
                </td>
                <td><?= $comment["firstname"]." ".$comment["lastname"] ?></td>
                <td><?= $comment["title"] ?></td>

                <td class="action-btn">
                    <div class="listItem-cpt listActions">
                        <?php if($comment["isVerified"] == 0) {
                            //Si l'article n'est pas vérifié, on affiche un bouton pour le vérifié et un bouton pour le supprimer?>
                        <a href="#"  id="verifyComment" onclick="verifyComment(this)" data-id="<?= $comment["id"] ?>">
                            <div class="linkVerifyAction">
                                <p>Approuver</p>&ensp;
                                <img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="20" width="20">
                            </div>
                        </a>

                        <a href="#" class="linkDeleteAction" id="deleteComment" onclick="deleteComment(this)" data-id="<?= $comment["id"] ?>">
                            <div class="linkDeleteAction">
                                <p>Désapprouver</p>&ensp;
                                <img  src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                            </div>
                        </a>


                        <?php }
                        else{
                            //Si l'article est vérifié, on affiche un bouton pour le supprimer si l'utilisateur a besoin de supprimer après sa vérification
                            ?>
                            <a href="#" class="linkDeleteAction" id="deleteComment" onclick="deleteComment(this)" data-id="<?= $comment["id"] ?>">
                                <p>Désapprouver</p>&ensp;
                                <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                            </a>
                        <?php }?>
                    </div>
                </td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
</section>

<script src=<?php App\Core\View::getAssets("libraries/datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("libraries/jquery.redirect.js")?>></script>
<script>
    $(document).ready(function() {
        $('#table_all_comments').DataTable({

        });
    });

    function verifyComment(e) {
        let id = $(e).attr("data-id");

        swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas revenir en arrière",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, vérifier!',
            cancelButtonText: 'Non, annuler!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swal.fire(
                    'Vérifié!',
                    'Le commentaire a bien été vérifié.',
                    'success'
                ).then(function() {
                    $.post( "comments", { id_comment: id})
                        .done(function( data ) {
                            location.reload();
                        });
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Annulé',
                    'Votre commentaire n\'a pas été vérifié',
                    'error'
                )
            }
        })
    }

    function deleteComment(e) {
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
                    'Le commentaire a bien été supprimé.',
                    'success'
                ).then(function() {
                    $.post( "delete-comment", { id_comment: id, deleteComment: "true" })
                        .done(function( data ) {
                            location.reload();
                        });
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Annulé',
                    'Votre commentaire n\'a pas été supprimé',
                    'error'
                )
            }
        })
    }
</script>