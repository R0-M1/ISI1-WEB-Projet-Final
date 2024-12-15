window.addEventListener('DOMContentLoaded', () => {
    if(localStorage.getItem('navBar')==='reduit'){
        reduire();
    } else {
        agrandir();
    }
})
function agrandir() {
    document.body.classList.remove("reduit");
    document.getElementById("icon_droite").classList.add("actif");
    document.getElementById("icon_gauche").classList.remove("actif");
    localStorage.setItem('navBar', 'agrandit');
}

function reduire() {
    document.body.classList.add("reduit");
    document.getElementById("icon_gauche").classList.add("actif");
    document.getElementById("icon_droite").classList.remove("actif");
    localStorage.setItem('navBar', 'reduit');
}


function supprimerColonne(index) {
    // Récupère toutes les lignes correspondantes
    const lignes = document.querySelectorAll('.list tr');

    lignes.forEach(ligne => {
        const cellules = ligne.querySelectorAll('th, td');
        if (cellules[index]) {
            cellules[index].style.display = 'none'; // Cache les cellules
        }
    });
}
function ajouterColonne() {
    const selectValue = document.getElementById('ajouter').value;

    if (selectValue === "") {
        alert("Veuillez sélectionner une colonne à afficher.");
        return;
    }

    const index = parseInt(selectValue, 10);

    // Récupère toutes les lignes correspondantes
    const lignes = document.querySelectorAll('.list tr');

    lignes.forEach(ligne => {
        const cellules = ligne.querySelectorAll('th, td');
        if (cellules[index]) {
            cellules[index].style.display = ''; // affiche les cellules
        }
    });
}