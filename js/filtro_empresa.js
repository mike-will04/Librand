function aplicarFiltro() {
    // Coletar as opções marcadas de Localização
    const localizacoesSelecionadas = Array.from(document.querySelectorAll('.localizacao:checked'))
        .map(checkbox => checkbox.value);

    // Coletar as opções marcadas de Setor
    const setoresSelecionados = Array.from(document.querySelectorAll('.setor:checked'))
        .map(checkbox => checkbox.value);

    // Coletar as opções marcadas de Porte
    const portesSelecionados = Array.from(document.querySelectorAll('.porte:checked'))
        .map(checkbox => checkbox.value);

    // Fazer a requisição AJAX
    fetch('filtrar_empresas.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            localizacoes: localizacoesSelecionadas,
            setores: setoresSelecionados,
            portes: portesSelecionados
        })
    })
        .then(response => response.text())
        .then(html => {
            // Atualizar a lista de empresas com os resultados filtrados
            document.querySelector('.col-md-9.mb-4').innerHTML = html;
        })
        .catch(error => console.error('Erro ao aplicar o filtro:', error));
}


document.getElementById('form-pesquisa').addEventListener('submit', function (e) {
    e.preventDefault(); // Impede o envio padrão do formulário
    
    const termo = document.getElementById('campo-pesquisa').value.trim();
    const resultados = document.querySelectorAll('#resultados-empresas .div_curriculo');
    const resultadosContainer = document.getElementById('resultados-empresas');
    let encontrou = false;

    // Remove a mensagem de erro, caso exista
    const mensagemErroExistente = document.getElementById('mensagem-erro');
    if (mensagemErroExistente) {
        mensagemErroExistente.remove();
    }

    if (termo) {
        // Busca pela empresa
        resultados.forEach(empresa => {
            const nomeEmpresa = empresa.querySelector('h4').textContent.toLowerCase();
            if (nomeEmpresa.includes(termo.toLowerCase())) {
                empresa.style.display = 'block'; // Mostra o resultado encontrado
                encontrou = true;
            } else {
                empresa.style.display = 'none'; // Oculta os que não correspondem
            }
        });

        if (!encontrou) {
            // Adiciona a mensagem de erro
            const mensagem = document.createElement('div');
            mensagem.id = 'mensagem-erro';
            mensagem.className = 'col-md-12 div_curriculo shadow rounded p-4 mb-4';
            mensagem.innerHTML = "<p>Nenhuma empresa encontrada!</p>";
            resultadosContainer.appendChild(mensagem);
        }
    } else {
        // Exibe o alerta e exibe todas as empresas novamente
        alert('Por favor, insira um termo para buscar.');

        // Exibe todas as empresas
        resultados.forEach(empresa => {
            empresa.style.display = 'block'; // Exibe todas as empresas
        });
    }
});


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