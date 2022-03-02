let navHide = document.querySelector('.banner__nav ol')
let navBtn = document.querySelector('.bar__menu')

window.addEventListener('scroll' , (e) => {
    if(window.pageYOffset > 200) {
        navHide.classList.add('nav__hide')
        navBtn.classList.remove('nav__hide')

    } else {
        navHide.classList.remove('nav__hide')
        navBtn.classList.add('nav__hide')

    }
})