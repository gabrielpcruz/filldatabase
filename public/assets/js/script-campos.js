var ScriptCampos = (function () {

    var carregarCampos = function(){
        $(document).ready(function () {
            $("#tabelas").change( function () {
                $tabela = $(this).val();

                $.ajax({
                    type: "POST",
                    url: '/home/carregarCampos',
                    data: {'tabela':$tabela},
                    success: function (data) {
                        var obj = $.parseJSON(data);

                        $("#campos").html("");

                        $(obj).each(function ($a) {
                            criarCampo(obj[$a]);
                        })
                    },
                });

            });
        });
    };

    /**
     *
     * @param $campo
     */
    var criarCampo = function($campo) {

        var $div = criarDiv();
        var $label = criarLabel($campo);
        var $select = criarSelect($campo);

        $div.append($label);
        $div.append($select);

        $("#campos").append($div);
    };

    /**
     *
     * @returns {void|jQuery|HTMLElement}
     */
    var criarDiv = function () {
        //Div
        var $div = $("<div>");

        $div.attr("class", "form-group col-md-3 float-left");

        return $div;
    };

    /**
     *
     * @returns {void|jQuery|HTMLElement}
     */
    var criarLabel = function ($nomeCampo) {
        //Label
        var $label = $("<label>");

        $label.text($nomeCampo['campo']);

        return $label;
    };

    /**
     *
     * @param $campo
     * @returns {void|jQuery|HTMLElement}
     */
    var criarSelect = function ($campo) {
        //Select
        var $select = $("<select>");

        $select.attr("class", "form-control");
        $select.attr("disabled", "disabled");
        $select.attr("name", $campo['campo']);
        $select.attr("id", $campo['campo']);
        $select.attr("data-tamanho", $campo['tamanho']);
        $select.append(criarOptionCampo($campo['tipo'], $campo['tamanho']));

        return $select;
    };

    /**
     *
     * @param $nome
     * @param $tamanho
     * @returns {void|jQuery|HTMLElement}
     */
    var criarOptionCampo = function ($nome, $tamanho) {
        //Option
        var $option = $("<option>");
        var $tipo_tamanho = $nome + "(" + $tamanho + ")";

        $option.text($tipo_tamanho)

        $option.attr("value", $nome)

        return $option;
    };

    /**
     * Revelando métodos
     *
     * @return object
     */
    return {
        init : function() {
            carregarCampos();
        },
    };
})();

ScriptCampos.init();