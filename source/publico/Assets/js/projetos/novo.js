$(document).ready(function() {
    $("#CNPJ").mask("00.000.000/0000-00");
});
$("#NovoProjeto").submit(function (e) {
    e.preventDefault();
    if ($("#Titulo").val() == "") {
        $("#Titulo").focus();
        error("Você deve preencher o titulo do seu projeto", $(".novo-cadastrar-projeto"));
        return;
    }
    if ($("#AreaId").val() == "") {
        $("#AreaId").focus();
        error("Selecione qual área você busca auxílio", $(".novo-cadastrar-projeto"));
        return;
    }
    if ($("#ServicoId").val() == "") {
        $("#ServicoId").focus();
        error("Selecione qual serviço desejado", $(".novo-cadastrar-projeto"));
        return;
    }
    if ($("#Descricao").val() == "") {
        $("#Descricao").focus();
        error("Uma boa descrição nos ajudará a entender seu problema, por favor preencha a descrição", $(".novo-cadastrar-projeto"));
        return;
    }

    if (!TestarCNPJ($("#CNPJ").val())) {
        error("CNPJ digitado é inválido", $(".novo-cadastrar-projeto"));
        return false;
    }



    $("[type=submit]").text("Aguarde...").attr("disabled", true);

    $.post($(this).attr("action"), $(this).serialize(), function (obj) {
        obj = $.parseJSON(obj);

        $("[type=submit]").text("Cadastrar Projeto").attr("disabled", false);
        if (!obj.error) {
            location.href = '/sac/projetos/projeto/id/' + obj.id;
        } else {
            error(obj.message, $(".novo-cadastrar-projeto"));
        }
    });
});
$(document).on("click", ".delete-file", function () {
    if (confirm("Tem certeza que deseja excluir este arquivo?"))
        $(this).parent().remove();
})
$(function () {
    // Change this to the location of your server-side upload handler:
    var url = '/sac/index/enviar-arquivos';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        multiple: true,
        done: function (e, data) {
            //console.log(data._response.result.name);
            //data._response.result.name
            filename = data._response.result.name.split("/");
            filename = filename[filename.length - 1];

            $("#files").append($("<div class=arquivo><input type=hidden name=arquivos[] value='" + data._response.result.name + "'><i class='fa fa-file-o'></i> <a href='" + data._response.result.name + "'>" + filename + "</a> <i class='fa fa-times-circle delete-file'></i></div>"));

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

function TestarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '')
        return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;

}