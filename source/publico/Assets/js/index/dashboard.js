var load = function () {
    $("[load]").each(function () {
        $(this).load($(this).attr("load"));
    });
}


load();