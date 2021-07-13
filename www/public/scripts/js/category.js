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