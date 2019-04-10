$(document).ready(function() {
    var cache = {};
    $("[autobusca]").each(function() {
        var urlBusca = $(this).attr("autobusca");
        var id = $(this).parent().attr("id");
        var idHidden = "ID_" + id;
        
        $(this).autocomplete({
            source: function(request, response) {
                var term = request.term;
                if (term in cache) {
                    response(cache[ term ]);
                    return;
                }
                
                //busca dados
                $.getJSON(urlBusca, request, function(data, status, xhr) {
                    cache[ term ] = data;
                    response(data);
                });
            }
            , change: function(event, ui) {
                console.log(ui);
                $("#" + idHidden).val('');
                if (ui.item)
                    $("#" + idHidden).val(ui.item.id);
            }
            , close: function(event, ui) {
                if (!ui.item) {
                }
            }
            , minLength: 3
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                    .attr("data-value", item.label)
                    .append("<a>"+item.label+"</a>")
                    .appendTo(ul);
        };
    });
});