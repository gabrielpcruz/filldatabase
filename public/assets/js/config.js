var Config = (function(){

    var conectar = function () {
        $(document).ready(function () {
            $("#formulario").on("submit", function (event) {
                event.preventDefault();

                if ($.trim($("#submit").text()) == 'conectar') {
                    $.ajax({
                        type: "POST",
                        url: '/home/conectar',
                        data: {data: $(this).serialize()},
                        success: function (data) {
                            if (data) {
                                var data = JSON.parse(data);

                                toastr[data.status](data.msg)

                                if (data.status == 'success') {
                                    conecta(data);
                                    ScriptTabelas.init()
                                } else{
                                    desconecta(data);
                                }
                            }
                        },
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: '/home/desconectar',
                        success: function (data) {
                            toastr["success"]("desconcetado com sucesso")
                            desconecta(data);
                        },
                    });
                }

            });
        });
    };

    var conecta = function conecta(data) {
        $("#conexao").text(data.conexao)
        $("#conexao").removeClass('badge-warning')
        $("#conexao").addClass('badge-success')
        $("#submit").text('logout')
    };

    var desconecta = function desconecta(data = null) {
        $("#conexao").text(data ? data.conexao : "conexão pendente")
        $("#conexao").removeClass('badge-success')
        $("#conexao").addClass('badge-warning')
        $("#submit").text('conectar')
        $("#host").val('')
        $("#usuario").val('')
        $("#senha").val('')
        $("#banco").val('')
        $("#tabelas").html('<option class="form-control" value="Selecione a tabela"></option>')
        $("#campos").html('')
    };

    /**
     * Revelando métodos
     *
     * @return object
     */
    return {
        init : function() {
            conectar();
        },
    };
})();

$.getScript("assets/js/script-tabelas.js", function () {

});

Config.init();
