$(document).ready(function() {
    $('#table_all_categories').DataTable({

    });
});

function editCategory(e) {
    let id= $(e).attr("data-id");
    $.redirect('edit-category', {'id': id});
}

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
                $.post( "categories", { id_category: id, deleteCategory: "true" })
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