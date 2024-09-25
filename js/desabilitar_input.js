function habilitar(habilitar) {
    document.getElementById("fieldset1").disabled = !habilitar;
}

function habilitar2(checkbox) {
    document.getElementById("fieldset2").disabled = checkbox.checked;
}

function habilitar3(select) {
    document.getElementById("Curso").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("Campus").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
}

function habilitar4(select) {
    document.getElementById("Turno").disabled = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("Campus").disabled = select.value === "Trancado" || select.value === "Concluído";
}