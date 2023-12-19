const divToggle = document.querySelector('#div-toggle');
const Toggle = document.querySelector('#toggle');

divToggle.onclick = () => {

    Toggle.classList.toggle('translate');
    if(Toggle.classList.contains('translate')){
        document.body.style.backgroundColor = '#082032';
        document.body.style.color = "#fff";
    }

}