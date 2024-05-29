export function openDescription(description) {
    let textArea = document.createElement('textarea')
    textArea.classList.add('description-text')
    textArea.value = description.innerText

    let finish = document.createElement('button')
    finish.id = 'finish'
    finish.classList.add('edit-description')
    finish.innerText = "Fechar descrição"
    finish.addEventListener('click', ()=>{
        if (textArea.value) {
            closeDescription(textArea, finish)
        }
    })

    description.parentElement.replaceChild(textArea, description)
    textArea.insertAdjacentElement('afterend', finish)
    textArea.style.height = "auto";
    textArea.style.height = textArea.scrollHeight + "px";

    textArea.oninput = function() {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    };


    textArea.focus();
    textArea.setSelectionRange(textArea.value.length, textArea.value.length);
}

export function closeDescription(textArea, button) {
    let p = document.createElement('p')
    p.innerText = textArea.value
    p.classList.add('description')

    p.addEventListener('click', ()=>{
        openDescription(p)
    })

    button.parentElement.removeChild(button)
    textArea.parentElement.replaceChild(p, textArea)
}