var init = 0;

$("#dialog").dialog({ 
    autoOpen: false,
    maxHeight: 400,
    overflow:'scroll'
});

$('#opener').click(function() {
    $('#dialog').dialog('open');
});

function toprated() {
    var genre = $('#toplist').find(":selected").attr("value");
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var str = JSON.parse(this.responseText);
                $("#top").html(str);
                $('#top').show();
                if(init === 1) {
                    $("#top").dataTable().fnDestroy();
                }
                $('#top').DataTable( {
                    "order": [[ 1, "desc" ]]
                } );
                init = 1;
            }
    };
    xmlhttp.open("GET","https://localhost/movies/userprofile/toprated/" + genre,true);
    xmlhttp.send(); 
}