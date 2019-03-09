$(document).ready(function(){

  $("#logar").click(function(e){
    e.preventDefault();
    let form = $("#form-login")[0];

    let email = $("#email").val();
    let senha = $("#senha").val();

    let data = {"email": email, "senha": senha};

    data = JSON.stringify(data);

      $.ajax({
            type: 'GET',
            url: 'login/logar?params=' + data,
            data: { "params":{data} },
            processData: false,
            contentType: false

        }).done(function (data) {
            console.log(data)
        });
  });

});
