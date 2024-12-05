<!DOCTYPE html>
<html lang="pt-br">
<?php
include "../conexao.php";
session_start();

if (isset($_SESSION['iduser'])) {
    $id = $_SESSION['iduser'];

    $check = $conn->prepare(
        'SELECT * FROM usuario WHERE id_usuario = :id'
    );
    $check->execute(array(
        ':id' => $id
    ));
} else {
    $_SESSION['logado'] = false;
    echo "<script>alert('Faça o login para poder cadastrar uma vaga');location = '../../html/login_empresa.html'</script>";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link id="favicon" rel="shortcut icon" type="imagex/png" href="../../img/Maozinha_branca.png">
    <script src="../js/favicon_dentro.js"></script>
    <link rel="stylesheet" href="../../css/cadastro_curriculo.css">
</head>

<body>
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <nav class="navbar navbar-expand-sm " style="background-color: #2259BC;">
        <div class="container-fluid justify-content-center">
            <a href="../index.php" class="navbar-brand d-flex">
                <img src="../../img/Logotipo Librand.png" alt="Logo Librand" style="width: 100px;">
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-12 text-center">
                <h3 class="titulo_curriculo">
                    Anunciar Vaga
                </h3>
            </div>
            <div class="voltar">
                <a onclick="history.go(-1)">
                    <i class="bi bi-arrow-left"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-11 shadow-lg rounded align-items-center justify-content-center p-4">
                <form action="cadastro_vaga.php" method="post">
                    <!-- Titulo da Vaga -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Título da Vaga" class="form-label">* Título da Vaga:</label>
                            <input type="text" class="form-control" placeholder="Título da Vaga" name="Titulo_Vaga" required>
                        </div>
                    </div>
                    <hr>
                    <h5>Informações basicas</h5>
                    <!-- Área,  Cargo -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Area" class="form-label">* Área:</label>
                            <select name="Area" id="Area" class="form-select" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Administração">Administração</option>
                                <option value="Agricultura, Pecuária, Veterinária">Agricultura</option>
                                <option value="Alimentação / Gastronomia">Alimentação</option>
                                <option value="Arquitetura, Decoração, Design">Arquitetura</option>
                                <option value="Artes">Artes</option>
                                <option value="Auditoria">Auditoria</option>
                                <option value="Ciências">Ciências</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Comunicação">Comunicação</option>
                                <option value="Construção">Construção</option>
                                <option value="Contábil">Contábil</option>
                                <option value="Cultura">Cultura</option>
                                <option value="Educação">Educação</option>
                                <option value="Engenharia">Engenharia</option>
                                <option value="Industrial">Industrial</option>
                                <option value="Informática">Informática</option>
                                <option value="Jurídica">Jurídica</option>
                                <option value="Logística">Logística</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Moda">Moda</option>
                                <option value="Qualidade">Qualidade</option>
                                <option value="Recursos Humanos">Recursos Humanos</option>
                                <option value="Saúde">Saúde</option>
                                <option value="Segurança">Segurança</option>
                                <option value="Serviço Social e Comunitário">Serviço Social e Comunitário</option>
                                <option value="Serviços Gerais">Serviços Gerais</option>
                                <option value="Telemarketing">Telemarketing</option>
                                <option value="Transportes">Transportes</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Cargo" class="form-label">* Cargo:</label>
                            <input type="text" class="form-control" placeholder="Cargo" name="Cargo" required>
                        </div>
                    </div>
                    <!-- Especialização, Senioridade -->
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="Especializacao" class="form-label">Especialização:</label>
                            <input type="text" class="form-control" placeholder="Especialização" name="Especializacao">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Senioridade" class="form-label">* Senioridade:</label>
                            <select name="Senioridade" class="form-select" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Estagiário">Estagiário</option>
                                <option value="Operacional">Operacional</option>
                                <option value="Auxiliar">Auxiliar</option>
                                <option value="Assistente">Assistente</option>
                                <option value="Treinee">Treinee</option>
                                <option value="Analista">Analista</option>
                                <option value="Encarregado">Encarregado</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Consultor">Consultor</option>
                                <option value="Especialista">Especialista</option>
                                <option value="Coordenador">Coordenador</option>
                                <option value="Gerente">Gerente</option>
                                <option value="Diretor">Diretor</option>
                            </select>
                        </div>
                    </div>
                    <!-- Quantidade de Vaga -->
                    <div class="row mt-3">
                        <div class="form-group col-md-2 mt-3">
                            <label for="Quantidade_Vagas" class="form-label">* Quantidade de Vagas:</label>
                        </div>
                        <div class="form-group col-md-3 mt-3">
                            <input type="number" class="form-control" placeholder="Quantidade de Vagas" name="Quantidade_Vagas" required>
                        </div>
                    </div>
                    <!-- Contrato, Modalidade -->
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="Contrato" class="form-label">* Contrato:</label>
                            <select name="Contrato" class="form-select" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="CLT">CLT</option>
                                <option value="Autônomo">Autônomo</option>
                                <option value="Prestador de Serviço (PJ)">Prestador de Serviço (PJ)</option>
                                <option value="Cooperado">Cooperado</option>
                                <option value="Jovem Aprendiz">Jovem Aprendiz</option>
                                <option value="Estágio">Estágio</option>
                                <option value="Temporário">Temporário</option>
                                <option value="Trainee">Trainee</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Modalidade" class="form-label">* Modalidade:</label>
                            <select name="Modalidade" class="form-select" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Home Office">Home Office</option>
                                <option value="Híbrido">Híbrido</option>
                            </select>
                        </div>
                    </div>
                    <!-- Período, Faixa Salarial -->
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="Período" class="form-label">* Período:</label>
                            <select name="Periodo" class="form-select" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Período Integral">Período Integral</option>
                                <option value="Parcial Manhãs">Parcial Manhãs</option>
                                <option value="Parcial Tardes">Parcial Tardes</option>
                                <option value="Parcial Noites">Parcial Noites</option>
                                <option value="Noturno">Noturno</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <label for="Salario" class="form-label">* Faixa Salarial:</label>
                            <input type="text" class="form-control" id="salario" placeholder="Faixa Salarial" name="Salario" required>
                            <label for="Combinar" class="form-label">A combinar:</label>
                            <input type="checkbox" class="form-check-input" id="combinar" name="Combinar">
                        </div>

                        <script>
                            // Selecionar os elementos
                            const salarioInput = document.getElementById('salario');
                            const combinarCheckbox = document.getElementById('combinar');

                            // Adicionar um evento ao checkbox
                            combinarCheckbox.addEventListener('change', function() {
                                if (this.checked) {
                                    // Desabilitar a input de salário e alterar o valor
                                    salarioInput.value = 'Salário a combinar';
                                    salarioInput.disabled = true;
                                } else {
                                    // Habilitar a input de salário e limpar o valor
                                    salarioInput.value = '';
                                    salarioInput.disabled = false;
                                }
                            });
                        </script>
                    </div>
                    <!-- Escolaridade Necessária, Localização -->
                    <div class="row mt-1">
                        <div class="form-group col-md-6">
                            <label for="Escolaridade" class="form-label">* Escolaridade Necessária:</label>
                            <input type="text" class="form-control" placeholder="Escolaridade Necessária" name="Escolaridade" required>
                        </div>
                    </div>
                    <!-- Celular para Contato, email, Página Web -->
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="Localizacao" class="form-label">* Localização:</label>
                            <input type="text" class="form-control" placeholder="Localização" name="Localizacao" required>
                        </div>
                    </div>
                    <hr>
                    <!-- Descrição da Vaga -->
                    <div class="row mt-3">
                        <div class="form-group col-md-12">
                            <h5>* Descrição da Vaga:</h5>
                            <textarea class="form-control" rows="5" name="Descricao" required></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="modal-footer">
                            <input type="submit" class="btn_curriculo_salvar" value="Anunciar">
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <footer class="p-5 fixed-botton text-center text-light" style="background-color: #2259BC;">
        Site desenvolvido por:
        <br>
        Enzo Jesael Brandão Cardeal Ortiz, Felipe de Assis Vieira e Mike Will Bento do Rego
        <br>
        3B
        <br>
        &copy; <?php echo date("Y"); ?> Librand - Todos os direitos reservados.
    </footer>
</body>

</html>

<script src="../../js/desabilitar_input.js"></script>