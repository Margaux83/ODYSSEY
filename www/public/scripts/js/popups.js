// Get the modal
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

var ModalConfirmDeleteComment = document.getElementById("ModalConfirmDeleteComment");

if(document.getElementById("ModalConfirmDeleteComment") != null) {
// When the user clicks on the button, open the modal
    $(".openModalConfirmDeleteComment").on('click', function () {
        ModalConfirmDeleteComment.style.display = "block";
    });
    $(".closeModalDelete").on('click', function () {
        ModalConfirmDeleteComment.style.display = "none";
    });
}

window.onclick = function(event) {
    if (event.target == ModalConfirmDeleteArticle) {
        ModalConfirmDeleteArticle.style.display = "none";
    }
    if (event.target == ModalConfirmDeleteComment) {
        ModalConfirmDeleteComment.style.display = "none";
    }
}

$(".openModalConfirmDeleteArticle").on('click',function () {
    setTimeout(function () {
        $(".check-icon").show();
    }, 10000);
});

$(".openModalConfirmDeleteComment").on('click',function () {
    setTimeout(function () {
        $(".check-icon").show();
    }, 10000);
});