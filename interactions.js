// Variable globale contenant la reference de l'element barre de recherche
var searchInput = null;
// Variable globale contenant la liste des elements affichable et cachable par la recherche
var cardItems = null;

// Attend l'evenement de fin de chargement de la fenetre pour initialiser les interactions
window.addEventListener("load", function () {
  // Initialise l'interaction avec la barre de recherche
  initSearchListenersTB();
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
