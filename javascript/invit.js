const divToggle = document.querySelector('#div-toggle');
const Toggle = document.querySelector('#toggle');

const btnNext = document.querySelector('.btn-next');

var mds;
var ctr = 0;

let selectFile = document.querySelector('#upload-img');
let imgChange = document.querySelector('#img-change');

const prefers = document.querySelectorAll('.pref');
const preload = document.querySelector('.preload');

let view = true;


setTimeout(() => {

    preload.style.display ="none";

}, 5000);

for(let i = 0; i < prefers.length; i++){

    prefers[i].onclick = () => {

        prefers[i].classList.toggle('pref-choisi');

    }

}

btnNext.onclick = () => {

    ctr++;
    document.querySelector('#txt-acc').innerHTML = `<p class=\"col-md-12\"><span style=\"color: dodgerblue;\" class=\"font-bold\">Créer vos propres évènements en quleques clics</span><br> et de les personnaliser selon vos envies.</p>`;

    if(ctr > 1){
        document.querySelector('#txt-acc').innerHTML = `<p class=\"col-md-12\"><span style=\"color: dodgerblue;\" class=\"font-bold\">Inviter vos proches à réjoindre vos évènements</span><br>ou ceux auxquels vous assistez, et de partager vos expériences avec eux.</p>`;
        btnNext.innerText = "Se connecter";

    }
    if(ctr > 2){
        document.querySelector('.link-conn').setAttribute("href", "login.html");
    }

}

divToggle.onclick = () => {

    divToggle.classList.toggle('bg-sky');
    Toggle.classList.toggle('translate');
    if(Toggle.classList.contains('translate')){
        document.body.style.backgroundColor = '#082032';
        document.body.style.color = "#fff";
        localStorage.setItem('mds', true);
    }
    else{
        document.body.style.backgroundColor = '#fff';
        document.body.style.color = "#000";
        localStorage.removeItem('mds');
    }

}

window.onload = () => {

    mds = localStorage.getItem('mds');

    if(mds){
        document.body.style.backgroundColor = '#082032';
        document.body.style.color = "#fff";
        divToggle.classList.add('bg-sky');
        Toggle.classList.add('translate');
    }

}

selectFile.addEventListener('change', function() {

    let imgUrl = URL.createObjectURL(selectFile.files[0]); 
    imgChange.src = imgUrl;

})


function changeView(){

    if(view){
        document.querySelector('.inputPass').setAttribute("type", "text");
        view = false;
        document.querySelector('#oeil').classList.remove('bi-eye-slash-fill');
        document.querySelector('#oeil').classList.add('bi-eye-fill');
    }
    else{
        document.querySelector('.inputPass').setAttribute("type", "password");
        view = true;
        document.querySelector('#oeil').classList.remove('bi-eye-fill');
        document.querySelector('#oeil').classList.add('bi-eye-slash-fill');
    }

}