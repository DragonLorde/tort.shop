function GetUser() {
    let uuid = getCookie('uuid');
    fetch(`/api/v1.0/getuser/${uuid}`)
    .then(resp => resp.json())
    .then(data => {
        if(data) {
            Rerender(data);
            Rerender2(data);
        }
    })
}

function Rerender(data) {
    let lg = document.querySelector('#lg')
    if(lg) {
        lg.innerHTML = ''
        lg.insertAdjacentHTML('afterbegin' , `
            <p style="    font-family: Roboto;
            color: #F1F1F1;
            font-size: 24px;">Привет! ${data.login}</p>
            <button onclick="LogOut();" style="    width: 65px;
            height: 40px;
            background: #f2c71a00;
            font-size: 40px;
            color: white;
            -webkit-transition: 0.4s;
            transition: 0.4s;">Выйти</button>
        `)
    }
}


function Rerender2(data) {
    let lg = document.querySelector('#lg2')
    lg.innerHTML = ''
    lg.insertAdjacentHTML('afterbegin' , `
    <p style="    font-family: Roboto;
    color: black;
    font-size: 24px;">Привет! ${data.login}</p>
        <button onclick="LogOut();">Выйти</button>
    `)
}


function LogOut() {
    deleteCookie('uuid');
    window.location = '/'
}

GetUser()