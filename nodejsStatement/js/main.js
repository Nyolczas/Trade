// Adatmegjelenítés
var adatMezo = document.querySelector(".adatot-kerek");

function adatotAd( adatok ) {
    var tartalom = '<ul';
    adatok = JSON.parse(adatok);
    for ( var k in adatok) {
        tartalom += '<li>' +adatok[k].name+'</li>';
    }
    tartalom += '</ul>';
    adatMezo.innerHTML =  tartalom;
}

// Ajax kérés a Node server felé
var xhr = new XMLHttpRequest();
xhr.open( "get", "http://localhost:3333");
xhr.onload = function() {
    adatotAd( this.response);
};
xhr.send();

//Változtatások után grunt paranccsal tömöríteni kell (fő mappában), majd újraindítani a szervert (szerver mappában: node server)