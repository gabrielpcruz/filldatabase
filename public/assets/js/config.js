$(document).ready(function () {
    $("#formulario").on("submit", function (event) {
        event.preventDefault();
        console.log(this)
        $.ajax({
            type: "POST",
            url: '/home/conectar',
            data: {data: $(this).serialize()},
            success: function (data) {
                if (data) {
                    var data = JSON.parse(data);
                    toastr[data.status](data.msg)
                }
            },
        });
    });
});