$(function(){
    // Menu Modal Mobile
    $(".button_menu").click(function(){
        $("#menu").fadeToggle( "fast");
        if ($(this).children().hasClass("la-bars")){
            $(this).children().switchClass("la-bars", "la-times", 100, "easeInOutQuad" );
        } else {
            $(this).children().switchClass("la-times", "la-bars", 100, "easeInOutQuad" );
        }
    });


    // Confirmation de suppression
    $("i.remove").click(function(){
        $(".modale_confirmation").fadeToggle("fast");
        $("#shield").fadeToggle("fast");
        console.log("test");
        var target = $(this).parents()[1];
        var user_id = $(target).data("user_id");
        var transaction_id = $(target).data("transaction_id");
        var transaction_type = $(target).data("transaction_type");
        $(target).css("background-color", "#C6E5D9").addClass("target");
        $("#confirm_delete_accept").attr("href", "?id=" + user_id + "&transaction_id=" + transaction_id + "&transaction_type=" + transaction_type)
    })
    $("#confirm_delete_refuse").click(function(){
        $(".modale_confirmation").fadeToggle("fast");
        $("#shield").fadeToggle("fast");
        $(".target").css("background-color", "transparent").removeClass("target");
    });
    $("#shield").click(function(){
        $(".modale_confirmation").fadeToggle("fast");
        $("#shield").fadeToggle("fast");
        $(".target").css("background-color", "transparent").removeClass("target");
    });
});