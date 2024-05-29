import {showProjects} from "./show.js";

const projects_container = document.querySelector('.projects_container')

$.ajax({
    url: './?page=project&for=get-projects',
    method: 'GET',
    statusCode: {
        200: function (response) {
            showProjects(JSON.parse(response), projects_container)
        }
    },
    error: function (erro) {
        // console.log("Erro " + erro.status + ": " + erro.statusText)
        console.log(erro)
    },
    cache: false,
    processData: false,
    dataType: 'json'
})