setInterval( (e) => {
    document.querySelectorAll('.slide').forEach((elm) => {
        elm.classList.toggle('banner__hide')
    })
}, 3500 )