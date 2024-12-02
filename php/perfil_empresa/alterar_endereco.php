<?php
session_start();
include "../conexao.php";

$CEP = $_POST["CEP"];
$Rua = $_POST["Rua"];
$Numero = $_POST["Numero"];
$Complemento = $_POST["Complemento"];
$Bairro = $_POST["Bairro"];
$Estado = $_POST["Estado"];
$Cidade = $_POST["Cidade"];
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE sobre_empresa SET cep = :cep, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, estado = :estado, cidade = :cidade where id_sobre = :id');
    $alterar->execute(array(
    ':cep' => $CEP, 
    ':rua' => $Rua,
    ':numero' => $Numero, 
    ':complemento' => $Complemento,
    ':bairro' => $Bairro, 
    ':estado' => $Estado,
    ':cidade' => $Cidade,
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

header("Location: perfil_empresa.php");
exit();
