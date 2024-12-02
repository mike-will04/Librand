<?php
session_start();
include "../conexao.php";

$Nome_Fantasia = $_POST["Nome_Fantasia"];
$Razao_Social = $_POST["Razao_Social"];
$CNPJ = $_POST["CNPJ"];
$Setor_Empresa = $_POST["Setor_Empresa"];
$Numero_Funcionarios = $_POST["Numero_Funcionarios"];
$Porte_Empresa = $_POST["Porte_Empresa"];
$id = $_POST["id"];

try {
    $alterar = $conn->prepare('UPDATE sobre_empresa SET nome_fantasia = :nome_fantasia, razao_social = :razao_social, cnpj = :cnpj, setor = :setor, numero_funcionarios = :numero_funcionarios, porte = :porte where id_sobre = :id');
    $alterar->execute(array(
        ':nome_fantasia' => $Nome_Fantasia,
        ':razao_social' => $Razao_Social,
        ':cnpj' => $CNPJ,
        ':setor' => $Setor_Empresa,
        ':numero_funcionarios' => $Numero_Funcionarios,
        ':porte' => $Porte_Empresa,
        ':id' => $id
    ));
    if ($alterar->rowCount() == 1) {
        $_SESSION['message'] = 'Dados alterados com sucesso!';
    } else {
        $_SESSION['message'] = 'Dados não foram alterados.';
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

header("Location: perfil_empresa.php");
exit();
