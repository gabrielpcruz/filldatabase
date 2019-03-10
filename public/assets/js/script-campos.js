$(document).ready(function () {
   $("#tabelas").change( function () {
       $tabela = $(this).val();

       $.ajax({
           type: "POST",
           url: '/home/carregarCampos',
           data: {'tabela':$tabela},
           success: function (data) {
               let obj = $.parseJSON(data);

               $("#campos").html("");

               $(obj).each(function ($a) {
                    console.log($a)
                   criarCampo(obj[$a]);
               })
           },
       });

   });
});

/**
 *
 * @param $campo
 */
function criarCampo($campo) {

    let $div = criarDiv();
    let $label = criarLabel($campo);
    let $select = criarSelect($campo);

    $div.append($label);
    $div.append($select);

    $("#campos").append($div);
}

/**
 *
 * @returns {void|jQuery|HTMLElement}
 */
function criarDiv() {
    //Div
    let $div = $("<div>");

    $div.attr("class", "form-group col-md-3 float-left");

    return $div;
}

/**
 *
 * @param $nomeCampo
 * @returns {void|jQuery|HTMLElement}
 */
function criarLabel($nomeCampo) {
    //Label
    let $label = $("<label>");

    $label.text($nomeCampo['campo']);

    return $label;
}

/**
 *
 * @param $campo
 * @returns {void|jQuery|HTMLElement}
 */
function criarSelect($campo) {
    //Select
    let $select = $("<select>");

    $select.attr("class", "form-control");
    $select.attr("disabled", "disabled");
    $select.attr("name", $campo['campo']);
    $select.attr("id", $campo['campo']);
    $select.attr("data-tamanho", $campo['tamanho']);
    $select.append(criarOptionCampo($campo['tipo'], $campo['tamanho']));

    return $select;
}

/**
 *
 * @param $nome
 * @returns {void|jQuery|HTMLElement}
 */
function criarOptionTabela($nome = "teste") {
    //Option
    let $option = $("<option>");

    $option.text($nome)
    $option.attr("value", $nome)

    return $option;
}


/**
 *
 * @param $nome
 * @param $tamanho
 * @returns {void|jQuery|HTMLElement}
 */
function criarOptionCampo($nome = 'teste', $tamanho = 'erro') {
    //Option
    let $option = $("<option>");
    let $tipo_tamanho = $nome + "(" + $tamanho + ")";

    $option.text($tipo_tamanho)

    $option.attr("value", $nome)

    return $option;
}