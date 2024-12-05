<?php
include "../conexao.php";

session_start();

$Titulo = $_POST["Titulo_Vaga"];
$Area = $_POST["Area"];
$Cargo = $_POST["Cargo"];
$Especializacao = $_POST["Especializacao"];isset($_POST["Especializacao"]) ? $_POST["Especializacao"] : null;
$Senioridade = $_POST["Senioridade"];
$Quantidade_Vagas = $_POST["Quantidade_Vagas"];
$Contrato = $_POST["Contrato"];
$Modalidade = $_POST["Modalidade"];
$Periodo = $_POST["Periodo"];
$Salario = isset($_POST["Salario"]) ? $_POST["Salario"] : "Salário a combinar";
$Combinar = isset($_POST["Combinar"]) ? 1 : 0;
$Escolaridade = $_POST["Escolaridade"];
$Localizacao = $_POST["Localizacao"];
$Descricao = $_POST["Descricao"];
$id_usuario = $_SESSION['iduser'];

try {
    $cadastro = $conn->prepare('INSERT INTO vaga (titulo, area, cargo, especializacao, senioridade, numero_vagas, contrato, modalidade, periodo, salario, combinar, escolaridade, localizacao, descricao, id_usuario) VALUES 
    (:titulo, :area, :cargo, :especializacao, :senioridade, :numero_vagas, :contrato, :modalidade, :periodo, :salario, :combinar, :escolaridade, :localizacao, :descricao, :id_usuario)');
    $cadastro->execute(array(
        ':titulo' => $Titulo,
        ':area' => $Area,
        ':cargo' => $Cargo,
        ':especializacao' => $Especializacao,
        ':senioridade' => $Senioridade,
        ':numero_vagas' => $Quantidade_Vagas,
        ':contrato' => $Contrato,
        ':modalidade' => $Modalidade,
        ':periodo' => $Periodo,
        ':salario' => $Salario,
        ':combinar' => $Combinar,
        ':escolaridade' => $Escolaridade,
        ':localizacao' => $Localizacao,
        ':descricao' => $Descricao,
        ':id_usuario' => $id_usuario
    ));
    if ($cadastro->rowCount() == 1) {
        echo "<script>alert('Vaga cadastrada com sucesso!!!');location = '../index_empresa.php'</script>";
    } else {
        echo "<script>alert('Erro ao adicionar a vaga');history.go(-1)</script>";
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}