document.getElementById("dm-btn").addEventListener("click", function() {
    document.getElementsByClassName("dirm")[0].classList.toggle("new-dirm");
    document.getElementsByClassName("dim")[0].classList.toggle("new");
    document.getElementsByTagName("body")[0].style.overflowY = "hidden";
});

document.getElementsByClassName("glyphicon-remove")[0].addEventListener("click", function() {
    document.getElementsByClassName("dirm")[0].classList.toggle("new-dirm");
    document.getElementsByClassName("dim")[0].classList.toggle("new");
    document.getElementsByTagName("body")[0].style.overflowY = "visible";
});

document.getElementsByClassName("dirm")[0].style.height = window.innerHeight;

const comm_btns = document.getElementsByClassName("comments-btn");

Object.values(comm_btns).forEach(function(btn) {
    btn.addEventListener("click", function(event) {
        this.nextSibling.classList.toggle("shown");
    });
});
