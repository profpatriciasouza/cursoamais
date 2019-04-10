$(".alterar-senha").click(function () {
    $("#alterar-senha").load("/sac/index/senha");
});

$(document).ready(function () {
    new dgCidadesEstados({
        cidade: document.getElementById('Cidade'),
        estado: document.getElementById('Estado'),
        estadoVal: $("#Estado").data('estado'),
        cidadeVal:  $("#Cidade").data('cidade')
    })
});

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/sac/index/enviar-foto';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            //console.log(data._response.result.name);

            $("#foto-usuario").attr('src', data._response.result.name);

            $("#progress").hide();
            $('#progress .progress-bar').css(
                    'width',
                    0 + '%'
                    );
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $("#progress").show();
            $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                    );
        }
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
});