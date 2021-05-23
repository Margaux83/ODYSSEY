$(document).ready(function () {
    $('body').on('click', '.openModalConfirmDeleteComment',function(){
        if( document.getElementById("id_delete_article").value){
            document.getElementById("id_delete_article").value = $(this).attr('data-id');
        }
        if( document.getElementById("id_delete_article_of_user").value){
            document.getElementById("id_delete_article_of_user").value = $(this).attr('data-id');
        }
    });
});
