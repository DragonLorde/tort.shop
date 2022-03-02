document.querySelector('.srcht').addEventListener('click' , (e) => {
    e.preventDefault()
    let word = document.querySelector('.val__stcht')
   // reslide(`/srch.html?word=${word.value}`)
    window.location = `/srch.html?word=${word.value}`
})



// function Srch() {
//     let word = document.querySelector('.val__stcht').value
//     window.location = `/srch.html?word=${word}`
// }