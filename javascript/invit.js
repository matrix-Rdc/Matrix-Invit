var ctr = 0;
const btnNext = document.querySelector('.btn-next');
const selectmode = document.querySelector('#selectmode');

const prefers = document.querySelectorAll('.pref');
const preload = document.querySelector('.preload');
let view = true;

const zone = document.querySelector('.zone');
const place = document.querySelector('.place');

setTimeout(() => {

    preload.style.display = 'none';

}, 5000);

function continuerSans(){
    document.querySelector('#btnSuivant').disabled =  false;
    document.querySelector('#btnEnreg').disabled = true;
    document.querySelector('#nameTable').disabled = true;

    document.querySelector('#btnEnreg').style.cursor ='not-allowed';
    document.querySelector('#nameTable').style.cursor ='not-allowed';
    document.querySelector('#btnSuivant').style.cursor =  'pointer';
}

function dispNone(){
    document.querySelector('.nomPlaces').style.display = 'none';
}

function selectMode(){

    if(selectmode.value === "ligne"){
        localStorage.setItem('ligne', true);
        document.querySelector('.zoneAdresse').innerText = 'Lien de l\'évènement';
    }
    else{
        localStorage.clear();
        document.querySelector('.zoneAdresse').innerText = 'Adresse de l`\'évènement';
    }
}

(function(){

    window.onload = () =>{
        let ligne;
        ligne = localStorage.getItem('ligne');

        if(ligne){
            document.querySelector('.nomPlaces').style.display ='none';
            document.querySelector('#selectTable').disabled = true;
        }
        else{
            document.querySelector('.nomPlaces').style.display ='flex';
            document.querySelector('#selectTable').disabled = false;
        }
    }

})();

function overFocus(){
    place.classList.add('over');

}
function overBlur(){
  
            if(zone.value.length > 0){
                place.classList.add('over');
            }
            else{
                place.classList.remove('over');
            }
}

function changeMsg(){

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