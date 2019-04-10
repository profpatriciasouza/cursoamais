$(".sair").click(function() {
    $.facebox.close();
});

$("[redirecionar]").each(function() {
    console.log("Redirecionar associado");
    $(document).bind('close.facebox', function() {
        if ($("[redirecionar]").attr('redirecionar') === "reload") {
            HTTP.reload();
        } else {
            HTTP.redirect($("[redirecionar]").attr('redirecionar'));
        }
    });
});