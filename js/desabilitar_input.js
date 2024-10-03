function habilitar(habilitar) {
    document.getElementById("fieldset1").hidden = !habilitar;
    document.getElementById("fieldset1").disabled = !habilitar;
}

function habilitar2(checkbox) {
    document.getElementById("fieldset2").disabled = checkbox.checked;
    document.getElementById("fieldset2").hidden = checkbox.checked;
}

function habilitar3(select) {
    document.getElementById("Curso").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("Campus").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("Curso").hidden = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("Campus").hidden = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";

    isFundamentalOrMedio =  select.value === "Ensino Fundamental" || select.value === "Ensino Médio";

    if (isFundamentalOrMedio) {
        nivel.classList.remove('col-md-4');
        nivel.classList.add('col-md-6');
        instituicao.classList.remove('col-md-4');
        instituicao.classList.add('col-md-6');
        document.getElementById("status").classList.remove('col-md-6');
        document.getElementById("status").classList.add('col-md-12');
    } else {
        nivel.classList.remove('col-md-6');
        nivel.classList.add('col-md-4');
        instituicao.classList.remove('col-md-6');
        instituicao.classList.add('col-md-4');
        document.getElementById("status").classList.remove('col-md-12');
        document.getElementById("status").classList.add('col-md-6');
    }
}

function habilitar4(select) {
    document.getElementById("Turno").disabled = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("Campus").disabled = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("Turno").hidden = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("Campus").hidden = select.value === "Trancado" || select.value === "Concluído";

    isTrancadoOrConcluido =  select.value === "Trancado" || select.value === "Concluído";

    if (isTrancadoOrConcluido) {
        document.getElementById("status").classList.remove('col-md-6');
        document.getElementById("status").classList.add('col-md-12');
        document.getElementById("inicio").classList.remove('col-md-3');
        document.getElementById("inicio").classList.add('col-md-6');
        document.getElementById("fim").classList.remove('col-md-3');
        document.getElementById("fim").classList.add('col-md-6');
    } else {
        document.getElementById("status").classList.remove('col-md-12');
        document.getElementById("status").classList.add('col-md-6');
        document.getElementById("inicio").classList.remove('col-md-6');
        document.getElementById("inicio").classList.add('col-md-3');
        document.getElementById("fim").classList.remove('col-md-6');
        document.getElementById("fim").classList.add('col-md-3e');
    }
}