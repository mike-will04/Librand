function habilitar(habilitar) {
    document.getElementById("deficienciaCampo").disabled = !habilitar;
    document.getElementById("laudoCampo").disabled = !habilitar;
    document.getElementById("caracteristicaCampo").disabled = !habilitar;
    document.getElementById("deficiencialabel").hidden = !habilitar;
}

function configurarModal() {
    const possuiDeficienciaSim = document.querySelector('input[name="PossuiDeficiencia"][value="Sim"]').checked;
    habilitar(possuiDeficienciaSim);
}

// Adiciona um listener para o evento de abertura da modal
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modalDadosPessoais');
    modal.addEventListener('show.bs.modal', configurarModal);
});

function habilitaralt(habilitar) {
    document.getElementById("deficienciaCampoAlt").disabled = !habilitar;
    document.getElementById("laudoCampoAlt").disabled = !habilitar;
    document.getElementById("caracteristicaCampoAlt").disabled = !habilitar;
    document.getElementById("deficiencialabelAlt").hidden = !habilitar;
}

function configurarModalalt() {
    const possuiDeficienciaSim = document.querySelector('input[name="PossuiDeficiencia"][value="Sim"]').checked;
    habilitaralt(possuiDeficienciaSim);
}

// Adiciona um listener para o evento de abertura da modal
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modalDadosPessoaisAlterar');
    modal.addEventListener('show.bs.modal', configurarModalalt);
});

function habilitar2(checkbox) {
    document.getElementById("fieldset2").disabled = checkbox.checked;
    document.getElementById("fieldsetlabel").hidden = checkbox.checked;
}

function habilitar2alt(checkbox) {
    if (!checkbox.checked) {
        document.getElementById("fieldset2alt").disabled = false; 
        document.getElementById("fieldsetlabelalt").hidden = false; 
    } else {
        document.getElementById("fieldset2alt").disabled = true; 
        document.getElementById("fieldsetlabelalt").hidden = true; 
    }
}

function configurarModalalt2() {
    const atual = document.querySelector('input[name="Atual"][value="1"]');
    habilitar2alt(atual);
}

// Adiciona um listener para o evento de abertura da modal
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modalExperienciaAlterar');
    modal.addEventListener('show.bs.modal', configurarModalalt2);

    const atualCheckbox = document.querySelector('input[name="Atual"]');
    atualCheckbox.addEventListener('change', () => habilitar2alt(atualCheckbox));
});

function habilitar3(select) {
    document.getElementById("Curso").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("Campus").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("Cursolabel").hidden = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("Campuslabel").hidden = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";

    isFundamentalOrMedio = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";

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

function habilitar3alt(select) {
    document.getElementById("CursoAlt").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("CampusAlt").disabled = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("CursolabelAlt").hidden = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";
    document.getElementById("CampuslabelAlt").hidden = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";

    isFundamentalOrMedio = select.value === "Ensino Fundamental" || select.value === "Ensino Médio";

    if (isFundamentalOrMedio) {
        document.getElementById("nivelAlt").classList.remove('col-md-4');
        document.getElementById("nivelAlt").classList.add('col-md-6');
        document.getElementById("instituicaoAlt").classList.remove('col-md-4');
        document.getElementById("instituicaoAlt").classList.add('col-md-6');
        document.getElementById("statusAlt").classList.remove('col-md-6');
        document.getElementById("statusAlt").classList.add('col-md-12');
    } else {
        document.getElementById("nivelAlt").classList.remove('col-md-6');
        document.getElementById("nivelAlt").classList.add('col-md-4');
        document.getElementById("instituicaoAlt").classList.remove('col-md-6');
        document.getElementById("instituicaoAlt").classList.add('col-md-4');
        document.getElementById("statusAlt").classList.remove('col-md-12');
        document.getElementById("statusAlt").classList.add('col-md-6');
    }
}

function habilitar4(select) {
    document.getElementById("Turno").disabled = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("Campus").disabled = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("Turnolabel").hidden = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("Campuslabel").hidden = select.value === "Trancado" || select.value === "Concluído";

    isTrancadoOrConcluido = select.value === "Trancado" || select.value === "Concluído";

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

function habilitar4alt(select) {
    document.getElementById("TurnoAlt").disabled = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("CampusAlt").disabled = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("TurnolabelAlt").hidden = select.value === "Trancado" || select.value === "Concluído";
    document.getElementById("CampuslabelAlt").hidden = select.value === "Trancado" || select.value === "Concluído";

    isTrancadoOrConcluido = select.value === "Trancado" || select.value === "Concluído";

    if (isTrancadoOrConcluido) {
        document.getElementById("statusAlt").classList.remove('col-md-6');
        document.getElementById("statusAlt").classList.add('col-md-12');
        document.getElementById("inicioAlt").classList.remove('col-md-3');
        document.getElementById("inicioAlt").classList.add('col-md-6');
        document.getElementById("fimAlt").classList.remove('col-md-3');
        document.getElementById("fimAlt").classList.add('col-md-6');
    } else {
        document.getElementById("statusAlt").classList.remove('col-md-12');
        document.getElementById("statusAlt").classList.add('col-md-6');
        document.getElementById("inicioAlt").classList.remove('col-md-6');
        document.getElementById("inicioAlt").classList.add('col-md-3');
        document.getElementById("fimAlt").classList.remove('col-md-6');
        document.getElementById("fimAlt").classList.add('col-md-3e');
    }
}