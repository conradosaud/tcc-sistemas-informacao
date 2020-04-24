$(document).ready(function(){
    $("#btnTopo").click(function(){
        $("html, body").animate({ scrollTop: $(".navbar-default").height()-120 }, 500);
    });
});


