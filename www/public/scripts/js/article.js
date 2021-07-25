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