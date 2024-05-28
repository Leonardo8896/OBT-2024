import {openDescription} from './description.js'
import {openName} from "./name.js";

const state = document.querySelector('.state')
state.addEventListener('click', ()=>{
    if(state.classList.contains("good")) {
        state.classList.replace("good", "bad")
        state.innerText = 'danificado'
    } else {
        state.classList.replace("bad", "good")
        state.innerText = 'intacto'
    }
})

const selectElement = document.getElementById('country-select');
selectElement.addEventListener('change', (event) => {
    const selectedOption = event.target.selectedOptions[0];
    console.log(`País selecionado: ${selectedOption.text}`);
});

const description = document.querySelector('.description')
description.addEventListener('click', ()=>{
    openDescription(description)
})

const add = document.querySelector('#add-step')

add.oninput = function() {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
};

let steps = 0
add.addEventListener('keypress', (event)=>{
    if (event.key === 'Enter') {
        event.preventDefault()
        steps++
        let step = document.createElement('div')
        step.classList.add('step')

        let input = document.createElement('input')
        input.type = 'checkbox'
        input.name = 'step' + steps
        input.id = 'step' + steps

        let label = document.createElement('label')
        label.innerText = add.value

        let br = document.createElement('br')

        step.appendChild(input)
        step.appendChild(label)
        add.insertAdjacentElement('beforebegin', step)
        add.insertAdjacentElement('beforebegin', br)
        add.value = null
        add.height = '3.2vh'
    }
})

const save = document.querySelector('#save')
save.addEventListener('click', ()=>{
    let data = {};
    data.name = document.querySelector('.title').innerText ?? document.querySelector('.name-input').value
    data.state = document.querySelector('.state').innerText
    data.country = document.querySelector('#country-select').value
    data.description = document.querySelector('.description').innerText ?? document.querySelector('.description-text').value

    data.steps = []
    let steps_divs = document.querySelectorAll('.step')
    steps_divs.forEach((step)=>{
        let checkbox = step.querySelector('input')
        let label = step.querySelector('label')
        let step_data = {
            check: checkbox.checked,
            text: label.innerText
        }

        data.steps.push(step_data)
    })

    console.log(JSON.stringify(data))
    let json_data = JSON.stringify(data)
    $.ajax({
        url: './?page=project&for=save',
        method: 'POST',
        data: json_data,
        statusCode: {
            200: function (response) {
                console.log(response)
                window.alert('O projeto foi salvo')
                window.location.href = './?page=home'
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
})

const name = document.querySelector('.title')
console.log(name)
name.addEventListener('click', ()=>{
    openName(name)
    console.log('Teste')
})