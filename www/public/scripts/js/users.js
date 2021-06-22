var ctx = document.getElementById('line-chart').getContext('2d');
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun'],
        datasets: [{
            label: 'Nombre dutilisateur',
            data: [230, 250, 260, 270, 280, 290],
            borderColor: "#3e95cd",
            borderWidth: 5,
            fill: false

        }]
    },
    options: {
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Mois'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Valeur'
                }
            }]
        }
    },

});

var ctx = document.getElementById('bar-chart').getContext('2d');
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun'],
        datasets: [{
            label: 'Nombre dutilisateur',
            data: [230, 250, 260, 270, 280, 290],
            borderColor: "#3e95cd",
            borderWidth: 5,
            fill: false

        }]
    },

});

$(document).ready(function() {
    $('#table_all_users').DataTable({

    });
});

function editUser(e) {
    let id = $(e).attr("data-id");
    $.redirect('edit-user', {'id_user': id});
}

function deleteUser(e) {
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
                'L\' utilisateur a bien été supprimé.',
                'success'
            ).then(function() {
                $.post( "users", { id_user: id, deleteUser: "true" })
                    .done(function( data ) {
                        location.reload();
                    });
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire(
                'Annulé',
                'L\'utilisateur n\'a pas été supprimé',
                'error'
            )
        }
    })
}