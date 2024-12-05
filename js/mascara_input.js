// Função para aplicar a máscara ao CPF
function aplicarMascaraCPF(campo) {
    // Remove qualquer caractere que não seja número
    let valor = campo.value.replace(/\D/g, '');

    // Aplica a máscara conforme o número de caracteres
    if (valor.length <= 11) {
        valor = valor.replace(/^(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
        valor = valor.replace(/\.(\d{3})(\d)/, '.$1-$2');
    }

    // Atualiza o campo com o valor formatado
    campo.value = valor;
}

function aplicarMascaraTelefone(campo) {
    let valor = campo.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico

    // Limita o valor a 11 caracteres
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }

    // Aplica a máscara conforme o número de caracteres
    if (valor.length <= 2) {
        valor = valor.replace(/^(\d{2})/, '($1)');  // Adiciona o parêntese após o DDD
    } else if (valor.length <= 6) {
        valor = valor.replace(/^(\d{2})(\d{1})/, '($1) $2');  // Adiciona o espaço após o DDD
    } else if (valor.length <= 10) {
        valor = valor.replace(/^(\d{2})(\d{5})(\d{1})/, '($1) $2-$3');  // Adiciona o hífen após 5 dígitos
    } else {
        valor = valor.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');  // Finaliza a máscara
    }

    campo.value = valor;  // Atualiza o campo com o valor formatado
}

function aplicarMascaraCEP(campo) {
    let valor = campo.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico

    // Limita o valor a 8 caracteres
    if (valor.length > 8) {
        valor = valor.slice(0, 8);
    }

    // Aplica a máscara de CEP XXXXX-XXX
    if (valor.length > 5) {
        valor = valor.replace(/^(\d{5})(\d{3})$/, '$1-$2');  // Adiciona o hífen após os 5 primeiros dígitos
    } else {
        valor = valor.replace(/^(\d{5})$/, '$1');  // Apenas os 5 primeiros dígitos
    }

    campo.value = valor;  // Atualiza o campo com o valor formatado
}