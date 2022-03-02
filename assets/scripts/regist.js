function Login() {
    let body = new FormData( document.querySelector('form') )
    fetch('/api/v1.0/register', {
        method:'POST',
        body:body
    })
    .then( resp => resp.json() )
    .then( data => {
        console.log(data);
        if(data.code == 201) {
            setCookie('uuid' , data.uuid)
            window.location = '/'

        } else {
            alert('неправельный логин или пароль')
        }
    })
}

if(getCookie('uuid')) {
    window.location = '/'
}