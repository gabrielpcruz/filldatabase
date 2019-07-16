/**
 * Script Responsável por preparar e realizar o insert no banco
 */

$(document).ready(function () {
    $("#filldatabase").click(function (event) {
        event.preventDefault();

        if (!validarTabela()) {
            toastr['error']("Selecione uma tabela")
            return false
        }

        var camposHtml = $("#campos").children();

        var camposBanco = [];

        $(camposHtml).each(function ($i, $campo) {
            camposBanco.push(preencheCamposBanco($($campo)));
        });

        var json = JSON.stringify(camposBanco);

        //Retorna o array
        fillDatabase(json);
    });

});

function validarTabela()
{
    return $.trim($("#tabelas").val());
}

/**
 *
 * @param $campoBruto
 * @returns {{nomeColuna: (*|jQuery|*|*|*|*), tamanhoColuna: (*|jQuery|*|*), tipoColuna: (*|jQuery|*|*|*)}}
 */
function preencheCamposBanco($campoBruto)
{
    //Pega o nome da e o tipo da Coluna
    var $campo = {
        nomeColuna: $($campoBruto).children().last().attr("id"),
        tipoColuna: $($campoBruto).children().last().val(),
        tamanhoColuna: $($campoBruto).children().last().data("tamanho"),
    };

    return $campo;
}

/**
 *
 * @param $json
 */
function fillDatabase($json)
{
    $.ajax({
        type: "POST",
        url: '/home/filldatabase',
        data: {'campos': $json, 'tabela': $("#tabelas").val()},
        success: function (data) {
            if (data) {
                var data = JSON.parse(data);

                toastr[data.status](data.msg)
            }
        }
    });
}
