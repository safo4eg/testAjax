let form = document.querySelector('form');

let input1 = document.querySelector('[name="num1"]');
let input2 = document.querySelector('[name="num2"]');

form.addEventListener('submit', event => {
    fetch('index-handler.php', {
        method: 'POST',
        body: new FormData(form),
    }).then(
        response => {
            return response.text();
        }
    ).then(
        text => {
            console.log(text);
        }
    );

    event.preventDefault();
});