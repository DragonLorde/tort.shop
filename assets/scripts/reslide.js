window.onload = () => {
    setTimeout(() => {
        document.querySelector('.reslide').classList.toggle('reslide__hide')
    }, 400);
}


function reslide(loc) {
    document.querySelector('.reslide').classList.toggle('reslide__hide')
    setTimeout(() => {
        window.location = loc
    }, 400);
}