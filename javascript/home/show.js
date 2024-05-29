export function showProjects(data, container) {
    let i = 0
    data.forEach((project)=>{
        let a = document.createElement('a')
        a.classList.add('project')
        a.href = './?page=project&id=' + i

        let div = document.createElement('div')
        div.classList.add('cover')

        let p = document.createElement('p')
        p.innerText = project.name

        let span = document.createElement('span')
        span.innerText = project.status
        span.classList.add('state')
        if (project.status === 'intacto') {
            span.classList.add('good')
        } else if (project.status === 'danificado') {
            span.classList.add('bad')
        }

        a.appendChild(div)
        a.appendChild(p)
        a.appendChild(span)
        container.appendChild(a)

        i++
    })
}