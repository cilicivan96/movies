function buttonPressed(e, n, id_movie) {
    var btnContainer = document.getElementById("ratings");

    var btns = btnContainer.getElementsByTagName("button");

    var current = btnContainer.getElementsByClassName("active");
    if (!e.isEqualNode(current[0])) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (current[0] != null) {
                    current[0].className = current[0].className.replace(" active", "");
                }
                e.className += " active";
            }
        };
        xmlhttp.open("GET","https://localhost/movies/movie/rating/"+ n + "/" + id_movie,true);
        xmlhttp.send();
    }
}