let Connection = (() => {
    let driver;
    let host;
    let username;
    let password;

    let validarCampos = () => {
        driver = $('#driver option:selected').val();
        host = $('#host').val();
        username = $('#username').val();
        password = $('#password').val();

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

    let listenerConnect = () => {
        $(document).on('click', "#connect", (event) => {
            event.preventDefault();

            if (!validarCampos()) {
                return false;
            }

            let data = {
                driver: driver,
                host: host,
                database: 'teste',
                username: username,
                password: password
            };

            $.post('http://localhost/connection', data)
                .then((response) => {
                    $.each(response, (index, table) => {
                        Tables.fillTables()
                    })
                }).fail(() => {
                    console.log("error")
                });
        });
    };


    return {
        init: () => {
            listenerConnect();
        }
    }
})();

$(() => {
    Connection.init();
});