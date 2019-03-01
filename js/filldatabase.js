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

       fillDatabase(json);

   });
});

function preencheCamposBanco($campoBruto) {

    //Pega o nome da e o tipo da Coluna
    let $campo = {
        nomeColuna : $($campoBruto).children().last().attr("id"),
        tipoColuna : $($campoBruto).children().last().val()
    };

    //Inicializa um array
    let $campoTratado = [];

    //Popula o array
    $campoTratado.push($campo);

    //Retorna o array
    return $campoTratado;
    // console.log(JSON.stringify(campoTratado))
}

function fillDatabase($json) {

    $.ajax({
        type: "POST",
        url: 'vendor/class/SortDataAjax.php?function=fillDataBase',
        data: {'params' : {
                $json
            }
        },
        success: function (data) {
            console.log("sucesso")
        }
    });
}