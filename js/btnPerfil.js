var btnPerfil = "fechado";

function perfil() {
    if (btnPerfil == "fechado") {
        document.getElementById("carde").style.display = "block";
        btnPerfil = "aberto";
    } else {
        document.getElementById("carde").style.display = "none";
        btnPerfil = "fechado";
    }
}

document.addEventListener('mouseup', function (e) {
    var container = document.getElementById('carde');
    if (!container.contains(e.target)) {
        container.style.display = 'none';
    }
});
