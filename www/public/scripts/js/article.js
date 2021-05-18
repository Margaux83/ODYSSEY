$(document).ready(function () {
    $('body').on('click', '.openModalConfirmDeleteComment',function(){
        document.getElementById("id_article_delete").value = $(this).attr('data-id');
        console.log($(this).attr('data-id'));
    });
});
