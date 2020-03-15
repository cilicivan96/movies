$('body').loadingModal({
        text:'Loading...',
        animation:'wave'
});
    
$(document).ready(function() {
        $('#table').DataTable( {
                "order": [[ 2, "desc" ]]
        } );
        $('body').loadingModal('destroy');
});

function buttonPressed() {
        $('#getrecs').hide();
        $('body').loadingModal({
                text:'Waiting for recommendation algorithm...',
                animation:'wanderingCubes'
        });

        if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
        } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        setTimeout(function(){
                                $('#showrecs').show();
                                $('body').loadingModal('destroy');
                        }, 45000);
                }
        };
        xmlhttp.open("GET","https://localhost/movies/recommendation/",true);
        xmlhttp.send(); 
}