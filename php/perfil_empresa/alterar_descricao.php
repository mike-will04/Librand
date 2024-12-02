<?php
session_start();
include "../conexao.php";

$Descricao = $_POST["Descricao"];
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE sobre_empresa SET descricao = :descricao where id_sobre = :id');
    $alterar->execute(array(
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

header("Location: perfil_empresa.php");
exit();
