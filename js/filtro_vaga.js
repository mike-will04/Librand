// Função para alternar a visibilidade dos filtros adicionais
function toggleFiltro(tipo) {
    const filtros = document.querySelectorAll(`.${tipo}.extra-filtro`);
    const textoToggle = document.getElementById(`${tipo}-text`);
    
    if (filtros[0].style.display === 'none') {
        // Mostrar mais filtros
        filtros.forEach(filtro => filtro.style.display = 'block');
        textoToggle.innerText = '-menos';
    } else {
        // Esconder filtros adicionais
        filtros.forEach(filtro => filtro.style.display = 'none');
        textoToggle.innerText = '+mais';
    }
}

function aplicarFiltroVagas() {
    // Coletar as opções marcadas de Setor
    const setoresSelecionados = Array.from(document.querySelectorAll('.setor:checked'))
        .map(checkbox => checkbox.value);

    // Coletar as opções marcadas de Senioridade
    const senioridadesSelecionados = Array.from(document.querySelectorAll('.senioridade:checked'))
        .map(checkbox => checkbox.value);

    // Coletar as opções marcadas de Contrato
    const contratosSelecionados = Array.from(document.querySelectorAll('.contrato:checked'))
        .map(checkbox => checkbox.value);

    // Coletar as opções marcadas de Modalidade
    const modalidadesSelecionados = Array.from(document.querySelectorAll('.modalidade:checked'))
        .map(checkbox => checkbox.value);
    
    // Coletar as opções marcadas de Periodo
    const periodosSelecionados = Array.from(document.querySelectorAll('.periodo:checked'))
        .map(checkbox => checkbox.value);

    // Fazer a requisição AJAX
    fetch('filtro_vagas.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            setores: setoresSelecionados,
            senioridades: senioridadesSelecionados,
            contratos: contratosSelecionados,
            modalidades: modalidadesSelecionados,
            periodos: periodosSelecionados
        })
    })
        .then(response => response.text())
        .then(html => {
            // Atualizar a lista de empresas com os resultados filtrados
            document.querySelector('.col-md-9.mb-4').innerHTML = html;
        })
        .catch(error => console.error('Erro ao aplicar o filtro:', error));
}

// Adiciona o evento de envio do formulário
document.getElementById('form-pesquisa').addEventListener('submit', function (e) {
    const termo = document.getElementById('campo-pesquisa').value.trim();

    if (!termo) {
        e.preventDefault(); // Impede o envio somente se o campo estiver vazio
        alert('Por favor, insira um termo para buscar.');
    }
});



