function deletarIdioma(id) {
    const confirmAction = confirm("Você tem certeza que deseja excluir este idioma?");
    if (confirmAction) {
        window.location.href = '../perfil_usuario/apagar_idioma.php?id=' + id;
    }
}

function deletarEspecializacoes(id) {
    const confirmAction = confirm("Você tem certeza que deseja excluir esta especialização?");
    if (confirmAction) {
        window.location.href = '../perfil_usuario/apagar_especializacoes.php?id=' + id;
    }
}

function deletarFormacao(id) {
    const confirmAction = confirm("Você tem certeza que deseja excluir esta formação?");
    if (confirmAction) {
        window.location.href = '../perfil_usuario/apagar_formacao.php?id=' + id;
    }
}

function deletarExpProfissional(id) {
    const confirmAction = confirm("Você tem certeza que deseja excluir esta exp.profissional?");
    if (confirmAction) {
        window.location.href = '../perfil_usuario/apagar_exp_profissional.php?id=' + id;
    }
}

function deletarObjetivo(id) {
    const confirmAction = confirm("Você tem certeza que deseja excluir este objetivo?");
    if (confirmAction) {
        window.location.href = '../perfil_usuario/apagar_objetivo.php?id=' + id;
    }
}

function deletarVaga(id) {
    const confirmAction = confirm("Você tem certeza que deseja excluir esta vaga?");
    if (confirmAction) {
        window.location.href = '../vaga/apagar_vaga.php?id=' + id;
    }
}

function deletarCandidatura(id) {
    const confirmAction = confirm("Você tem certeza que deseja excluir esta candidatura?");
    if (confirmAction) {
        window.location.href = '../perfil_usuario/apagar_candidatura.php?id=' + id;
    }
}