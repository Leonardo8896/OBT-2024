export function openName(element) {
    let textArea = document.createElement('textarea')
    textArea.value = element.innerText
    textArea.classList.add('name-input')

    textArea.addEventListener('keypress', (event)=>{
        if (event.key === 'Enter') {
            closeName(textArea)
        }
    })

    element.parentNode.replaceChild(textArea, element)
}

function closeName(element) {
    let p = document.createElement('p')
    p.innerText = element.value
    p.classList.add('title')
    p.addEventListener('click', ()=>{
        openName(p)
    })

    element.parentNode.replaceChild(p, element)
}