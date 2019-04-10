$(document).ready(function () {

    $("#CNPJ").mask("000.000.000-00");

    $("form").submit(function () {

        if($("#TipoId").val()=="") {
            error("Você deve selecionar o tipo de usuário", $("#TipoId").parent());
            return false;
        }
        
        if (!TestaCPF($("#CNPJ").val())) {
            error("CPF digitado é inválido", $("#CNPJ").parent());
            return false;
        }
        
        if($("#Senha").val()!==$("#ConfirmarSenha").val()) {
            error("Senhas digitadas não são iguais", $("#Senha").parent());
            return false;
        }
    });

    new dgCidadesEstados({
        cidade: document.getElementById('Cidade'),
        estado: document.getElementById('Estado'),
        estadoVal: $("#Estado").data('estado'),
        cidadeVal: $("#Cidade").data('cidade')
    })
});


function TestaCPF(strCPF) {
    strCPF = strCPF.replace(/[^\d]+/g, '');

    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000")
        return false;
    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)))
        return false;
    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11)))
        return false;

    return true;
}