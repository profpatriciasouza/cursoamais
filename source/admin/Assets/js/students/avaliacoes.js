$(".btn-ajax").on("click", function (e) {
    e.preventDefault();

    $(this).html("Aguarde...");
    $(this).load($(this).prop("href"), function () {
        setTimeout(function () {
           location.reload(); 
        }, 3000);
    });


});