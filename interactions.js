// Variable globale contenat la reference de l'element barre de recherche
var searchInput = null;
// Variable globale contenant la liste des elements affichable et cachable par la recherche
var cardItems = null;

// Attend l'evenement de fin de chargement de la fenetre pour initialiser les interactions
window.addEventListener("load", function () {
  // Initialise l'interaction avec la barre de recherche
  initSearchListenersTB();

  // Initialise l'interaction avec les images flippable
  initImageFlipListenersTB();

  // Initialise la lecture du son des personnages
  initSoundListenersTB();
});

// Fonction d'initialisation de l'interaction de recherche
function initSearchListenersTB() {
  // Trouve et stocke la reference de l'element de barre de recherche grace à son ID
  searchInput = document.getElementById("searchInput");
  // Trouve et stocke les reference des element DIV à gérer par la recherche grace à la classe 'card'
  cardItems = document.querySelectorAll("div.card");

  // Ajoute un écouteur d'événement pour chaque frappe dans la barre de recherche
  searchInput.addEventListener("input", searchInputCallbackTB);
}

// Fonction de callback de la barre de recherche, appelé à chaque frappe
function searchInputCallbackTB(event) {
  // Trouve le texte de la barre de recherche et le converti en minuscule
  const query = searchInput.value.toLowerCase();

  // Parcourt chaque élément de la liste des DIV à gérer par la recherche
  cardItems.forEach((item) => {
    // Recupère la données recherche et la converti en minuscules
    const text = item.dataset.search_value.toLowerCase();
    // Affiche ou masque le DIV selon la correspondance avec le texte de recherche
    item.style.display = text.includes(query) ? "flex" : "none";
  });
}

// Fonction d'initialisation de l'interaction de flip d'image
function initImageFlipListenersTB() {
  // Selection toutes les images flippables grace à la classe 'flippable'
  const imageItems = document.querySelectorAll("img.flippable");
  // Pour chaque image flippage, ajout des ecouteurs d'evenement de survol de souris et de sortie de la souris
  imageItems.forEach((item) => {
    // Evenement de survol
    item.addEventListener("mouseover", flipImageMouseoverCallbackTB);
    // Evenement de sortie
    item.addEventListener("mouseout", flipImageMouseoutCallbackTB);
  });
}

// Fonction de callback de l'evenement de survol
function flipImageMouseoverCallbackTB(event) {
  // Trouve l'element image qui est survolé
  const img = event.target;
  // Utilise l'attribut data avec l'image flip pour changer la source de l'image
  img.src = img.dataset.flip_img;
}

// Fonction de callback pour l'evenement "out", lorsqu'on nesurvole plus l'element
function flipImageMouseoutCallbackTB(event) {
  // Trouve l'element image survolé
  const img = event.target;
  // Utilise l'attribut data avec l'image "normal" pour changer la source de l'image
  img.src = img.dataset.normal_img;
}

// Fonction d'initialisation de l'interaction de son des personnages
function initSoundListenersTB() {
  // Selection toutes les boutons son grace à la classe 'sound'
  const boutonItems = document.querySelectorAll(".sound");
  // Pour chaque bouton, ajout des ecouteurs d'evenement de click
  boutonItems.forEach((item) => {
    // URL du son dans les données
    const sonUrl = item.dataset.sound;
    // Creation d'un objet Audio
    const audioObj = document.createElement("audio");
    const source = document.createElement("source");
    source.src = sonUrl;
    source.type = "audio/mpeg";
    audioObj.appendChild(source);
    audioObj.load();

    // Ecouteur d'evenement de click avec le son passé en paramètre
    item.addEventListener("click", playSoundCallbackTB.bind(null, audioObj));
  });
}

// Fonction de callback de l'evenement de click, avec le son en paramètre
function playSoundCallbackTB(audioObj, event) {
  // remet le son au debut
  audioObj.currentTime = 0;
  // joue le son
  audioObj.play();
}
