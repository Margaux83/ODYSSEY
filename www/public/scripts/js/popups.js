
$(".deleteArticle").on('click', function (){
    Swal.fire({
        title: 'Etes-vous sûr(e) ?',
        text: "Vous ne pourrez pas revenir en arrière",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, je supprime !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Supprimé !',
                'L\'article a été supprimé',
                'success'
            )
        }
    })
})

$("#cantSeeWebsite").on('click', function (){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Le site est inaccessible pour le moment'
    })
})

