let navBtn1 = document.querySelector('.bar__menu')
document.querySelector('.bar__menu').addEventListener('click' , (e) => {
    navBtn1.classList.toggle('close')
    document.querySelector('.menu').classList.toggle('nav__hide')
})