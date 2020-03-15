$('body').loadingModal({
    text:'Loading...',
    animation:'wave'
});

$(document).ready(function() {
    $('#table').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
    $('body').loadingModal('destroy');
});

function favorite(e, id_movie) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if(e.classList.contains("far")) {
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                e.classList.remove("far");
                e.classList.add("fas");
            }
        };
        xmlhttp.open("GET","https://localhost/movies/catalogue/addfavorite/"+ id_movie,true);
        xmlhttp.send();
    } else {
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                e.classList.remove("fas");
                e.classList.add("far");
            }
        };
        xmlhttp.open("GET","https://localhost/movies/catalogue/removefavorite/"+ id_movie,true);
        xmlhttp.send();
    }   
}