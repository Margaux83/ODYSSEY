$(document).ready(function() {
    $('#table_all_articles').DataTable({

    });
});
$(document).ready(function() {
    $('#table_all_articles_user').DataTable({

    });
});
$(document).ready(function() {
    $('#table_all_articles_update').DataTable({

    });
});
function editArticle(e) {
    let id= $(e).attr("data-id");
    $.redirect('edit-article', {'id': id});
}
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