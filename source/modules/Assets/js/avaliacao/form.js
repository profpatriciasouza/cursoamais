var avaliacao = {};
avaliacao.questions = {};
avaliacao.questions.cleanForm = function () {
    $("#question-title input").val('');
    $("#question-peso input").val('');
    $("#question-description textarea").val('');
    $("#questoes").html('');
    $("#question-title input").data("id", "");
};
avaliacao.questions.add = function () {
    $(".to-delete").fadeOut('slow', function () {
        $(".to-delete").remove();
    });

    var options = [];
    $(".question-options").each(function () {
        if ($(this).val() != "") {
            options.push({
                id: $(this).data("id"),
                status: true,
                title: $(this).val()
            });
        }
    });

    if ($("#question-title input").data("id") !== "" && $("#question-title input").data("id") !== undefined) {
        $id = $("#question-title input").data("id");
    } else {
        $id = $("#lista-questoes tbody tr").length;
        $id++;
    }

    $id = $id === undefined ? 1 : $id;
    console.log($id);
    var json = {
        id: $id
        , title: $("#question-title input").val()
        , peso: $("#question-peso input").val()
        , description: $("#question-description textarea").val()
        , options: options
        , correct: $(".correct:checked").length === 0 ? false : $(".correct:checked").val()
    };

    var btnEdit = $("<button>").prop("type", "button").addClass("btn btn-info").html("Editar").on("click", avaliacao.questions.options.edit);
    var btnDelete = $("<button>").prop("type", "button").addClass("btn btn-danger").html("Excluir").on("click", avaliacao.questions.options.delete);

    $tr = $("<tr>").addClass("question-" + json.id);
    $tr.append($("<td>").html(json.title).append($("<input>").prop({'type': 'hidden', "name": "ava_js_questions[]"}).val(JSON.stringify(json))));
    $tr.append($("<td>").html(json.options.length));
    $tr.append($("<td>").append(btnEdit).append(btnDelete));

    if ($(".question-" + json.id).length > 0) {
        $(".question-" + json.id).replaceWith($tr);
    } else {
        $("#lista-questoes tbody").append($tr);
    }
    avaliacao.questions.cleanForm();

};


avaliacao.questions.options = {};
avaliacao.questions.options.add = function (opcao, title, status) {
    if (opcao === undefined || typeof opcao == "object") {
        opcao = $("#questoes > div").length;
        opcao++;
    }
    if (title === undefined) {
        title = "";
    }
    if (status === undefined) {
        status = true;
    }
    question = '\
            <div class="form-group opcao-' + opcao + '" data-status="' + (status ? "true" : false) + '" style="display: ' + (status ? "block" : "none") + ' ;">\
                <label class="control-label">Opção ' + opcao + '</label>\n\
                <div class="row">\
                    <div class="col-xs-10">\
                        <input type="text" name="Question[options][]" data-id="' + opcao + '" value="' + title + '" class=" form-control question-options" placeholder="Preencha a opção">\
                    </div>\n\
                    <button class="btn-delete-option btn btn-danger"><i class="fa fa-times"></i></button> \
                </div>\
                <label style="display: inline-block;"><input type="radio" class="correct correct-' + opcao + '" value="' + opcao + '"> Opção correta?</label>\
            </div>';

    if ($(".opcao-" + opcao).length > 0) {
        $(".opcao-" + opcao).replaceWith($(question));
    } else {
        $("#questoes").append($(question));
    }




};
avaliacao.questions.options.edit = function () {
    avaliacao.questions.cleanForm();
    $tr = $(this).parent().parent();
    $input = $tr.find("input");
    var question = JSON.parse($input.val());
    console.log(question);
    console.log($("correct-" + question.correct));

    $("#question-title input").data("id", question.id);
    $("#question-title input").val(question.title);
    $("#question-peso input").val(question.peso);
    $("#question-description textarea").val(question.description);

    $(question.options).map(function (i, obj) {
        avaliacao.questions.options.add(obj.id, obj.title, obj.status);
    });

    $(".correct-" + question.correct).prop("checked", true);
};
avaliacao.questions.options.delete = function () {

    if (confirm("Tem certeza que deseja excluir esta questão?")) {
        $(this).parent().parent().fadeOut('slow', function () {
            $(this).remove();
        });
    }
};


$(".btn-add-option").on("click", avaliacao.questions.options.add);
avaliacao.questions.options.add();

$(".btn-add-question").on("click", avaliacao.questions.add);

$(objQuestiosn).map(function (i, json) {
    $(".to-delete").fadeOut('slow', function () {
        $(".to-delete").remove();
    });

    var btnEdit = $("<button>").prop("type", "button").addClass("btn btn-info").html("Editar").on("click", avaliacao.questions.options.edit);
    var btnDelete = $("<button>").prop("type", "button").addClass("btn btn-danger").html("Excluir").on("click", avaliacao.questions.options.delete);

    $tr = $("<tr>").addClass("question-" + json.id);
    $tr.append($("<td>").html(json.title).append($("<input>").prop({'type': 'hidden', "name": "ava_js_questions[]"}).val(JSON.stringify(json))));
    $tr.append($("<td>").html(json.options.length));
    $tr.append($("<td>").append(btnEdit).append(btnDelete));

    if ($(".question-" + json.id).length > 0) {
        $(".question-" + json.id).replaceWith($tr);
    } else {
        $("#lista-questoes tbody").append($tr);
    }
});

$(document.body).on("click", ".btn-delete-option", function (e) {
    e.preventDefault();
    if(confirm("Tem certeza que deseja excluir esta opção?")) {
        $(this).parent().parent().fadeOut('slow', function() { 
           $(this).remove(); 
        });
    }

});