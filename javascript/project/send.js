export function send(data) {
    console.log(JSON.stringify(data))
    let json_data = JSON.stringify(data)
    $.ajax({
        url: './?page=project&for=save',
        method: 'POST',
        data: json_data,
        statusCode: {
          101: function (response) {
              console.log(response)
          }
        },
        error: function (erro) {
            console.log("Erro " + erro.status + ": " + erro.statusText)
            console.log(erro)
        },
        cache: false,
        contentType: 'application/json',
        processData: false
    })
}