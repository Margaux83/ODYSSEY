
var ModalConfirmDeleteArticleUser = document.getElementById("ModalConfirmDeleteArticleUser");

if(document.getElementById("ModalConfirmDeleteArticleUser") != null) {
// When the user clicks on the button, open the modal
    $(".openModalConfirmDeleteArticleUser").on('click', function () {
        ModalConfirmDeleteArticleUser.style.display = "block";
    });
    $(".closeModalDelete").on('click', function () {
        ModalConfirmDeleteArticleUser.style.display = "none";
    });
}

var ModalConfirmDeleteArticle = document.getElementById("ModalConfirmDeleteArticle");

if(document.getElementById("ModalConfirmDeleteArticle") != null) {
// When the user clicks on the button, open the modal
    $(".openModalConfirmDeleteArticle").on('click', function () {
        ModalConfirmDeleteArticle.style.display = "block";
    });
    $(".closeModalDelete").on('click', function () {
        ModalConfirmDeleteArticle.style.display = "none";
    });
}


window.onclick = function(event) {
    if (event.target == ModalConfirmDeleteArticle) {
        ModalConfirmDeleteArticle.style.display = "none";
    }
    if (event.target == ModalConfirmDeleteArticleUser) {
        ModalConfirmDeleteArticleUser.style.display = "none";
    }
}

$(".openModalConfirmDeleteArticle").on('click',function () {
    setTimeout(function () {
        $(".check-icon").show();
    }, 10000);
});

$(".openModalConfirmDeleteArticleUsert").on('click',function () {
    setTimeout(function () {
        $(".check-icon").show();
    }, 10000);
});