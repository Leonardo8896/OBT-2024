export function setName(name) {
    const name_p = document.querySelector('.title')
    name_p.innerText = name
}

export function setDescription(description) {
    const description_p = document.querySelector('.description')
    description_p.innerText = description
}

export function setPais(pais) {
    const pais_select = document.querySelector('.flag-select')
    pais_select.value = pais
}

export function setStatus(status) {
    const status_span = document.querySelector('.state')
    status_span.innerText = status
    if (status === 'danificado') {
        status_span.classList.replace('good', 'bad')
    }
}

export function setReparo(reparo) {
    const step_add = document.querySelector('#add-step')
    let steps = 0
    reparo.forEach((step)=>{
        steps++
        let div = document.createElement('div')
        div.classList.add('step')

        let input = document.createElement('input')
        input.type = 'checkbox'
        input.name = 'step' + steps
        input.id = 'step' + steps
        input.checked = step.check

        let label = document.createElement('label')
        label.for = 'step' + steps
        label.innerText = step.text


        div.appendChild(input)
        div.appendChild(label)
        step_add.insertAdjacentElement('beforebegin', div)
    })
}