var ScriptTabelas = (function(){

    var carregarTabelas = function () {

        if ($.trim($("#submit").text()) == 'logout') {
            $.ajax({
                type: "POST",
                url: '/home/carregarTabelas',
                success: function (data) {
                    if (data) {
                        var obj = $.parseJSON(data);
                        $(obj).each(function ($a) {
                            preencherCampo("#tabelas", obj[$a]);
                        })
                    }
                }
            });
        }
    };

    var preencherCampo = function ($nomeCampo, $dado) {
        $($nomeCampo).append(criarOptionTabela($dado));
    };

    /**
     *
     * @param $nome
     * @returns {void|jQuery|HTMLElement}
     */
    var criarOptionTabela = function ($nome) {
        //Option
        var $option = $("<option>");

        $option.text($nome)
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
            carregarTabelas();
        }
    };
})();