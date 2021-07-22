$(document).ready(function() {
    $('#table_all_roles').DataTable({
    });
});
function deleteRole(e) {
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
                'Votre rôle a bien été supprimé.',
                'success'
            ).then(function() {
                $.post( "delete-role", { id_role: id, deleteRole: "true" })
                    .done(function( data ) {
                        location.reload();
                    });
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire(
                'Annulé',
                'Votre rôle n\'a pas été supprimé',
                'error'
            )
        }
    })
}