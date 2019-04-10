$(".btn-edit-foto").on("click", function() { 
    $(this).parent().parent().find("form").show();
    $(this).parent().hide('slow');
    $(this).parent().parent().find("img").hide('slow');
});