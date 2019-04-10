$(function () {

    var mudaTipo = function () {

        if ($(this).val() == "0") {

            $("#modalTypeYoutube").hide();
            $("#modalTypeIframe").hide();
            $("#modalTypeInline").hide();
            $("#modalTypeFileset").hide();
        }
        if ($(this).val() == "1") {

            $("#modalTypeYoutube").show();
            //$("#modalTypeVimeo").hide();
            $("#modalTypeIframe").hide();
            $("#modalTypeInline").hide();
            $("#modalTypeFileset").hide();

        }
        if ($(this).val() == "2") {

            $("#modalTypeYoutube").show();
            //$("#modalTypeVimeo").fadeIn(800);
            $("#modalTypeIframe").hide();
            $("#modalTypeInline").hide();
            $("#modalTypeFileset").hide();
        }
        if ($(this).val() == "3") {

            $("#modalTypeYoutube").hide();
            //$("#modalTypeVimeo").hide(300);
            $("#modalTypeIframe").show();
            $("#modalTypeInline").hide();
            $("#modalTypeFileset").hide();
        }
        if ($(this).val() == "4") {

            $("#modalTypeYoutube").hide();
            //$("#modalTypeVimeo").hide(300);
            $("#modalTypeIframe").hide();
            $("#modalTypeInline").show();
            $("#modalTypeFileset").hide();
        }
        if ($(this).val() == "5") {

            $("#modalTypeYoutube").hide();
            //$("#modalTypeVimeo").hide(300);
            $("#modalTypeIframe").hide();
            $("#modalTypeInline").hide();
            $("#modalTypeFileset").show();
        }

    };

    $("#tipo").change(mudaTipo);
    mudaTipo();
});

jQuery('#tbsize , #radius').keyup(function () {
    this.value = this.value.replace(/[^0-9\.]/g, '');
});