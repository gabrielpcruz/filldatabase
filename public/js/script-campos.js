$(document).ready(function () {
   $("#tabelas").change( function () {
       $tabela = $(this).val();

       $.ajax({
           type: "POST",
           url: 'vendor/class/TabelasAjax.php?function=ajaxCampos',
           data: {'params' : {
                    $tabela
                 }
               },
           success: function (data) {
               let obj = $.parseJSON(data);

               $("#campos").html("");

               $(obj).each(function ($a) {

                   criarCampo(obj[$a]);
               })
           },
       });

   });
});

function criarCampo($nomeCampo) {

    let $div = criarDiv();
    let $label = criarLabel($nomeCampo);
    let $select = criarSelect($nomeCampo);


    $div.append($label);
    $div.append($select);

    $("#campos").append($div);
}

function criarDiv() {
    //Div
    let $div = $("<div>");

    $div.attr("class", "form-group col-md-3 float-left");

    return $div;
}

function criarLabel($nomeCampo) {
    //Label
    let $label = $("<label>");

    $label.text($nomeCampo['campo']);

    return $label;
}

function criarSelect($nomeCampo) {
    //Select
    let $select = $("<select>");

    $select.attr("class", "form-control");
    $select.attr("name", $nomeCampo['campo']);
    $select.attr("id", $nomeCampo['campo']);

    $select.append(criarOption($nomeCampo['tipo']));

    return $select;
}

function criarOption($nome = "teste") {
    //Option
    let $option = $("<option>");

    $option.text($nome)
    $option.attr("value", $nome)

    return $option;
}