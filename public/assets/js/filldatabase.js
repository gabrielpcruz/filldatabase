/**
 * Script Responsável por preparar e realizar o insert no banco
 */

$(document).ready(function () {
   $("#filldatabase").click(function (event) {
       event.preventDefault();

       let camposHtml = $("#campos").children();

       let camposBanco = [];

       $(camposHtml).each(function ($i, $campo) {
           camposBanco.push(preencheCamposBanco($($campo)));
       });

       let json = JSON.stringify(camposBanco);

        //Retorna o array
       fillDatabase(json);
   });

});

function preencheCamposBanco($campoBruto) {

    //Pega o nome da e o tipo da Coluna
    let $campo = {
        nomeColuna : $($campoBruto).children().last().attr("id"),
        tipoColuna : $($campoBruto).children().last().val()
    };

    return $campo;
}

function fillDatabase($json) {
    $.ajax({
        type: "POST",
        url: '/home/filldatabase',
        data: {'campos' : $json, 'tabela' : $("#tabelas").val()},
        success: function (data) {
            if (data) {
                var data = JSON.parse(data);

                toastr[data.status](data.msg)
            }
        }
    });
}