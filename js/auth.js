let form = document.querySelector('form');

form.addEventListener('submit', event => {

    fetch('../auth/register-handler.php', {
        method: 'POST',
        body: new FormData(form),
    }).then(
        response => {
            return response.text().then(
                json => {
                    return Promise.resolve(json);
            });
    }).then(
        redirect => {
            console.log(redirect);
    }).catch(err => {
        console.log(err);
    });

    event.preventDefault();
});