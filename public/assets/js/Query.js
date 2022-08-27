let Query = (() => {

    let listenerGenerateQuery = () => {
        $(document).on('click', "#generate_query", (event) => {
            event.preventDefault();
            let table = $("#tables").val();

            console.log(table)
            $.post('http://localhost/insert', {table: table})
                .then((response) => {

                    $("#query").text(response.query)
                }).fail(() => {
                console.log("error")
            });
        });
    };

    return {
        init: () => {
           listenerGenerateQuery();
        },
    }
})();

$(() => {
    Query.init();
});