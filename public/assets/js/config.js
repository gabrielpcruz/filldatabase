$(document).ready(function () {
    $("#formulario").on("submit", function (event) {
        event.preventDefault();
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
                    } else{
                        desconecta(data);
                    }
                }
            },
        });
    });
});

function conecta(data) {
    $("#conexao").text(data.conexao)
    $("#conexao").removeClass('badge-warning')
    $("#conexao").addClass('badge-success')
    $("#submit").text('logout')
}