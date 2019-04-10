$(document).ready(function () {
    new dgCidadesEstados({
        cidade: document.getElementById('Cidade'),
        estado: document.getElementById('Estado'),
        estadoVal: $("#Estado").data('estado'),
        cidadeVal: $("#Cidade").data('cidade')
    });

    $(".alterar-senha").click(function () {
        $("#alterar-senha").load("/sac/index/senha");
    });

});
