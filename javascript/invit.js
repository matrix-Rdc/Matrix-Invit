const btnNext = document.querySelector('.btn-next');
var ctr = 0;

const prefers = document.querySelectorAll('.pref');
const preload = document.querySelector('.preload');
let view = true;

const zones = document.querySelectorAll('.zones');
const places = document.querySelectorAll('.place');

const selectMode = document.querySelector('#selectMode');

selectMode.onblur = () =>{

    if(selectMode.value == "presence"){
        document.querySelector('.zoneAdresse').disabled = true;
    }
    else{
        document.querySelector('.zoneAdresse').disabled = false;
    }
}

function overFocus(){

    zones.forEach(zone => {
        zone.onfocus = () => {
            let index; 
            index = zone.getAttribute('data-anim');
            for(let i = 0; i < places.length; i++){
                if(places[i].getAttribute('data-anim') === index){
                    places[i].classList.add('over');
                }
                else{
                    places[i].classList.remove('over');
                }
            }
        }
    
    })
}

function overBlur(){
    zones.forEach(zone => {
        zone.onblur = () => {
            let index; 
            index = zone.getAttribute('data-anim');
            if(zone.value.length > 0){
                for(let i = 0; i < places.length; i++){
                    if(places[i].getAttribute('data-anim') === index){
                        places[i].classList.add('over');
                    }
                }
            }
            else{
                for(let i = 0; i < places.length; i++){
                    if(places[i].getAttribute('data-anim') === index){
                        places[i].classList.remove('over');
                    }
                }
            }
        }
    })
}

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
    document.querySelector('#txt-acc').innerText = `et de les personnaliser selon vos envies.`;
    document.querySelector('#txt-acc-titre').innerText = `Créer vos propres évènements en quleques clics`;

    if(ctr > 1){
        document.querySelector('#txt-acc').innertext = `ou ceux auxquels vous assistez, et de partager vos expériences avec eux`;
        document.querySelector('#txt-acc-titre').innerText = `Inviter vos proches à réjoindre vos évènements`;
        btnNext.innerText = "Se connecter";

    }
    if(ctr > 2){
        document.querySelector('.link-conn').setAttribute("href", "login.html");
    }

}

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

