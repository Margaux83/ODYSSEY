var ctx = document.getElementById('dataChart').getContext('2d');
ctx.canvas.width = 300;
ctx.canvas.height = 200;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['0', '1', '2', '3', '4', '5'],
        datasets: [
            {
                label: 'Vues fake',
                data: [50, 22, 36, 112, 152, 80],
                backgroundColor: [
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4'
                ],
                borderColor: [
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF'
                ],
                borderWidth: 1
            },
            {
                label: 'Vues réel',
                data: [579, 138, 380, 414, 602, 950],
                backgroundColor: [
                    '#155263',
                    '#155263',
                    '#155263',
                    '#155263',
                    '#155263',
                    '#155263'
                ],
                borderColor: [
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF',
                    '#FFFFFF'
                ],
                borderWidth: 1
            }
        ]
    }
});

$(document).ready(function() {
    $('#table_all_pages').DataTable({
    });
});
function editPage(e) {
    let id = $(e).attr("data-id");
    $.redirect('edit-page', {'id_page': id});
}
function deletePage(e) {
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
                'Votre page a bien été supprimé.',
                'success'
            ).then(function() {
                $.post( "pages", { id_page: id, deletePage: "true" })
                    .done(function( data ) {
                        location.reload();
                    });
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire(
                'Annulé',
                'Votre page n\'a pas été supprimé',
                'error'
            )
        }
    })
}