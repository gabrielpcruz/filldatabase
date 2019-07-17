var Config = (function () {

    var validarFormulario = function ($formulario) {

        let valido = true;

        let target = $($formulario).find('input[type=text], input[type=password]');

        let mensagens = [];

        $.each(target, function () {
            if (!$(this).val()) {
                mensagens.push($(this).attr("name"));
                valido = false;
            }
        });

        if (mensagens.length) {
            exibirMensagem("Informe os campos: " + mensagens.join(", ") + ".", 'error')
        }

        return valido;

    };

    var conectar = function () {
        // noinspection JSCheckFunctionSignatures
        $(document).ready(function () {
            // noinspection JSCheckFunctionSignatures
            $("#formulario").on("submit", function ($event) {
                $event.preventDefault();

                if (!validarFormulario(this)) {
                    return;
                }

                if ($.trim($("#submit").text()) == 'conectar') {
                    prepararConexao(this);
                } else {
                    desconectar()
                }
            });
        });
    };

    /**
     * Responsável por desconectar do bando de dados
     * @param $mensagem
     */
    var desconectar = function ($mensagem) {

        $.ajax({
            type: "POST",
            url: '/home/desconectar',
            success: function ($data) {

                var $mensagem = ($.trim($data) != "") ? $data.msg : "Desconectado com sucesso";
                var $status = ($.trim($data) != "") ? $data.status : "success";

                exibirMensagem($mensagem, $status);

                htmlDesconectar($data);
            }
        });
    };

    /**
     * Tenta conectar no banco de dados de fato
     *
     * @param $formulario | formulário já serializado
     */
    var iniciarConexao = function ($formulario) {

        $.ajax({
            type: "POST",
            url: '/home/conectar',
            data: {data: $formulario},
            success: function ($data) {

                if ($data) {
                    $data = JSON.parse($data);

                    if ($data.status == 'success') {
                        htmlConectar($data);
                        ScriptTabelas.init();
                    } else {
                        exibirMensagem($data.msg, $data.status);
                        limparHtml($data);
                    }
                }
            }
        });
    };

    /**
     * Antes de tentar conectar, é necessário preencher o arquivo de configuração com os dados informados
     * Pois o preenchimento do arquivo leva cerca de 2 segundos, como a execução é muito rápida,
     * criei os dois passos "prepararConexao" e finalmente o "conectar" com um pequeno intervalo de 3 segundos
     * e uma animação no botão de status que indica "concetando..."
     *
     * @param $formulario
     */
    var prepararConexao = function ($formulario) {

        $formulario = $($formulario).serialize();

        $.ajax({
            type: "POST",
            url: '/home/prepararConexao',
            data: {data: $formulario},
            success: function ($data) {

                if (typeof $data == "string") {
                    var $data = $data.replace("<?php", "");

                    $data = JSON.parse($.trim($data));

                    if ($data.erro == 0) {
                        setTimeout(function () {
                            iniciarConexao($formulario)
                        }, 3000);

                        $("#conexao").html('<i class="fa fa-spinner fa-spin fa-fw"></i><strong ">conectando...</strong>');
                    } else {
                        $data = {msg: 'Erro ao preparar a configuração de conexão.', status: 'error'};
                        desconectar($data);
                    }
                }
            },
        });
    };

    /**
     * Muda os textos de alguns html e exibe mensagem
     * @param $data
     */
    var htmlConectar = function ($data) {

        $("#conexao").text($data.conexao);
        $("#conexao").removeClass('badge-warning');
        $("#conexao").addClass('badge-success');
        $("#submit").text('logout');
        exibirMensagem($data.msg, $data.status)
    };

    /**
     * Limpa os inputs padrões
     */
    var limparHtml = function () {

        $("#host").val('');
        $("#usuario").val('');
        $("#senha").val('');
        $("#banco").val('');
        $("#tabelas").html('<option class="form-control" value=""></option>');
        $("#campos").html('');
        $("#conexao").text('conexão pendente');
    };

    /**
     * Muda os textos dos html e chama afunção que limpa os inputs
     * @param $data
     */
    var htmlDesconectar = function ($data) {

        $("#conexao").text($data ? $data.conexao : "conexão pendente");
        $("#conexao").removeClass('badge-success');
        $("#conexao").addClass('badge-warning');
        $("#submit").text('conectar');
        limparHtml();
    };

    /**
     * Exibe mensagens
     *
     * @param $mensagem
     * @param $status
     */
    var exibirMensagem = function ($mensagem, $status) {
        toastr[$status]($mensagem);
    };

    /**
     * Revelando métodos
     *
     * @return object
     */
    return {
        init: function () {
            conectar();
        }
    };
})();

$.getScript("assets/js/script.js", function () {});
$.getScript("assets/js/script-tabelas.js", function () {});

Config.init();
