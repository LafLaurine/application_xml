$(document).ready(function() {
    $(".form").hide();
    $("#btn-inscription-candidat").click(function() {
        $(".form-candidat").fadeIn();
    });

    $("#btn-inscription-entreprise").click(function() {
        $(".form-entreprise").fadeIn();
    });

    $(".close ").click(function() {
        $(".form").fadeOut();
    });


    // $(".form-entreprise").hide();


    // $(".form").click(function() {
    //     $(".form-entreprise").fadeOut();
    // });

});