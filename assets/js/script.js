$(document).ready(function(){

    var options =  {
        onKeyPress: function(cep, e, field, options) {
          var masks = ['00000-000', '0-00-00-00'];
          var mask = (cep.length>7) ? masks[1] : masks[0];
          $('.crazy_cep').mask(mask, options);
      }};
      
      $('#cep').mask('00000-000', options);


      $("#cpf").mask("000.000.000-00")
      // $("#tel").mask("(00) 0000-0000")
  
      $('#telefone').mask('(00) 0000-00009');
      $('#telefone').blur(function (event) {
          if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
              $('#telefone').mask('(00) 00000-0009');
          } else {
              $('#telefone').mask('(00) 0000-00009');
          }
      });

});