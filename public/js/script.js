function agrandir() {
    document.body.classList.remove("reduit");
    document.getElementById("icon_droite").classList.add("actif");
    document.getElementById("icon_gauche").classList.remove("actif");
}

function reduire() {
    document.body.classList.add("reduit");
    document.getElementById("icon_gauche").classList.add("actif");
    document.getElementById("icon_droite").classList.remove("actif");
}