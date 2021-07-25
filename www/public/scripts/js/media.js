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