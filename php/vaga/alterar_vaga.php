<?php
session_start();
include "../conexao.php";

$Titulo = $_POST["Titulo_Vaga"];
$Area = $_POST["Area"];
$Cargo = $_POST["Cargo"];
$Especializacao = isset($_POST["Especializacao"]) ? $_POST["Especializacao"] : null;
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
$id = $_POST['id'];

try{
    $alterar = $conn->prepare('UPDATE vaga SET titulo = :titulo, area = :area, cargo = :cargo, especializacao = :especializacao, senioridade = :senioridade, numero_vagas = :numero_vagas, contrato = :contrato, modalidade = :modalidade, periodo = :periodo, salario = :salario, combinar = :combinar, escolaridade = :escolaridade, localizacao = :localizacao, descricao = :descricao where id_vaga = :id');
    $alterar->execute(array(
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
    ':id' => $id
    ));
    if ($alterar->rowCount()==1){
        $_SESSION['message'] = 'Dados alterados com sucesso!';
    } else {
        $_SESSION['message'] = 'Dados não foram alterados.';
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

header("Location: vagas_ativas.php");
exit();
