// Sélectionne l'élément de la page
var alertBox = document.getElementById("alert-box");

// Initialisation du timer
var timer = null;

// Fonction pour afficher l'alerte
function showAlert() {
    console.log('show');
    alertBox.style.display = "block";
}

// Fonction pour afficher l'alerte
function hiddenAlert() {
    console.log('hidden');
    alertBox.style.display = "none";
}

// Fonction pour réinitialiser le timer
function resetTimer() {
    hiddenAlert();
    clearTimeout(timer);
    timer = setTimeout(showAlert, 5000); // 5000 millisecondes = 5 secondes
}

// Événement de mouvement de la souris
document.addEventListener("mousemove", function () {
    console.log('Move');
    resetTimer();
});

// Appelle la fonction pour initialiser le timer au chargement de la page
resetTimer();
