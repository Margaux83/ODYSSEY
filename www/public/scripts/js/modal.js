// Get the modal
var modalDescEditArticle = document.getElementById("ModalDescEditArticle");

if(document.getElementById("ModalDescEditArticle") != null) {
// When the user clicks on the button, open the modal
    $("#modalButtonEditArticle").on('click', function () {
        modalDescEditArticle.style.display = "block";
    });
    $(".closeComment").on('click', function () {
        modalDescEditArticle.style.display = "none";
    });
}



// Get the modal
var modalDescAddArticle = document.getElementById("ModalDescAddArticle");

if(document.getElementById("ModalDescAddArticle") != null) {
// When the user clicks on the button, open the modal
    $("#modalButtonAddArticle").on('click', function () {
        modalDescAddArticle.style.display = "block";
    });
    $(".closeComment").on('click', function () {
        modalDescAddArticle.style.display = "none";
    });
}






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


window.onclick = function(event) {
    if (event.target == modalDescEditArticle) {
        modalDescEditArticle.style.display = "none";
    }
    if (event.target == modalDescAddArticle) {
        modalDescAddArticle.style.display = "none";
    }
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

