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
    echo "<script>alert('Faça o login para poder continuar o cadastro da empresa');location = '../../html/login_empresa.html'</script>";
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
                    Conclua o cadastro da sua empresa
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
                <form action="cadastro_info_empresa.php" method="post" enctype="multipart/form-data">
                    <h5>Informações basicas</h5>
                    <!-- Nome Fantasia,  Razão Social -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Nome Fantasia" class="form-label">* Nome Fantasia:</label>
                            <input type="text" class="form-control" placeholder="Nome Fantasia" name="Nome_Fantasia" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Razão Social" class="form-label">* Razão Social:</label>
                            <input type="text" class="form-control" placeholder="Razão Social" name="Razao_Social" required>
                        </div>
                    </div>
                    <!-- CNPJ, Setor da Empresa, Número de Funcionários, Porte da Empresa -->
                    <div class="row mt-3">
                        <div class="form-group col-md-3">
                            <label for="CNPJ" class="form-label">* CNPJ:</label>
                            <input type="text" class="form-control" placeholder="CNPJ" name="CNPJ" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Setor da Empresa" class="form-label">* Setor da Empresa:</label>
                            <select name="Setor_Empresa" class="form-select" required>
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
                        <div class="form-group col-md-3">
                            <label for="Número de Funcionários" class="form-label">* Número de Funcionários:</label>
                            <input type="number" class="form-control" placeholder="Número de Funcionários" name="Numero_Funcionarios" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Porte da Empresa" class="form-label">* Porte da Empresa:</label>
                            <select name="Porte_Empresa" class="form-select" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Pequeno">Pequeno</option>
                                <option value="Médio">Médio</option>
                                <option value="Grande">Grande</option>
                            </select>
                        </div>
                    </div>
                    <!-- CEP, Rua -->
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="CEP" class="form-label">* CEP:</label>
                            <input type="text" class="form-control" placeholder="CEP" name="CEP" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Rua" class="form-label">* Rua:</label>
                            <input type="text" class="form-control" placeholder="Rua" name="Rua" required>
                        </div>
                    </div>
                    <!-- Número, Complemento, Bairro -->
                    <div class="row mt-3">
                        <div class="form-group col-md-4">
                            <label for="Numero" class="form-label">Número:</label>
                            <input type="number" class="form-control" placeholder="Número" name="Numero">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Complemento" class="form-label">Complemento:</label>
                            <input type="text" class="form-control" placeholder="Complemento" name="Complemento">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Bairro" class="form-label">Bairro:</label>
                            <input type="text" class="form-control" placeholder="Bairro" name="Bairro">
                        </div>
                    </div>
                    <!-- Estado, Cidade -->
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="Estado" class="form-label">* Estado:</label>
                            <select name="Estado" class="form-select" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Acre">Acre</option>
                                <option value="Alagoas">Alagoas</option>
                                <option value="Amapá">Amapá</option>
                                <option value="Amazonas">Amazonas</option>
                                <option value="Bahia">Bahia</option>
                                <option value="Ceará">Ceará</option>
                                <option value="Distrito Federal">Distrito Federal</option>
                                <option value="Espírito Santo">Espírito Santo</option>
                                <option value="Goiás">Goiás</option>
                                <option value="Maranhão">Maranhão</option>
                                <option value="Mato Grosso">Mato Grosso</option>
                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                <option value="Minas Gerais">Minas Gerais</option>
                                <option value="Pará">Pará</option>
                                <option value="Paraíba">Paraíba</option>
                                <option value="Paraná">Paraná</option>
                                <option value="Pernambuco">Pernambuco</option>
                                <option value="Piauí">Piauí</option>
                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                <option value="Rondônia">Rondônia</option>
                                <option value="Rondônia">Rondônia</option>
                                <option value="Santa Catarina">Santa Catarina</option>
                                <option value="São Paulo">São Paulo </option>
                                <option value="Sergipe">Sergipe</option>
                                <option value="Tocantins">Tocantins</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Cidade" class="form-label">* Cidade:</label>
                            <input type="text" class="form-control" placeholder="Cidade" name="Cidade" required>
                        </div>
                    </div>
                    <!-- Responsável por Contato, Cargo do Responsável -->
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="Responsavel_Contato" class="form-label">* Responsável por Contato:</label>
                            <input type="text" class="form-control" placeholder="Responsavel Contato" name="Responsavel_Contato" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Cargo_Responsável" class="form-label">* Cargo do Responsável:</label>
                            <input type="text" class="form-control" placeholder="Cargo do Responsável" name="Cargo_Responsável" required>
                        </div>
                    </div>
                    <!-- Celular para Contato, email, Página Web -->
                    <div class="row mt-3">
                        <div class="form-group col-md-4">
                            <label for="Celular_Contato" class="form-label">* Celular para Contato:</label>
                            <input type="text" class="form-control" placeholder="Celular para Contato" name="Celular_Contato" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email" class="form-label">* Email:</label>
                            <input type="text" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Pagina_Web" class="form-label">Página Web:</label>
                            <input type="text" class="form-control" placeholder="Página Web" name="Pagina_Web">
                        </div>
                    </div>
                    <!-- Carregue sua logo marca -->
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <div class="form-group">
                                <h5>* Carregue sua logo marca:</h5>
                                <input type="file" class="form-control" name="image" id="image" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Descreva sua Empresa -->
                    <div class="row mt-3">
                        <div class="form-group col-md-12">
                            <h5>* Descreva sua Empresa:</h5>
                            <textarea class="form-control" rows="5" id="Descricao" name="Descricao" required></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="modal-footer">
                            <input type="submit" class="btn_curriculo_salvar" value="Salvar">
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