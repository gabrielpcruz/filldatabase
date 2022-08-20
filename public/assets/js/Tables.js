let Tables = (() => {

    let validarCampos = () => {
        let driver = $('#driver option:selected').val();
        let host = $('#host').val();
        let username = $('#username').val();
        let password = $('#password').val();

        let valid = true;

        if (
            !driver.trim() ||
            !host.trim() ||
            !username.trim() ||
            !password.trim()
        ) {
            valid = false;
        }

        return valid;
    };

    let fillTables = () => {
        $.get('http://localhost/tables')
            .then((response) => {
                let selectTables = $("#tables");
                selectTables.html('');

                $.each(response, (index, table) => {
                    let tableName = table.toString();

                    selectTables.append(
                        $('<option>').attr('value', tableName).append(tableName)
                    );
                })
            }).fail(() => {
            console.log("error")
        });
    };

    let listenerConnect = () => {
        $(document).on('click', "#connect", (event) => {
            event.preventDefault();

            if (!validarCampos()) {
                return false;
            }

            Tables.fillTables();
        });
    };

    return {
        init: () => {
            // listenerConnect();
        },
        fillTables : fillTables
    }
})();

$(() => {
    Tables.init();
});