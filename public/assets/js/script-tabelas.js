$(document).ready(function () {

       $.ajax({
           type: "POST",
           url: '/home/carregarTabelas',
           success: function (data) {
               if (data) {
                   let obj = $.parseJSON(data);
                   $(obj).each(function ($a) {
                       preecherCampo("#tabelas", obj[$a]);
                   })
               }
           },
       });

});

function preecherCampo($nomeCampo, $dado) {
    $($nomeCampo).append(criarOption($dado));
}