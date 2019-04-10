condoo.form.aplicaMascaras();
$("#btnModel").click(function() {
    $("#formModel").submit();
});

var formModel = new function() {
    /*CONSTRUCTOR */
    this.url = null;
    this.trataFormPadrao = function(url) {
        this.url = url;

        $("#formModel").submit(function(e) {
            e.preventDefault();
            condoo.form.validate.limpaObrigatorios();
            condoo.form.validate.addObrigatorios($("#formModel [obrigatorio]"));

            if (condoo.form.validate.checaObriagorios()) {
                condoo.form.wait.init($("#btnModel"));
                condoo.form.registra($(this).attr("action"), $(this).serialize(), function(obj) {
                    if (obj = condoo.form.trataStatus(obj)) {
                        if (obj.status === 1) {
                            $(document).bind('close.facebox', function() {
                                if(typeof(formModel.url)==="function") {
                                    formModel.url();
                                    return;
                                }
                                
                                HTTP.redirect(formModel.url);
                            });
                        }

                        condoo.error.alert(obj.message);
                    }
                })
            }
        });
    };
};