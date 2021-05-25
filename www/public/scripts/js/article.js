$(document).ready(function () {

    //Récupération de l'id de l'article pour sa suppression
    $('body').on('click', '.openModalConfirmDeleteArticle',function() {
        document.getElementById("id_delete_article").value = $(this).attr('data-id');
    });

    //Récupération de l'id de l'article de l'utilisateur connecté pour sa suppression
    $('body').on('click', '.openModalConfirmDeleteArticleUser',function() {
            document.getElementById("id_delete_article_of_user").value = $(this).attr('data-id');
    });
});
