$(".btn-desativar").on("click", function(e){
   if(!confirm("Tem certeza que deseja desativar este curso?"))  {
       e.preventDefault();
   }
});