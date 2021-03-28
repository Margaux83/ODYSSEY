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

var modalCategoryAddArticle = document.getElementById("ModalCategoryAddArticle");

if(document.getElementById("ModalCategoryAddArticle") != null) {
// When the user clicks on the button, open the modal
    $("#modalButtonAddCategoryArticle").on('click', function () {
        modalCategoryAddArticle.style.display = "block";
    });
    $(".closeComment").on('click', function () {
        modalCategoryAddArticle.style.display = "none";
    });
}

var modalCategoryEditArticle = document.getElementById("ModalCategoryEditArticle");

if(document.getElementById("ModalCategoryEditArticle") != null) {
// When the user clicks on the button, open the modal
    $("#modalButtonEditCategoryArticle").on('click', function () {
        modalCategoryEditArticle.style.display = "block";
    });
    $(".closeComment").on('click', function () {
        modalCategoryEditArticle.style.display = "none";
    });
}

var modalPageAddArticle = document.getElementById("ModalPageAddArticle");

if(document.getElementById("ModalPageAddArticle") != null) {
// When the user clicks on the button, open the modal
    $("#modalButtonAddPageArticle").on('click', function () {
        modalPageAddArticle.style.display = "block";
    });
    $(".closeComment").on('click', function () {
        modalPageAddArticle.style.display = "none";
    });
}

var modalPageEditArticle = document.getElementById("ModalPageEditArticle");

if(document.getElementById("ModalPageEditArticle") != null) {
// When the user clicks on the button, open the modal
    $("#modalButtonEditPageArticle").on('click', function () {
        modalPageEditArticle.style.display = "block";
    });
    $(".closeComment").on('click', function () {
        modalPageEditArticle.style.display = "none";
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

window.addEventListener('click',function(event) {
    console.log("ok");
    if (event.target === modalDescEditArticle) {
        $(modalDescEditArticle).css('display','none');
    }
    if (event.target === modalDescAddArticle) {
        $(modalDescAddArticle).css('display','none');
    }
    if (event.target === modalCategoryAddArticle) {
        $(modalCategoryAddArticle).css('display','none');
    }
    if (event.target === modalCategoryEditArticle) {
        $(modalCategoryEditArticle).css('display','none');
    }
    if (event.target === modalPageAddArticle) {
        $(modalPageAddArticle).css('display','none');
    }
    if (event.target === modalPageEditArticle) {
        $(modalPageEditArticle).css('display','none');
    }
    if (event.target === modal) {
        $(modal).css('display','none');
    }
});

