$(document).ready(function () {
    $("#submit").click(function (event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: 'vendor/class/ConfigAjax.php?function=init',
            success: function (data) {
                if (data) {
                   alert("as")
                }
            },
        });

    });
});