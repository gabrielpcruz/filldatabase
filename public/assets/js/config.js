var Config = (function(){

    var conectar = function () {
        $(document).ready(function () {
            $("#formulario").on("submit", function (event) {
                event.preventDefault();

                if ($.trim($("#submit").text()) == 'conectar') {
                    prepararConexao(this);
                } else {
                    limparConfiguracoes()
                }

            });
        });
    };

    var limparConfiguracoes = function ($mensagem) {
        $.ajax({
            type: "POST",
            url: '/home/desconectar',
            success: function (data) {
                var $msg = $mensagem ? $mensagem.msg : "desconcetado com sucesso";
                var $status = $mensagem ? $mensagem.status : 'success';
                //Emite um alerta
                toastr[$status]($msg)
                //Muda os textos do html
                htmlDesconectar(data);
            }
        });
    };

    var iniciarConexao = function ($formulario) {
        $.ajax({
            type: "POST",
            url: '/home/conectar',
            data: {data: $($formulario).serialize()},
            success: function (data) {
                if (data) {
                    var data = JSON.parse(data);

                    toastr[data.status](data.msg)

                    if (data.status == 'success') {
                        htmlConectar(data);
                        ScriptTabelas.init()
                    } else{
                        limparConfiguracoes()
                        htmlDesconectar(data);
                    }
                }
            },
        });
    };
    
    var prepararConexao = function ($formulario) {
        $.ajax({
            type: "POST",
            url: '/home/prepararConexao',
            data: {data: $($formulario).serialize()},
            success: function (data) {
                if (typeof data == "string") {
                    var a = data.replace("<?php", "");

                    var data = JSON.parse($.trim(a));

                    if (data.erro == 0) {

                        setTimeout(function () {
                            iniciarConexao($formulario)
                        }, 3000)

                        $("#conexao").html('<i class="fa fa-spinner fa-spin fa-fw"></i><strong ">conectando...</strong>');

                    } else{
                        limparConfiguracoes({msg: 'erro ao preparar a configuração de conexão', status: 'error'})
                    }
                }
            },
        });
    };

    var htmlConectar = function (data) {
        $("#conexao").text(data.conexao)
        $("#conexao").removeClass('badge-warning')
        $("#conexao").addClass('badge-success')
        $("#submit").text('logout')
    };

    var htmlDesconectar = function (data) {
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
        }
    };
})();

$.getScript("assets/js/script-tabelas.js", function () {

});

Config.init();
