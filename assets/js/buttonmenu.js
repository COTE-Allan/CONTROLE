$(function(){
    $(".button_menu").click(function(){
        $("#menu").fadeToggle( "fast");
        if ($(this).children().hasClass("la-bars")){
            $(this).children().switchClass("la-bars", "la-times", 100, "easeInOutQuad" );
        } else {
            $(this).children().switchClass("la-times", "la-bars", 100, "easeInOutQuad" );
        }
    });
});