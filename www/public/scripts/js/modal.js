
// Get the modal
var modalComment = document.getElementById("ModalComment");

// Get the button that opens the modal
var btnComment = document.getElementById("modalCommentButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btnComment.onclick = function() {
    console.log(document.getElementById("ModalComment"));
    modalComment.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modalComment.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalComment) {
        modalComment.style.display = "none";
    }
}


// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("modalButton");

// Get the <span> element that closes the modal


// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

