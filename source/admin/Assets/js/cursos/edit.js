$(".btn-excluir-imagem").on("click", function(e) {
   if(confirm("Tem certeza que deseja excluir uma imagem?"))  {
      $(this).parent().remove();
   }
});