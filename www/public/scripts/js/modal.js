// Get the modal
var modalDescEditArticle = document.getElementById("ModalDescEditArticle");

// When the user clicks on the button, open the modal
$("#modalButtonEditArticle").on('click', function(){
    modalDescEditArticle.style.display = "block";
})

/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalComment) {
        modalComment.style.display = "none";
    }
}*/


// Get the modal
var modalDescAddArticle = document.getElementById("ModalDescAddArticle");

if(document.getElementById("ModalDescAddArticle") != null) {
// When the user clicks on the button, open the modal
    $("#modalButtonAddArticle").on('click', function () {
        modalDescAddArticle.style.display = "block";
    });
    $(".closeComment").on('click', function () {
        modalDescAddArticle.style.display = "block";
    });
}



/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalComment) {
        modalComment.style.display = "none";
    }
}*/


// Get the modal
var modal = document.getElementById("myModal");

if(document.getElementById("myModal") != null) {

    $("#modalButton").on('click', function () {
        modal.style.display = "block";
    });

    $(".close").on('click', function () {
        modal.style.display = "none";
    });
}



/* When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/

