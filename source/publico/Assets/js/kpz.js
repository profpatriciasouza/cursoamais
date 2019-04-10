function error(msg, obj) {
    $(".alert", obj).remove();
    $(obj).prepend($("<div></div>").addClass("alert alert-danger").text(msg));

}
function sucesso(msg, obj) {
    $(".alert", obj).remove();
    $(obj).prepend($("<div></div>").addClass("alert alert-success").text(msg));

}

$(".enviar-validacao").click(function (e) {
    e.preventDefault();
    $(this).parent().load($(this).attr("href"));
});

$(".btn-delete").on("click", function (e) {
    if (!confirm("Tem certeza que deseja excluir?")) {
        e.preventDefault();
    }
});

$(".btn-ajax").on("click", function (e) {
    e.preventDefault();
    var btnContent = $(this).html();
    $(this).html("aguarde...");
    $(this).load($(this).prop("href"), function () {
        setTimeout(function () {
            location.reload();
        }, 3000);
    })
});

$(".btn-excluir-imagem").on("click", function (e) {
    if (confirm("Tem certeza que deseja excluir?")) {
        $(this).parent().remove();
        e.preventDefault();
    }
});

$("[mask]").each(function () {
    $(this).mask($(this).attr("mask"));
});

$("#SelecionaModulo").on("change", function () {
    location.href = $(this).val();
});

$(document).ready(function() { 
    $(treepolar.callback).map(function (i, f) {
        f();
    });
});