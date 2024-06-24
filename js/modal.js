document.addEventListener("DOMContentLoaded", function () {
    
    var modal = document.getElementById("myModal");

    
    var span = document.getElementsByClassName("close")[0];

    var okBtn = document.getElementsByClassName("ok-btn")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    okBtn.onclick = function() {
        modal.style.display = "none";
    }

  
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
