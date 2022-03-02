let url_string = window.location.href; 
let url = new URL(url_string);
let paramValue = url.searchParams.get("word");

document.querySelector(".add").insertAdjacentText("beforeend", paramValue)

let col1 = document.querySelector('.item__col')


function GetFoods() {
    fetch(`/api/v1.0/srch/${paramValue}`).then(
        resp => resp.json()
    ).then(
        data => {
            console.log(data)
            rower(data)
        }
    )
}

function rower(data) {
    for(let prop of data) {
        col1.insertAdjacentHTML("beforeend" , `
        <div class="item__row">
            <img src="${prop.img_title}" alt="">
            <p>${prop.title}</p>
            <p>
                ${prop.text}
            </p>
            <a href="/item.html?id=${prop.id}">Купить</a>
        </div>
        `)
    }
}

GetFoods()