var Script = (function () {

    desabilitarBotes = function () {
        $("#gerarscript").prop('disabled', 'disabled');
        $("#filldatabase").prop('disabled', 'disabled');
    };

    habilitarBotoes = function () {
        $("#gerarscript").prop('disabled', '');
        $("#filldatabase").prop('disabled', '');
    };

    /**
     * Revelando métodos
     *
     * @return object
     */
    return {
        desabilitarBotes: function () {
            desabilitarBotes();
        },
        habilitarBotoes: function () {
            habilitarBotoes();
        }
    };
})();
