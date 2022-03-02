let url_string = window.location.href; 
let url = new URL(url_string);
let paramValue = url.searchParams.get("id");


function GetFood() {
    fetch(`/api/v1.0/getfood/${paramValue}`).then(
        resp => resp.json()
    ).then(
        data =>{ 
            console.log(data)
            renderFood(data[0])
        }
    )
}

function renderFood(data) {
    let col = document.querySelector('.item__content')
    col.insertAdjacentHTML("afterbegin" , `
    <div class="item__item" style="background: url('${data.img_title}'); background-position: center;
    background-size: cover;">
                            
    </div>
    <div class="item__info">
        <h1>${data.title}</h1>
        <p>
            ${data.text}
        </p>
        <form action="" onsubmit="GetZakaz(); return false">
            <p>Оформить доставку</p>
            <input type="text" placeholder="Адрес доставки">
            <input type="text" placeholder="Имя">
            <input type="text" placeholder="Телефон">
            <button>Заказать</button>
        </form>
    </div>
    `)
}

GetFood()

function GetZakaz() {
    document.querySelector('.alert__zakz').classList.remove("alert__hide")
}

function GetCom() {
    fetch(`/api/v1.0/getcom/${paramValue}`).then(
        resp => resp.json()
    ).then(
        data => renderCom(data)
    )
}


function renderCom(data) {
    let col = document.querySelector(".item__col")
    col.innerHTML = ""
    for(let prop of data) {
        col.insertAdjacentHTML("beforeend" , `
            <div class="item__row">
                <p>${prop.name}</p>
                <p>${prop.text}</p>
            </div>
        `)
    }
}

GetCom()

document.querySelector('.btn__send').addEventListener('click' , (e) => {
    
    e.preventDefault()
    GetName()
    
})


function GetName() {
    let uuid = getCookie('uuid');
    fetch(`/api/v1.0/getuser/${uuid}`)
    .then(resp => resp.json())
    .then(data => {
        console.log(data)
        if(data) {
            SendCom(data)
        } else {
            document.querySelector('.alert__login').classList.remove('alert__hide')
        }
    })
}


function SendCom(obj) {
    let body = new FormData(document.querySelector('.item__form'))

    let names = obj.login
    let texts = body.get('texts')

    fetch(`/api/v1.0/setcom/${texts}/${names}/${paramValue}`).then(
        resp => resp.json()
    ).then(
        data => GetCom(data)
    )
}