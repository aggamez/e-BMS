$(document).ready(function(){
    load_php();
});

function load_div(){
    $("#main").load("login.php");
}

function load_php(){
    $.ajax({
        url: 'dashboard.config.php',
        method: "GET",
        dataType: 'json',
        success: function(response) {
           $('#main').html();
        }
        });
}
