var mensagens = {};

$("#administracao").submit(function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        dataType: 'JSON',
        type: "POST",
        success: function (obj) {
            alert(obj.message);
        }
    });


    return false;
});

$(".btn-concluir-projeto").click(function (e) {
    e.preventDefault();
    if (confirm("Ao concluir o projeto um e-mail será enviado para o cliente e somente o administrador poderá desfazer esta mudança, tem certeza que deseja concluir o projeto?")) {
        $(".btn-concluir-projeto").html("Aguarde...");
        $.ajax({
            url: $(this).attr("href"),
            dataType: "JSON",
            success: function (obj) {
                if (obj.error) {
                    alert(obj.message);
                } else {
                    $(".btn-concluir-projeto").removeClass("btn-info").addClass("btn-primary").text(obj.message);
                }

                mensagens.recarrega();
            }

        })
    }
});

$("#MensagemProjeto").submit(function (e) {
    e.preventDefault();

    if ($("#Mensagem").val() == "") {
        $("#Mensagem").focus()
        error("Preencha a mensagem", $("#MensagemProjeto"));
        return false;
    }

    $.post("/sac/projetos/nova-mensagem", $(this).serialize(), function (obj) {
        if (obj.error) {
            error(obj.message, $("#MensagemProjeto"));
        } else {
            $("#Mensagem").val('');
            $("#files").html('');
            sucesso(obj.message, $("#MensagemProjeto"));
            mensagens.recarrega();
        }
    }, 'json');

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

mensagens.recarrega = function () {
    $("#chats").load(location.href + " .chats", mensagens.posiciona);

};

mensagens.posiciona = function () {

    var objDiv = $(".panel-body:has(.chats)")[0];
    objDiv.scrollTop = objDiv.scrollHeight;
}


mensagens.posiciona();

